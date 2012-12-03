<?
<#
	if WebDir then
#>
	if (!$Page->Prefix)
		$Page->Prefix = '../';
<#
	end if
#>
	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/classes/Entity.class.php');
	$Entity = new Entity();
	$Entity->Descriptor = '${Entity.Descriptor}';
	$Entity->SetDescriptor = '${Entity.SetDescriptor}';
	$Entity->Name = '${Entity.Name}';
	$Entity->SetName = '${Entity.SetName}';
	$Entity->Table = '${Entity.SqlTable}';
	
	$fld = new EntityField('Id');

<#
	for each Property in Entity.Properties
#>
	$Entity->Fields[] = new EntityField('${Property.Name}','${Property.Title}');
<#
	end for
#>

	include($Page->Prefix . 'ajfwk/pages/EntityView.page.php');
?>