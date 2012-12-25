<?
	$Page->Title = 'Zonas';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');
	include_once($Page->Prefix . 'ajfwk/Translations.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/ZonaFunctions.inc.php');
	include_once($Page->Prefix . 'includes/ZonaFunctions.inc.php');

	SessionPut('ZonaLink',PageCurrent());

	DbConnect();

	$rs = ZonaGetListView();

	$titles = array('', 'Nombre', 'Zona Padre');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-primary" href="ZonaForm.php">Nueva Zona...</a>
</div>

<?		
	TableOpen($titles, '', 'list');

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate("Ver...", "ZonaView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		$ColumnDescription = ZonaTranslate($reg['IdZonaPadre']);
		DatumLinkGenerate($ColumnDescription, "ZonaView.php?Id=".$reg['IdZonaPadre']);
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
