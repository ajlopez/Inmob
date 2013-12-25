<?php
    include_once('../Configuration.inc.php');

	$Page->Title = 'Actualiza Usuario';
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

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = UserGetById($Id);
		$UserName = $rs['UserName'];
		$FirstName = $rs['FirstName'];
		$LastName = $rs['LastName'];
		$Email = $rs['Email'];
		$Genre = $rs['Genre'];
		$IsAdministrator = $rs['IsAdministrator'];
		$Habilitado = $rs['Habilitado'];
		$Notas = $rs['Notas'];
		$IdInmobiliaria = $rs['IdInmobiliaria'];
		$EsAdmInmobiliaria = $rs['EsAdmInmobiliaria'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Usuario";
		$IsNew = 1;
	}

	$rsIdInmobiliaria = TranslateQuery("$Cfg[SqlPrefix]inmobiliarias","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="UserList.php">Usuarios</a>
<?php
	if (!$IsNew) {
?>
<a class="btn btn-info" href="UserView.php?Id=<?php echo $Id; ?>">Usuario</a>
<?php
	}
?>
</div>

<?php
	ErrorRender();
?>

<form action="UserUpdate.php" method=post>

<?php
	TableOpen('','','form');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("UserName", "Código", $UserName, 30, True);

	if ($IsNew) {
		FieldPasswordGenerate("Password", "Contraseña", '', 10, True);
		FieldPasswordGenerate("Password2", "Reingrese Contraseña", '', 10, True);
	}

	FieldTextGenerate("FirstName", "Nombre", $FirstName, 30, True);
	FieldTextGenerate("LastName", "Apellido", $LastName, 30, True);
	FieldTextGenerate("Email", "Correo Electrónico", $Email, 30, False);
	FieldTextGenerate("Genre", "Género", $Genre, 30, False);
	FieldCheckGenerate("IsAdministrator", "Es Administrador", $IsAdministrator, False);
	FieldCheckGenerate("Habilitado", "Habilitado", $Habilitado, False);
	FieldMemoGenerate("Notas", "Notas (uso interno)", $Notas, 10, 30, False);
	FieldComboRsGenerate("IdInmobiliaria", "Inmobiliaria", $rsIdInmobiliaria, $IdInmobiliaria,"Id","Nombre", True, False);
	FieldCheckGenerate("EsAdmInmobiliaria", "Es Administrador de Inmobiliaria", $EsAdmInmobiliaria, False);

	FieldOkGenerate();
	TableClose();
?>

<?php
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
