<?
	include_once($Page->Prefix.'includes/Users.inc.php');
?>
<div class="navbar">
<div class="navbar-inner">
<div class="container">
<div class="nav">
<ul class="nav">

<?
function MenuTop($text, $link)
{
	global $Page;
?>
  <li class="">
	<a href="<?= $Page->Prefix ?><?= $link ?>"><?= $text ?></a>
  </li>
<?
}

function MenuTopOpen($title)
{
?>
  <li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $title ?><b class="caret"></b></a>
	<ul class="dropdown-menu">
<?
}

function MenuTopOption($text, $link)
{
	global $Page;
?>
    <li><a href="<?= $Page->Prefix ?><?= $link ?>"><?= $text ?></a></li>
<?
}

function MenuTopClose()
{
?>
    </ul>
  </li>
<?
}

?>

<?
	MenuTop($Cfg['SiteName'], 'index.php');

	MenuTopOpen('Entidades');
<#
	for each List in Project.Model.Lists
#>
	MenuTopOption('${List.Title}','${WebDir}${List.Entity.Name}List.php');
<#
	end for
#>
	MenuTopClose();
<#
	if Project.HasUsers then
#>

	if (UserIdentified()) {
		MenuTopOpen(UserName());
		MenuTopOption('Mi Página', 'users/User.php');
		If (UserIsAdministrator()) {
			MenuTopOption('Administración','admin/index.php');
		}
		MenuTopOption('Salir','users/Logout.php');
		MenuTopClose();
	}
	else {
		MenuTopOpen('Usuarios');
		MenuTopOption('Ingreso','users/Login.php');
		MenuTopOption('Registración','users/Register.php');
		MenuTopClose();
	}
<#
	end if
#>
?>
</ul>
</div>
</div>
</div>
</div>
