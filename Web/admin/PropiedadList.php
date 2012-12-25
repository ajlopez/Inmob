<?
	$Page->Title = 'Propiedades';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');
	include_once($Page->Prefix . 'ajfwk/Translations.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/PropiedadFunctions.inc.php');
	include_once($Page->Prefix . 'includes/ZonaFunctions.inc.php');
	include_once($Page->Prefix . 'includes/InmobiliariaFunctions.inc.php');
	include_once($Page->Prefix . 'includes/TipoPropiedadFunctions.inc.php');

	SessionPut('PropiedadLink',PageCurrent());

	DbConnect();

	$rs = PropiedadGetListView();

	$titles = array('', 'Nombre', 'Domicilio', 'Zona', 'Inmobiliaria', 'Tipo de Propiedad', 'Habilitada');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-primary" href="PropiedadForm.php">Nueva Propiedad...</a>
</div>

<?		
	TableOpen($titles, '', 'list');

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate("Ver...", "PropiedadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Domicilio']);
		$ColumnDescription = ZonaTranslate($reg['IdZona']);
		DatumLinkGenerate($ColumnDescription, "ZonaView.php?Id=".$reg['IdZona']);
		$ColumnDescription = InmobiliariaTranslate($reg['IdInmobiliaria']);
		DatumLinkGenerate($ColumnDescription, "InmobiliariaView.php?Id=".$reg['IdInmobiliaria']);
		$ColumnDescription = TipoPropiedadTranslate($reg['IdTipo']);
		DatumLinkGenerate($ColumnDescription, "TipoPropiedadView.php?Id=".$reg['IdTipo']);
		DatumGenerate(TranslateBoolean($reg['Habilitada'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
