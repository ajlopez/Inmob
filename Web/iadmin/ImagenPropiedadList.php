<?
	$Page->Title = 'Imágenes de Propiedades';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');
	include_once($Page->Prefix . 'ajfwk/Translations.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/ImagenPropiedadFunctions.inc.php');
	include_once($Page->Prefix . 'includes/ImagenPropiedadFunctionsEx.inc.php');
	include_once($Page->Prefix . 'includes/PropiedadFunctions.inc.php');

	SessionPut('ImagenPropiedadLink',PageCurrent());

	DbConnect();

	$rs = ImagenPropiedadInmobiliariaGetListView(UserIdInmobiliaria());

	$titles = array('', 'Nombre', 'Propiedad', 'Es Principal', 'Habilitada');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-primary" href="ImagenPropiedadForm.php">Nueva Imagen de Propiedad...</a>
</div>

<?		
	TableOpen($titles, '', 'list');

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate("Ver...", "ImagenPropiedadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		$ColumnDescription = PropiedadTranslate($reg['IdPropiedad']);
		DatumLinkGenerate($ColumnDescription, "PropiedadView.php?Id=".$reg['IdPropiedad']);
		DatumGenerate(TranslateBoolean($reg['Principal'], 'S&iacute;', 'No'));
		DatumGenerate(TranslateBoolean($reg['Habilitada'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
