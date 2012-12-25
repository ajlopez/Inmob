<#
	include "Utilities/EntityUtilities.ajg"
	include "Utilities/TextUtilities.ajg"

	Entity = List.Entity
	EntityIdProperty = IdProperty(Entity)
    NewText = TextForNew(Project.Language, Entity.Gender)
    ViewText = TextForView(Project.Language)
#>
<?
	$Page->Title = '${List.Title}';

<#
	if WebDir then
#>
	if (!$Page->Prefix)
		$Page->Prefix = '../';
<#
	end if
#>

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
<#
	if Technology.Programming.Strategy="Functions" then
#>
	include_once($Page->Prefix . 'includes/${Entity.Name}Functions.inc.php');
<#
		for each Column in List.Columns where Column.Property.Reference
#>
	include_once($Page->Prefix . 'includes/${Column.Property.Reference.Name}Functions.inc.php');
<#
		end for
	end if
#>

	SessionPut('${Entity.Name}Link',PageCurrent());

	DbConnect();

<#
	if Technology.Programming.Strategy="Functions" then
#>
	$rs = ${Entity.Name}GetList${List.QueryName}();
<#
	else
#>
	$sql = "select <# 
		print EntityIdProperty.Name
		for each Column in List.Columns
			print ", "
			print Column.Property.SqlColumn
			if Column.Property.SqlColumn <> Column.Property.Name then
				print " as " & Column.Property.Name
			end if
		end for #> from $Cfg[SqlPrefix]${Entity.SqlTable}";

<#
		if List.Order then
#>
	$sql .= " order by ${List.Order}";

<#
		end if
#>
	$rs = DbExecuteQuery($sql);
<#
	end if
#>

	$titles = array(<# 
		ncol = 0
		for each Column in List.Columns
			if ncol then
				print ", "
			end if
            if Column.Title = "Id" then
                print "''"
            else
                print "'" & Column.Title & "'"
            end if
			ncol = ncol+1
		end for #>);

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-primary" href="${Entity.Name}Form.php">${NewText} ${Entity.Descriptor}...</a>
</div>

<?		
	TableOpen($titles);

	while ($reg=DbNextRow($rs)) {
		RowOpen();
<#
	ncol = 0
	for each Column in List.Columns
		if ncol=0 then
#>
		DatumLinkGenerate("${ViewText}...", "${Entity.Name}View.php?Id=".$reg['Id']);
<#
		else
			if Column.Property.Reference then
#>
		$ColumnDescription = ${Column.Property.Reference.Name}Translate($reg['${Column.Property.Name}']);
		DatumLinkGenerate($ColumnDescription, "${Column.Property.Reference.Name}View.php?Id=".$reg['${Column.Property.Name}']);
<#
			else
                if Column.Property.Enumeration then
#>
		DatumGenerate(TranslateEnumeration($Enum${Column.Property.Enumeration.Name},$reg['${Column.Property.Name}']));
<#
                else
#>
		DatumGenerate($reg['${Column.Property.Name}']);
<#
                end if
			end if
		end if
		ncol=ncol+1
	end for
#>
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>