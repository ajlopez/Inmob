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
	MenuTopOption('Usuarios','admin/UserList.php');
	MenuTopOption('Inmobiliarias','admin/InmobiliariaList.php');
	MenuTopOption('Propiedades','admin/PropiedadList.php');
	MenuTopOption('Imágenes de Propiedades','admin/ImagenPropiedadList.php');
	MenuTopOption('Zonas','admin/ZonaList.php');
	MenuTopOption('Tipos de Propiedad','admin/TipoPropiedadList.php');
	MenuTopOption('Monedas','admin/MonedaList.php');
	MenuTopClose();

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
?>
</ul>
</div>
</div>
</div>
</div>
