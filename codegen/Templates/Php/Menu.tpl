<?
	include_once($Page->Prefix.'includes/Users.inc.php');
?>
<br>

<?
function MenuLeftOpen($title)
{
?>
<div>
<table class="menu" cellspacing=1 cellpadding=2>
<tr>
<td align=center class="menutitle">
<? echo $title; ?>
</td>
</tr>
<tr>
<td valign="top" class="menuoption">
<?
}

function MenuLeftOption($text,$link)
{
	global $Page;

	echo "&nbsp;";
	echo "<a target='_top' href='$Page->Prefix$link' class='menuoption'>$text</a>";
	echo "<br>\n";
}

function MenuLeftClose()
{
?>
</td>
</tr>
</table>

<br>

</div>

<?
}
?>

<?

	MenuLeftOpen($Cfg['SiteName']);
	MenuLeftOption('Main','index.php');
	MenuLeftClose();

	MenuLeftOpen('Entities');
<#
	for each List in Project.Model.Lists
#>
	MenuLeftOption('${List.Title}','${WebDir}${List.Entity.Name}List.php');
<#
	end for
#>
	MenuLeftClose();
<#
	if Project.HasUsers then
#>

	if (UserIdentified()) {
		MenuLeftOpen(UserName());
		MenuLeftOption('My Page', 'users/User.php');
		If (UserIsAdministrator()) {
			MenuLeftOption('Administrator','admin/index.php');
		}
		MenuLeftOption('Logout','users/Logout.php');
		MenuLeftClose();
	}
	else {
		MenuLeftOpen('Users');
		MenuLeftOption('Login','users/Login.php');
		MenuLeftOption('Register','users/Register.php');
		MenuLeftClose();
	}
<#
	end if
#>
?>
