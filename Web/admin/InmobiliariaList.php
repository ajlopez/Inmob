<?
	$Page->Title = 'Inmobiliarias';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');
	include_once($Page->Prefix . 'ajfwk/Translations.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/InmobiliariaFunctions.inc.php');
	include_once($Page->Prefix . 'includes/InmobiliariaFunctions.inc.php');

	SessionPut('InmobiliariaLink',PageCurrent());

	DbConnect();

	$rs = InmobiliariaGetListView();

	$titles = array('', 'Nombre', 'Domicilio', 'Sucursal de', 'Habilitada');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-primary" href="InmobiliariaForm.php">Nueva Inmobiliaria...</a>
</div>

<?		
	TableOpen($titles, '', 'list');

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate("Ver...", "InmobiliariaView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Domicilio']);
		$ColumnDescription = InmobiliariaTranslate($reg['IdInmobiliaria']);
		DatumLinkGenerate($ColumnDescription, "InmobiliariaView.php?Id=".$reg['IdInmobiliaria']);
		DatumGenerate(TranslateBoolean($reg['Habilitada'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
