<?
	$Page->Title = 'Actualiza Propiedad';
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
	include_once($Page->Prefix.'includes/PropiedadFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = PropiedadGetById($Id);
		$Nombre = $rs['Nombre'];
		$Domicilio = $rs['Domicilio'];
		$Metros = $rs['Metros'];
		$Ambientes = $rs['Ambientes'];
		$IdTipo = $rs['IdTipo'];
		$Descripcion = $rs['Descripcion'];
		$Precio = $rs['Precio'];
		$IdMoneda = $rs['IdMoneda'];
		$Operacion = $rs['Operacion'];
		$IdZona = $rs['IdZona'];
		$IdInmobiliaria = $rs['IdInmobiliaria'];
		$Notas = $rs['Notas'];
		$Habilitada = $rs['Habilitada'];
		$AceptaComentarios = $rs['AceptaComentarios'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nueva Propiedad";
		$IsNew = 1;
	}

	$rsIdTipo = TranslateQuery("$Cfg[SqlPrefix]tipospropiedad","Nombre as Nombre");
	$rsIdMoneda = TranslateQuery("$Cfg[SqlPrefix]monedas","Nombre as Nombre");
	$rsIdZona = TranslateQuery("$Cfg[SqlPrefix]zonas","Nombre as Nombre");
	$rsIdInmobiliaria = TranslateQuery("$Cfg[SqlPrefix]inmobiliarias","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="PropiedadList.php">Propiedades</a>
<?
	if (!$IsNew) {
?>
<a class="btn btn-info" href="PropiedadView.php?Id=<? echo $Id; ?>">Propiedad</a>
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="PropiedadUpdate.php" method=post>

<?
	TableOpen('','','form');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, False);
	FieldTextGenerate("Domicilio", "Domicilio", $Domicilio, 30, False);
	FieldTextGenerate("Metros", "Metros Cuadrados", $Metros, 30, False);
	FieldTextGenerate("Ambientes", "Ambientes", $Ambientes, 30, False);
	FieldComboRsGenerate("IdTipo", "Tipo de Propiedad", $rsIdTipo, $IdTipo,"Id","Nombre", False, True);
	FieldMemoGenerate("Descripcion", "Descripci�n", $Descripcion, 10, 30, False);
	FieldTextGenerate("Precio", "Precio", $Precio, 30, False);
	FieldComboRsGenerate("IdMoneda", "Moneda", $rsIdMoneda, $IdMoneda,"Id","Nombre", False, True);
	FieldComboHashGenerate("Operacion", "Operacion", $EnumOperacion, $Operacion, False, True);
	FieldComboRsGenerate("IdZona", "Zona", $rsIdZona, $IdZona,"Id","Nombre", False, True);
	FieldComboRsGenerate("IdInmobiliaria", "Inmobiliaria", $rsIdInmobiliaria, $IdInmobiliaria,"Id","Nombre", False, True);
	FieldMemoGenerate("Notas", "Notas", $Notas, 10, 30, False);
	FieldCheckGenerate("Habilitada", "Habilitada", $Habilitada, False);
	FieldCheckGenerate("AceptaComentarios", "Acepta Comentarios", $AceptaComentarios, False);

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