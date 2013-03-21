<?
	$Page->Title = 'Actualiza Agente';
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
	include_once($Page->Prefix.'includes/AgenteFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = AgenteGetById($Id);
		$Nombre = $rs['Nombre'];
		$Contacto = $rs['Contacto'];
		$Notas = $rs['Notas'];
		$NombreArchivo = $rs['NombreArchivo'];
		$Uuid = $rs['Uuid'];
		$IdInmobiliaria = $rs['IdInmobiliaria'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Agente";
		$IsNew = 1;
	}

	$rsIdInmobiliaria = TranslateQuery("$Cfg[SqlPrefix]inmobiliarias","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="AgenteList.php">Agentes</a>
<?
	if (!$IsNew) {
?>
<a class="btn btn-info" href="AgenteView.php?Id=<? echo $Id; ?>">Agente</a>
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="AgenteUpdate.php" method=post>

<?
	TableOpen('','','form');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, False);
	FieldMemoGenerate("Contacto", "Datos de Contacto", $Contacto, 10, 30, False);
	FieldMemoGenerate("Notas", "Notas (uso interno)", $Notas, 10, 30, False);
	FieldTextGenerate("NombreArchivo", "Nombre de Archivo", $NombreArchivo, 30, False);
	FieldTextGenerate("Uuid", "Código Interno", $Uuid, 30, False);
	FieldComboRsGenerate("IdInmobiliaria", "Inmobiliaria", $rsIdInmobiliaria, $IdInmobiliaria,"Id","Nombre", True, False);

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
