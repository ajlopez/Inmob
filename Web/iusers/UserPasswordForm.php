<?
	$Page->Title = 'Cambia Contraseña';
	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');

    $Id = UserId();
	
	if (!isset($Id))
		PageExit();

	DbConnect();
	
	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="UserView.php">Mis Datos</a>
</div>

<?
	ErrorRender();
?>

<form action="UserPasswordUpdate.php" method=post>

<?
	TableOpen();
	
	FieldPasswordGenerate("Password", "Nueva Contraseña", '', 10, True);
	FieldPasswordGenerate("Password2", "Reingrese Nueva Contraseña", '', 10, True);

	FieldOkGenerate();
	TableClose();
?>

</form>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
