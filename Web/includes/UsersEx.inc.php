<?
include_once($Page->Prefix.'includes/Users.inc.php');

function UserIdInmobiliaria() {
	$User = UserCurrent();
	return($User->IdInmobiliaria);
}

function UserEsAdmInmobiliaria() {
	$User = UserCurrent();
	return($User->EsAdmInmobiliaria);
}

function InmobiliariaControl($link='') {
	UserControl($link);

	if (!UserIdInmobiliaria())
		PageRedirect(PageMain());
}

function AdminInmobiliariaControl($link='') {
	UserControl($link);

	if (!UserEsAdminInmobiliaria())
		PageRedirect(PageMain());
}

?>