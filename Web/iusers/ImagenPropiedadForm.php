<?
	$Page->Title = 'Actualiza Imagen de Propiedad';
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
	include_once($Page->Prefix.'includes/ImagenPropiedadFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = ImagenPropiedadGetById($Id);
		$Nombre = $rs['Nombre'];
		$Descripcion = $rs['Descripcion'];
		$NombreArchivo = $rs['NombreArchivo'];
		$Uuid = $rs['Uuid'];
		$IdPropiedad = $rs['IdPropiedad'];
		$Notas = $rs['Notas'];
		$Principal = $rs['Principal'];
		$Habilitada = $rs['Habilitada'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nueva Imagen de Propiedad";
		$IsNew = 1;
	}

	$rsIdPropiedad = TranslateQuery("$Cfg[SqlPrefix]propiedades","Nombre as Nombre", "IdInmobiliaria = " . UserIdInmobiliaria());

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="ImagenPropiedadList.php">Imágenes de Propiedades</a>
<?
	if (!$IsNew) {
?>
<a class="btn btn-info" href="ImagenPropiedadView.php?Id=<? echo $Id; ?>">Imagen de Propiedad</a>
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="ImagenPropiedadUpdate.php" method=post enctype="multipart/form-data">

<?
	TableOpen('','','form');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, False);
	FieldMemoGenerate("Descripcion", "Descripción", $Descripcion, 10, 30, False);
	FieldFileGenerate("Archivo", "Archivo");
	FieldComboRsGenerate("IdPropiedad", "Propiedad", $rsIdPropiedad, $IdPropiedad,"Id","Nombre", False, true);
	FieldMemoGenerate("Notas", "Notas", $Notas, 10, 30, False);
	FieldCheckGenerate("Principal", "Es La Foto Principal", $Principal, False);
	FieldCheckGenerate("Habilitada", "Habilitada", $Habilitada, False);

	FieldOkGenerate();
	TableClose();
?>

<?
	if (!$IsNew)
    {
		FieldIdGenerate($Id);
        FieldHiddenGenerate("Uuid", $Uuid);
        FieldHiddenGenerate("NombreArchivo", $NombreArchivo);
    }
?>

</form>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
