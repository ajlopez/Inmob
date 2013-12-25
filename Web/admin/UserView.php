<?php
    include_once('../Configuration.inc.php');

	$Page->Title = 'Usuario';
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

	$TranslationIdInmobiliaria = "<a href='InmobiliariaView.php?Id=".$IdInmobiliaria. "'>".TranslateDescription("$Cfg[SqlPrefix]inmobiliarias",$IdInmobiliaria,"Nombre","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="UserList.php">Usuarios</a>
<a class="btn btn-primary" href="UserForm.php?Id=<?php echo $Id; ?>">Actualiza Datos</a>
<a class="btn btn-primary" href="UserLoginAs.php?Id=<?php echo $Id; ?>">Ingresar como este Usuario</a>
<a class="btn btn-primary" href="UserPasswordForm.php?Id=<?php echo $Id; ?>">Cambia Contraseña</a>
<a class="btn btn-danger" href="UserDelete.php?Id=<?php echo $Id; ?>">Elimina Usuario</a>
</div>

<?php
	TableOpen('', '', 'view');
	FieldStaticGenerate("Código",$UserName);
	FieldStaticGenerate("Nombre",$FirstName);
	FieldStaticGenerate("Apellido",$LastName);
	FieldStaticGenerate("Correo Electrónico",$Email);
	FieldStaticGenerate("Género",$Genre);
	FieldStaticGenerate("Es Administrador",TranslateBoolean($IsAdministrator, 'S&iacute;', 'No'));
	FieldStaticGenerate("Habilitado",TranslateBoolean($Habilitado, 'S&iacute;', 'No'));
	FieldStaticMemoGenerate("Notas (uso interno)",$Notas);
	FieldStaticGenerate("Inmobiliaria",$TranslationIdInmobiliaria);
	FieldStaticGenerate("Es Administrador de Inmobiliaria",TranslateBoolean($EsAdmInmobiliaria, 'S&iacute;', 'No'));
	TableClose();
?>


<h2>Comentarios</h2>
<div class="btn-group">
<a class="btn btn-primary" href='ComentarioForm.php?IdUser=<?=$Id?>'>Nuevo Comentario...</a>
</div>

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
<h2>Eventos</h2>
<div class="btn-group">
<a class="btn btn-primary" href='EventoForm.php?IdUsuario=<?=$Id?>'>Nuevo Evento...</a>
</div>

<br />

<div>
<?php
	$rsEventos = EventoGetByUser($Id);

	$titles = array();

	TableOpen($titles);

	while ($reg=DbNextRow($rsEventos)) {
		RowOpen();
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsEventos);
?>
</div>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
