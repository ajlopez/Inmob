<?
	$Page->Title = 'Comentario';
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
	include_once($Page->Prefix.'includes/ComentarioFunctions.inc.php');

	DbConnect();
	
	SessionPut('ComentarioLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = ComentarioGetById($Id);
	$Texto = $rs['Texto'];
	$IdPropiedad = $rs['IdPropiedad'];
	$IdUser = $rs['IdUser'];

	$TranslationIdPropiedad = "<a href='PropiedadView.php?Id=".$IdPropiedad. "'>".TranslateDescription("$Cfg[SqlPrefix]propiedades",$IdPropiedad,"Nombre","Id")."</a>";
	$TranslationIdUser = "<a href='UserView.php?Id=".$IdUser. "'>".TranslateDescription("$Cfg[SqlPrefix]users",$IdUser,"UserName","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="ComentarioList.php">Comentarios</a>
<a class="btn btn-primary" href="ComentarioForm.php?Id=<? echo $Id; ?>">Actualiza</a>
<a class="btn btn-danger" href="ComentarioDelete.php?Id=<? echo $Id; ?>">Elimina</a>
</div>

<?
	TableOpen('', '', 'view');
	FieldStaticMemoGenerate("Texto",$Texto);
	FieldStaticGenerate("Propiedad",$TranslationIdPropiedad);
	FieldStaticGenerate("Usuario",$TranslationIdUser);
	TableClose();
?>



<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
