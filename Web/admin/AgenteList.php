<?php
    include_once('../Configuration.inc.php');

	$Page->Title = 'Agentes';

	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix . 'ajfwk/Tables.inc.php');
	include_once($Page->Prefix . 'ajfwk/Pages.inc.php');
	include_once($Page->Prefix . 'ajfwk/Session.inc.php');
	include_once($Page->Prefix . 'ajfwk/Translations.inc.php');

	include_once($Page->Prefix . 'includes/Enumerations.inc.php');
	include_once($Page->Prefix . 'includes/AgenteFunctions.inc.php');
	include_once($Page->Prefix . 'includes/InmobiliariaFunctions.inc.php');

	SessionPut('AgenteLink',PageCurrent());

	DbConnect();

	$rs = AgenteGetListView();

	$titles = array('', 'Nombre', 'Datos de Contacto', 'Notas', 'Nombre de Archivo', 'Código Interno', 'Inmobiliaria');

	include_once($Page->Prefix . 'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-primary" href="AgenteForm.php">Nuevo Agente...</a>
</div>

<?php		
	TableOpen($titles, '', 'list');

	while ($reg=DbNextRow($rs)) {
		RowOpen();
		DatumLinkGenerate("Ver...", "AgenteView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Contacto']);
		DatumGenerate($reg['Notas']);
		DatumGenerate($reg['NombreArchivo']);
		DatumGenerate($reg['Uuid']);
		$ColumnDescription = InmobiliariaTranslate($reg['IdInmobiliaria']);
		DatumLinkGenerate($ColumnDescription, "InmobiliariaView.php?Id=".$reg['IdInmobiliaria']);
		RowClose();
	}

	TableClose();
?>

<?php
	include_once($Page->Prefix . 'includes/Footer.inc.php');
	DbDisconnect();
?>
