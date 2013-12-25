<?php
    include_once('../Configuration.inc.php');
    
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
	
	if (!isset($Id))
		PageRedirect('admin/UserList.php');

	DbConnect();
	
	if (!ErrorHas()) {
		$rs = UserGetById($Id);
		$UserName = $rs['UserName'];
		$FirstName = $rs['FirstName'];
		$LastName = $rs['LastName'];
		$Email = $rs['Email'];
		$Genre = $rs['Genre'];
		$IsAdministrator = $rs['IsAdministrator'];
		$NoReserva = $rs['NoReserva']; 
		$Verified = $rs['Verified'];
		$Notas = $rs['Notas'];

		$IsNew = 0;
	}	

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="UserList.php">Usuarios</a>
<a class="btn btn-info" href="UserView.php?Id=<?php echo $Id; ?>">Usuario</a>
</div>

<?php
	ErrorRender();
?>

<form action="UserPasswordUpdate.php" method=post>

<?php
	TableOpen();
	FieldStaticGenerate("Id",$Id);

	FieldStaticGenerate("Código", $UserName);
	
	FieldPasswordGenerate("Password", "Nueva Contraseña", '', 10, True);
	FieldPasswordGenerate("Password2", "Reingrese Nueva Contraseña", '', 10, True);

	FieldOkGenerate();
	TableClose();

	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
