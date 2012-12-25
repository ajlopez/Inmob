<?
	$Page->Title = 'Actualiza Comentario';
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
	include_once($Page->Prefix.'includes/ComentarioFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = ComentarioGetById($Id);
		$Texto = $rs['Texto'];
		$IdPropiedad = $rs['IdPropiedad'];
		$IdUser = $rs['IdUser'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Comentario";
		$IsNew = 1;
	}

	$rsIdPropiedad = TranslateQuery("$Cfg[SqlPrefix]propiedades","Nombre as Nombre");
	$rsIdUser = TranslateQuery("$Cfg[SqlPrefix]users","UserName as UserName");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="ComentarioList.php">Comentarios</a>
<?
	if (!$IsNew) {
?>
<a class="btn btn-info" href="ComentarioView.php?Id=<? echo $Id; ?>">Comentario</a>
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="ComentarioUpdate.php" method=post>

<?
	TableOpen('','','form');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldMemoGenerate("Texto", "Texto", $Texto, 10, 30, False);
	FieldComboRsGenerate("IdPropiedad", "Propiedad", $rsIdPropiedad, $IdPropiedad,"Id","Nombre", False, True);
	FieldComboRsGenerate("IdUser", "Usuario", $rsIdUser, $IdUser,"Id","UserName", True, False);

	FieldOkGenerate();
	TableClose();
?>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
