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
<?php echo $title; ?>
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

function MenuLeftAbsoluteOption($text,$link)
{
	echo "&nbsp;";
	echo "<a target='_top' href='$link' class='menuoption'>$text</a>";
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
	MenuLeftOption('Inicio','index.php');
	MenuLeftClose();

	if (UserIdentified() && UserIsAdministrator()) {
		MenuLeftOpen('Entidades');
		MenuLeftOption('Consorcios','admin/ConsorcioList.php');
		MenuLeftOption('Unidades','admin/UnidadList.php');
		MenuLeftOption('Documentos','admin/DocumentoConsorcioList.php');
		MenuLeftOption('Usuarios','admin/UserList.php');
		MenuLeftOption('Eventos','admin/EventoList.php');
		MenuLeftClose();
	}
	
	if (UserIdentified()) {
		MenuLeftOpen(UserName());
		MenuLeftOption('Mis Datos', 'users/User.php');
		MenuLeftOption('Mis Documentos', 'users/DocumentoList.php');
		if (UserHasMultiple())
			MenuLeftOption('Mis Reservas', 'users/ReservaListEx.php');
		MenuLeftOption('Salir','users/Logout.php');
		MenuLeftClose();
	}
	else {
		MenuLeftOpen('Usuarios');
		if ($Cfg['UserLogin'])
			MenuLeftAbsoluteOption('Ingreso',$Cfg['UserLogin']);
		else
			MenuLeftOption('Ingreso','users/Login.php');
		MenuLeftOption('Registración','users/Register.php');
		MenuLeftClose();
	}
?>
