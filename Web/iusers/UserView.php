<?php
    include_once('../Configuration.inc.php');

	$Page->Title = 'Mis Datos';
	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');
	include_once($Page->Prefix.'includes/ComentarioFunctions.inc.php');
	include_once($Page->Prefix.'includes/EventoFunctions.inc.php');

	DbConnect();
	
	SessionPut('UserLink',PageCurrent());

    $Id = UserId();

	if (!isset($Id))
		PageExit();

	$rs = UserGetById($Id);
	$UserName = $rs['UserName'];
	$FirstName = $rs['FirstName'];
	$LastName = $rs['LastName'];
	$Email = $rs['Email'];
	$Genre = $rs['Genre'];
	$IsAdministrator = $rs['IsAdministrator'];
	$DateTimeInsert = $rs['DateTimeInsert'];
	$DateTimeUpdate = $rs['DateTimeUpdate'];
	$DateTimeLastLogin = $rs['DateTimeLastLogin'];
	$LoginCount = $rs['LoginCount'];
	$Habilitado = $rs['Habilitado'];
	$Notas = $rs['Notas'];
	$IdInmobiliaria = $rs['IdInmobiliaria'];
	$EsAdmInmobiliaria = $rs['EsAdmInmobiliaria'];

	$TranslationIdInmobiliaria = TranslateDescription("$Cfg[SqlPrefix]inmobiliarias",$IdInmobiliaria,"Nombre","Id");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-primary" href="UserForm.php">Actualiza Datos</a>
<a class="btn btn-primary" href="UserPasswordForm.php">Cambia Contraseña</a>
</div>

<?php
	TableOpen('', '', 'view');
	FieldStaticGenerate("Código",$UserName);
	FieldStaticGenerate("Nombre",$FirstName);
	FieldStaticGenerate("Apellido",$LastName);
	FieldStaticGenerate("Correo Electrónico",$Email);
	FieldStaticGenerate("Género",$Genre);
	FieldStaticGenerate("Habilitado",TranslateBoolean($Habilitado, 'S&iacute;', 'No'));
	FieldStaticMemoGenerate("Notas (uso interno)",$Notas);
	FieldStaticGenerate("Inmobiliaria",$TranslationIdInmobiliaria);
	TableClose();
?>


<h2>Sus Comentarios</h2>

<br />

<div>
<?php
	$rsComentarios = ComentarioGetByUser($Id);

	$titles = array();

	TableOpen($titles);

	while ($reg=DbNextRow($rsComentarios)) {
		RowOpen();
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsComentarios);
?>
</div>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
