<#
	include "Utilities/EntityUtilities.ajg"

	Entity = Form.Entity
#>
<?
	$Page->Title = '${Form.Title}';
<#
	if WebDir then
#>
	if (!$Page->Prefix)
		$Page->Prefix = '../';
<#
	end if
#>

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
<#
	if Technology.Programming.Strategy="Functions" then
#>
	include_once($Page->Prefix.'includes/${Entity.Name}Functions.inc.php');
<#
	end if
#>

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
<#
	if Technology.Programming.Strategy="Functions" then
#>
		$rs = ${Entity.Name}GetById($Id);
<#
		for each Field in Form.Fields where Field.Property.Type<>"Id"
#>
		$${Field.Property.Name} = $rs['${Field.Property.Name}'];
<#
		end for
	else
#>
		$sql = "select <#
	nprop = 0
	for each Field in Form.Fields where Field.Property.Type<>"Id"
		if nprop then
			print ", "
		end if
		print Field.Property.SqlColumn
		if Field.Property.SqlColumn <> Field.Property.Name then
			print " as " & Field.Property.Name
		end if
		nprop = nprop + 1
	end for
#> from $Cfg[SqlPrefix]${Entity.SqlTable} where Id = $Id";
		$rs = DbExecuteQuery($sql);
		list(<#
	nprop = 0
	for each Field in Form.Fields where Field.Property.Type<>"Id"
		if nprop then
			print ", "
		end if
		print "$" & Field.Property.Name
		nprop = nprop + 1
	end for
#>) = DbNextRow($rs);
<#
	end if
#>

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "${Form.NewTitle}";
		$IsNew = 1;
	}

<#
	for each Field in Form.Fields where Field.Property.Reference
#>
	$rs${Field.Property.Name} = TranslateQuery("$Cfg[SqlPrefix]${Field.Property.Reference.SqlTable}","${Field.Property.Reference.DescriptorProperty.SqlColumn} as ${Field.Property.Reference.DescriptorProperty.Name}");
<#
	end for
#>

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="actions">
<a href="${Entity.Name}List.php">${Entity.SetDescriptor}</a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="${Entity.Name}View.php?Id=<? echo $Id; ?>">${Entity.Descriptor}</a>
&nbsp;
&nbsp;
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="${Entity.Name}Update.php" method=post>

<?
	TableOpen();
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

<#
	for each Field in Form.Fields where Field.Property.Type<>"Id"
		if Field.Property.Reference then
#>
	FieldComboRsGenerate("${Field.Property.Name}", "${Field.Description}", $rs${Field.Property.Name}, $${Field.Property.Name},"${Field.Property.Reference.IdProperty.Name}","${Field.Property.Reference.DescriptorProperty.Name}", ${not Field.Required}, ${Field.Required});
<#
		else
		if Field.Property.Enumeration then
#>
	FieldComboHashGenerate("${Field.Property.Name}", "${Field.Description}", $Enum${Field.Property.Enumeration.Name}, $${Field.Property.Name}, ${not Field.Required}, ${Field.Required});
<#
		else
			if Field.Type="Text" and not Field.Subtype="Password" then
#>
	FieldTextGenerate("${Field.Property.Name}", "${Field.Description}", $${Field.Property.Name}, ${Field.Size}, ${Field.Required});
<#
			end if
			if Field.Type="Text" and Field.Subtype="Password" then
#>
	FieldPasswordGenerate("${Field.Property.Name}", "${Field.Description}", $${Field.Property.Name}, ${Field.Size}, ${Field.Required});
<#
			end if
			if Field.Type="Memo" then
#>
	FieldMemoGenerate("${Field.Property.Name}", "${Field.Description}", $${Field.Property.Name}, ${Field.Rows}, ${Field.Cols}, ${Field.Required});
<#
			end if
			if Field.Type="Boolean" then
#>
	FieldCheckGenerate("${Field.Property.Name}", "${Field.Description}", $${Field.Property.Name}, ${Field.Required});
<#
			end if
		end if
		end if
	end for
#>

	FieldOkGenerate();
	TableClose();
?>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>