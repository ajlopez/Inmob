<?php
    include_once('../Configuration.inc.php');

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
	include_once($Page->Prefix.'includes/UsersEx.inc.php');

    $IdInmobiliaria = UserIdInmobiliaria();

    if (!$IdInmobiliaria)
        PageExit();

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = PropiedadGetById($Id);
		$Nombre = $rs['Nombre'];
		$Domicilio = $rs['Domicilio'];
		$Metros = $rs['Metros'];
		$Lote = $rs['Lote'];
		$Ambientes = $rs['Ambientes'];
		$Dormitorios = $rs['Dormitorios'];
		$Banios = $rs['Banios'];
		$Toilettes = $rs['Toilettes'];
		$Plantas = $rs['Plantas'];
		$IdTipo = $rs['IdTipo'];
		$Descripcion = $rs['Descripcion'];
		$Precio = $rs['Precio'];
		$IdMoneda = $rs['IdMoneda'];
		$Operacion = $rs['Operacion'];
		$IdInmobiliaria2 = $rs['IdInmobiliaria'];
		$IdZona = $rs['IdZona'];
		$IdAgente = $rs['IdAgente'];
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

    if ($IdInmobiliaria && $IdInmobiliaria2 && $IdInmobiliaria <> $IdInmobiliaria2)
        PageExit();

	$rsIdTipo = TranslateQuery("$Cfg[SqlPrefix]tipospropiedad","Nombre as Nombre");
	$rsIdMoneda = TranslateQuery("$Cfg[SqlPrefix]monedas","Nombre as Nombre");
	$rsIdZona = TranslateQuery("$Cfg[SqlPrefix]zonas","Nombre as Nombre");
	$rsIdAgente = TranslateQuery("$Cfg[SqlPrefix]agentes","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="PropiedadList.php">Propiedades</a>
<?php
	if (!$IsNew) {
?>
<a class="btn btn-info" href="PropiedadView.php?Id=<?php echo $Id; ?>">Propiedad</a>
<?php
	}
?>
</div>

<?php
	ErrorRender();
?>

<form action="PropiedadUpdate.php" method=post>

<?php
	TableOpen('','','form');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, False);
	FieldTextGenerate("Domicilio", "Domicilio", $Domicilio, 30, False);
	FieldTextGenerate("Metros", "Metros Cuadrados", $Metros, 30, False);
	FieldTextGenerate("Lote", "Metros Cuadrados Lote", $Lote, 30, False);
	FieldTextGenerate("Ambientes", "Ambientes", $Ambientes, 30, False);
	FieldTextGenerate("Dormitorios", "Dormitorios", $Dormitorios, 30, False);
	FieldTextGenerate("Banios", "Baños", $Banios, 30, False);
	FieldTextGenerate("Toilettes", "Toilettes", $Toilettes, 30, False);
	FieldTextGenerate("Plantas", "Plantas", $Plantas, 30, False);
	FieldComboRsGenerate("IdTipo", "Tipo de Propiedad", $rsIdTipo, $IdTipo,"Id","Nombre", False, True);
	FieldMemoGenerate("Descripcion", "Descripción", $Descripcion, 10, 30, False);
	FieldTextGenerate("Precio", "Precio", $Precio, 30, False);
	FieldComboRsGenerate("IdMoneda", "Moneda", $rsIdMoneda, $IdMoneda,"Id","Nombre", False, True);
	FieldComboHashGenerate("Operacion", "Operación", $EnumOperacion, $Operacion, False, True);
	FieldComboRsGenerate("IdZona", "Zona", $rsIdZona, $IdZona,"Id","Nombre", False, True);
	FieldComboRsGenerate("IdAgente", "Agente", $rsIdAgente, $IdAgente,"Id","Nombre", True, False);
	FieldMemoGenerate("Notas", "Notas (uso interno)", $Notas, 10, 30, False);
	FieldCheckGenerate("Habilitada", "Habilitada", $Habilitada, False);
	FieldCheckGenerate("AceptaComentarios", "Acepta Comentarios", $AceptaComentarios, False);

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
