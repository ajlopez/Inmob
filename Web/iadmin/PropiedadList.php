<?php
    include_once('../Configuration.inc.php');
    
	$Page->Title = 'Propiedades de la Inmobiliaria';

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

    $IdInmobiliaria = UserIdInmobiliaria();

	$rs = PropiedadGetListView("IdInmobiliaria = $IdInmobiliaria");

	$titles = array('', 'Nombre', 'Domicilio', 'Zona', 'Inmobiliaria', 'Tipo de Propiedad', 'Habilitada');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-primary" href="PropiedadForm.php">Nueva Propiedad...</a>
</div>

<?php	
	TableOpen($titles, '', 'list');

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate("Ver...", "PropiedadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Domicilio']);
		$ColumnDescription = ZonaTranslate($reg['IdZona']);
		DatumGenerate($ColumnDescription);
		$ColumnDescription = InmobiliariaTranslate($reg['IdInmobiliaria']);
		DatumGenerate($ColumnDescription);
		$ColumnDescription = TipoPropiedadTranslate($reg['IdTipo']);
		DatumGenerate($ColumnDescription);
		DatumGenerate(TranslateBoolean($reg['Habilitada'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();
?>

<?php
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
