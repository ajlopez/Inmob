<?
	$Page->Title = 'Tipos de Propiedad';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');
	include_once($Page->Prefix . 'ajfwk/Translations.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/TipoPropiedadFunctions.inc.php');

	SessionPut('TipoPropiedadLink',PageCurrent());

	DbConnect();

	$rs = TipoPropiedadGetListView();

	$titles = array('', 'Nombre');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-primary" href="TipoPropiedadForm.php">Nuevo Tipo de Propiedad...</a>
</div>

<?		
	TableOpen($titles, '', 'list');

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate("Ver...", "TipoPropiedadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>