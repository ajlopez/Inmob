<?php
    include_once('../Configuration.inc.php');

	$Page->Title = 'Cambia Contraseņa';
    
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

<?php
	ErrorRender();
?>

<form action="UserPasswordUpdate.php" method=post>

<?php
	TableOpen();
	
	FieldPasswordGenerate("Password", "Nueva Contraseņa", '', 10, True);
	FieldPasswordGenerate("Password2", "Reingrese Nueva Contraseņa", '', 10, True);

	FieldOkGenerate();
	TableClose();
?>

</form>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
