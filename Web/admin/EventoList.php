<?
	$Page->Title = 'Eventos';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');
	include_once($Page->Prefix . 'ajfwk/Translations.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/EventoFunctions.inc.php');
	include_once($Page->Prefix . 'includes/UserFunctions.inc.php');
	include_once($Page->Prefix . 'includes/InmobiliariaFunctions.inc.php');

	SessionPut('EventoLink',PageCurrent());

	DbConnect();

	$rs = EventoGetList();

	$titles = array('Id', 'Tipo', 'Param&eacute;tro', 'Usuario', 'Fecha/Hora');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<?		
	TableOpen($titles, '', 'list');

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumGenerate($reg['Id']);
		DatumGenerate($reg['Tipo']);
		DatumGenerate($reg['IdParametro']);
		DatumGenerate($reg['IdUsuario']);
		DatumGenerate($reg['FechaHora']);
		RowClose();
	}

	TableClose();
?>

<?
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
