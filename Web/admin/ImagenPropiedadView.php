<?
	$Page->Title = 'Imagen de Propiedad';
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
	include_once($Page->Prefix.'includes/ImagenPropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/ImagenPropiedadFunctionsEx.inc.php');

	DbConnect();
	
	SessionPut('ImagenPropiedadLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = ImagenPropiedadGetById($Id);
	$Nombre = $rs['Nombre'];
	$Descripcion = $rs['Descripcion'];
	$NombreArchivo = $rs['NombreArchivo'];
	$Uuid = $rs['Uuid'];
	$IdPropiedad = $rs['IdPropiedad'];
	$Notas = $rs['Notas'];
	$Principal = $rs['Principal'];
	$Habilitada = $rs['Habilitada'];

	$TranslationIdPropiedad = "<a href='PropiedadView.php?Id=".$IdPropiedad. "'>".TranslateDescription("$Cfg[SqlPrefix]propiedades",$IdPropiedad,"Nombre","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="ImagenPropiedadList.php">Imágenes de Propiedades</a>
<a class="btn btn-primary" href="ImagenPropiedadForm.php?Id=<? echo $Id; ?>">Actualiza</a>
<a class="btn btn-danger" href="ImagenPropiedadDelete.php?Id=<? echo $Id; ?>">Elimina</a>
</div>
<?
    if ($Uuid && $NombreArchivo) {
?>
<div>
<img src="<?= $Page->Prefix ?>images/photos/<?= $Uuid . '.' . pathinfo($NombreArchivo, PATHINFO_EXTENSION)?>" border="0"/>
</div>
<?
    }
    
	TableOpen('', '', 'view');
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticMemoGenerate("Descripción",$Descripcion);
	FieldStaticGenerate("Nombre de Archivo",$NombreArchivo);
	FieldStaticGenerate("Código Interno",$Uuid);
    if ($Uuid)
        FieldStaticGenerate("Nombre Interno de Archivo", ImagenPropiedadNombreArchivo($Uuid, $NombreArchivo));
	FieldStaticGenerate("Propiedad",$TranslationIdPropiedad);
	FieldStaticMemoGenerate("Notas",$Notas);
	FieldStaticGenerate("Es La Foto Principal",TranslateBoolean($Principal, 'S&iacute;', 'No'));
	FieldStaticGenerate("Habilitada",TranslateBoolean($Habilitada, 'S&iacute;', 'No'));
	TableClose();
?>



<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
