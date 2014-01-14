<?php
	include_once($Page->Prefix.'includes/Users.inc.php');
?>
<br>

<?php
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
<?php
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

<?php
}
?>

<?php

	MenuLeftOpen($Cfg['SiteName']);
	MenuLeftOption('Principal','index.php');
	MenuLeftClose();

	MenuLeftOpen('Entidades');
	MenuLeftOption('Usuarios','admin/UserList.php');
	MenuLeftOption('Inmobiliarias','admin/InmobiliariaList.php');
	MenuLeftOption('Propiedades','admin/PropiedadList.php');
	MenuLeftOption('Imágenes de Propiedades','admin/ImagenPropiedadList.php');
	MenuLeftOption('Zonas','admin/ZonaList.php');
	MenuLeftOption('Tipos de Propiedad','admin/TipoPropiedadList.php');
	MenuLeftOption('Monedas','admin/MonedaList.php');
	MenuLeftClose();

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
?>
