<#
	include "Utilities/EntityUtilities.ajg"
	include "Utilities/TextUtilities.ajg"

	Entity = View.Entity
	EntityIdProperty = IdProperty(Entity)

	Included = new System.Collections.ArrayList()
    UpdateText = TextForUpdate(Project.Language)
    DeleteText = TextForDelete(Project.Language)
    ViewText = TextForView(Project.Language)
    YesText = TextForYes(Project.Language)
    NoText = TextForNo(Project.Language)
#>
<?
	$Page->Title = '${View.Title}';
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
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
<#
	if Technology.Programming.Strategy="Functions" then
		if not Included.Contains(Entity.Name) then
#>
	include_once($Page->Prefix.'includes/${Entity.Name}Functions.inc.php');
<#
			Included.Add(Entity.Name)
		end if
		for each Relation in Entity.Relations where Relation.RelationType="Referenced"
			if not Included.Contains(Relation.Entity.Name) then
#>
	include_once($Page->Prefix.'includes/${Relation.Entity.Name}Functions.inc.php');
<#
				Included.Add(Relation.Entity.Name)
			end if
		end for

		for each List in View.Lists
			for each Column in List.Columns where Column.Property.Reference
				if not Included.Contains(Column.Property.Reference.Name) then
					Included.Add(Column.Property.Reference.Name)
#>
	include_once($Page->Prefix.'includes/${Column.Property.Reference.Name}Functions.inc.php');
<#
				end if
			end for
		end for

		for each Relation in Entity.Relations where Relation.RelationType = "Referenced"
			for each Column in Relation.Entity.List.Columns where Column.Property.Reference
				if not Included.Contains(Column.Property.Reference.Name) then
					Included.Add(Column.Property.Reference.Name)
#>
	include_once($Page->Prefix.'includes/${Column.Property.Reference.Name}Functions.inc.php');
<#
				end if
			end for
		end for

	end if
#>

	DbConnect();
	
	SessionPut('${Entity.Name}Link',PageCurrent());
<#
	for each List in View.Lists where List.CanEdit
#>
	SessionPut('${List.Entity.Name}Link',PageCurrent());
<#
	end for
#>

<#
	for each List in View.Lists where List.CanDelete
#>
	SessionPut('${List.Entity.Name}DeleteLink',PageCurrent());
<#
	end for
#>

	if (!isset($Id))
		PageExit();

<#
	if Technology.Programming.Strategy="Functions" then
#>
	$rs = ${Entity.Name}GetById($Id);
<#
		for each Field in View.Fields where Field.Property.Type<>"Id"
#>
	$${Field.Property.Name} = $rs['${Field.Property.Name}'];
<#
		end for
	else
#>
	$sql = "select <#
	nprop = 0
	for each Field in View.Fields where Field.Property.Type<>"Id"
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
	for each Field in View.Fields where Field.Property.Type<>"Id"
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

<#
	for each Field in View.Fields where Field.Property.Reference
#>
	$Translation${Field.Property.Name} = "<a href='${Field.Property.Reference.Name}View.php?Id=".$${Field.Property.Name}. "'>".TranslateDescription("$Cfg[SqlPrefix]${Field.Property.Reference.SqlTable}",$${Field.Property.Name},"${Field.Property.Reference.DescriptorProperty.Name}","${Field.Property.Reference.IdProperty.Name}")."</a>";
<#
	end for
#>
<#
	for each Field in View.Fields where Field.Property.Enumeration
#>
	$Translation${Field.Property.Name} = TranslateEnumeration($Enum${Field.Property.Enumeration.Name},$${Field.Property.Name});
<#
	end for
#>

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="${Entity.Name}List.php">${Entity.SetDescriptor}</a>
<a class="btn btn-primary" href="${Entity.Name}Form.php?Id=<? echo $Id; ?>">${UpdateText}</a>
<a class="btn btn-danger" href="${Entity.Name}Delete.php?Id=<? echo $Id; ?>">${DeleteText}</a>
</div>

<?
	TableOpen('', '', 'view');
<#
	for each Field in View.Fields
		if Field.Property.Reference or Field.Property.Enumeration then
#>
	FieldStaticGenerate("${Field.Description}",$Translation${Field.Property.Name});
<#
		else 
			if Field.Type="Boolean" then
#>
	FieldStaticGenerate("${Field.Description}",TranslateBoolean($${Field.Property.Name}, '${YesText}', '${NoText}'));
<#
			end if
			if Field.Type="Text" then
#>
	FieldStaticGenerate("${Field.Description}",$${Field.Property.Name});
<#
			end if
			if Field.Type="Memo" then
#>
	FieldStaticMemoGenerate("${Field.Description}",$${Field.Property.Name});
<#
			end if
		end if
	end for
#>
	TableClose();
?>

<#
	for each List in View.Lists
		Entity = List.Entity
		EntityIdProperty = IdProperty(Entity)
        NewText = TextForNew(Project.Language, Entity.Gender)
#>
<br>
<br>
<h2>${List.Title}</h2>
<div class="btn-group">
<a class="btn" href='${List.Entity.Name}Form.php?${List.KeyProperty.Name}=<?=$Id?>'>${NewText} ${List.Entity.Descriptor}...</a>
</div>
<?
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
	if List.KeyProperty then
#>
	$sql .= " where ${List.KeyProperty.Name} = $Id";
<#
	end if

	if List.Order then
#>
	$sql .= " order by ${List.Order}";

<#
	end if
#>
	$rs = DbExecuteQuery($sql);

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
		end for 
	
		if List.CanDelete or List.CanMove then
			print ", 'Acciones'"
		end if
#>);
?>

<?		
	TableOpen($titles);

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		unset($actions);
<#
	ncol = 0
	for each Column in List.Columns
		if ncol=0 then
#>
		DatumLinkGenerate("${ViewName}...","${Entity.Name}View.php?Id=".$reg['Id']);
<#
		else
			if Column.Property.Reference then
#>
		$ColumnDescription = ${Column.Property.Reference.Name}Translate($reg['${Column.Property.Name}']);
		DatumLinkGenerate($ColumnDescription, "${Column.Property.Reference.Name}View.php?Id=".$reg['${Column.Property.Name}']);
<#
			else
#>
		DatumGenerate($reg['${Column.Property.Name}']);
<#
			end if
		end if
		ncol=ncol+1
	end for

	if List.CanMove then
#>
		$actions['Up'] = '${View.Entity.Name}${List.Relation.Name}Move.php?Id='.$Id.'&Id${List.Entity.Name}='.$reg['${List.Entity.IdProperty.Name}'].'&Action=down';
		$actions['Down'] = '${View.Entity.Name}${List.Relation.Name}Move.php?Id='.$Id.'&Id${List.Entity.Name}='.$reg['${List.Entity.IdProperty.Name}'].'&Action=up';
<#
	end if

	if List.CanDelete then
#>
		$actions['Delete'] = '${List.Entity.Name}Delete.php?Id='.$reg['${List.Entity.IdProperty.Name}'];
<#
	end if
#>
		if ($actions) {
			$actiontext = '';

			foreach ($actions as $text => $link)
				$actiontext .= " <a href='$link'>$text</a>";

			DatumGenerate($actiontext);
		}
			
		RowClose();
	}

	TableClose();
?>

<#
	end for
#>

<#
	nrel = 0
	for each Relation in Entity.Relations where Relation.RelationType="Referenced"
		nrel = nrel+1
        NewText = TextForNew(Project.Language, Relation.Entity.Gender)
#>
<h2>${Relation.Entity.SetDescriptor}</h2>
<div class="btn-group">
<a class="btn btn-primary" href='${Relation.Entity.Name}Form.php?${Relation.Property.Name}=<?=$Id?>'>${NewText} ${Relation.Entity.Descriptor}...</a>
</div>

<br />

<div>
<?
	$rs${Relation.Entity.SetName} = ${Relation.Entity.Name}GetBy${Entity.Name}($${Entity.IdProperty.Name});

	$titles = array(<# 
		ncol = 0
		for each Column in Relation.Entity.List.Columns where Column.Property.Name <> Relation.Property.Name
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

	TableOpen($titles);

	while ($reg=DbNextRow($rs${Relation.Entity.SetName})) {
		RowOpen();
<#
	ncol = 0
	for each Column in Relation.Entity.List.Columns where Column.Property.Name <> Relation.Property.Name
		if ncol=0 then
#>
		DatumLinkGenerate("${ViewText}...","${Relation.Entity.Name}View.php?Id=".$reg['Id']);
<#
		else
			if Column.Property.Reference then
#>
		$ColumnDescription = ${Column.Property.Reference.Name}Translate($reg['${Column.Property.Name}']);
		DatumLinkGenerate($ColumnDescription, "${Column.Property.Reference.Name}View.php?Id=".$reg['${Column.Property.Name}']);
<#
			else
                if Column.Property.Type = "Boolean" then
#>
		DatumGenerate(TranslateBoolean($reg['${Column.Property.Name}'], '${YesText}', '${NoText}'));
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

	DbFreeResult($rs${Relation.Entity.SetName});
?>
</div>
<#
	end for
#>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>