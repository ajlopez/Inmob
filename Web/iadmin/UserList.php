<?php
    include_once('../Configuration.inc.php');

	$Page->Title = 'Usuarios de Inmobiliaria';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');
	include_once($Page->Prefix . 'ajfwk/Translations.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/UserFunctions.inc.php');
	include_once($Page->Prefix . 'includes/InmobiliariaFunctions.inc.php');

    $IdInmobiliaria = UserIdInmobiliaria();

	SessionPut('UserLink',PageCurrent());

	DbConnect();

	$rs = UserGetListView("IdInmobiliaria = $IdInmobiliaria");

	$titles = array('', 'Código', 'Nombre', 'Apellido', 'Inmobiliaria', 'Habilitado', 'Administrador de Inmobiliaria');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-primary" href="UserForm.php">Nuevo Usuario...</a>
</div>

<?php		
	TableOpen($titles, '', 'list');

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate("Ver...", "UserView.php?Id=".$reg['Id']);
		DatumGenerate($reg['UserName']);
		DatumGenerate($reg['FirstName']);
		DatumGenerate($reg['LastName']);
		$ColumnDescription = InmobiliariaTranslate($reg['IdInmobiliaria']);
		DatumGenerate($ColumnDescription);
		DatumGenerate(TranslateBoolean($reg['Habilitado'], 'S&iacute;', 'No'));
		DatumGenerate(TranslateBoolean($reg['EsAdmInmobiliaria'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();
?>

<?php
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
