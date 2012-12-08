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
	MenuLeftOption('Principal','index.php');
	MenuLeftClose();

	MenuLeftOpen('Entidades');
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
		MenuLeftOption('Mi Página', 'users/User.php');
		If (UserIsAdministrator()) {
			MenuLeftOption('Administración','admin/index.php');
		}
		MenuLeftOption('Salir','users/Logout.php');
		MenuLeftClose();
	}
	else {
		MenuLeftOpen('Usuarios');
		MenuLeftOption('Ingreso','users/Login.php');
		MenuLeftOption('Registración','users/Register.php');
		MenuLeftClose();
	}
<#
	end if
#>
?>
