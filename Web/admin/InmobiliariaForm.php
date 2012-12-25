<?
	$Page->Title = 'Actualiza Inmobiliaria';
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
	include_once($Page->Prefix.'includes/InmobiliariaFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = InmobiliariaGetById($Id);
		$Nombre = $rs['Nombre'];
		$Domicilio = $rs['Domicilio'];
		$Descripcion = $rs['Descripcion'];
		$Contacto = $rs['Contacto'];
		$Notas = $rs['Notas'];
		$IdInmobiliaria = $rs['IdInmobiliaria'];
		$Habilitada = $rs['Habilitada'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nueva Inmobiliaria";
		$IsNew = 1;
	}

	$rsIdInmobiliaria = TranslateQuery("$Cfg[SqlPrefix]inmobiliarias","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="InmobiliariaList.php">Inmobiliarias</a>
<?
	if (!$IsNew) {
?>
<a class="btn btn-info" href="InmobiliariaView.php?Id=<? echo $Id; ?>">Inmobiliaria</a>
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="InmobiliariaUpdate.php" method=post>

<?
	TableOpen('','','form');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, true);
	FieldTextGenerate("Domicilio", "Domicilio", $Domicilio, 30, False);
	FieldMemoGenerate("Descripcion", "Descripción", $Descripcion, 10, 30, False);
	FieldMemoGenerate("Contacto", "Datos de Contacto", $Contacto, 10, 30, False);
	FieldMemoGenerate("Notas", "Notas", $Notas, 10, 30, False);
	FieldComboRsGenerate("IdInmobiliaria", "Sucursal de", $rsIdInmobiliaria, $IdInmobiliaria,"Id","Nombre", True, False);
	FieldCheckGenerate("Habilitada", "Habilitada", $Habilitada, False);

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
