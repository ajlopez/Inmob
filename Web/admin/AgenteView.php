<?
	$Page->Title = 'Agente';
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
	include_once($Page->Prefix.'includes/AgenteFunctions.inc.php');

	DbConnect();
	
	SessionPut('AgenteLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = AgenteGetById($Id);
	$Nombre = $rs['Nombre'];
	$Contacto = $rs['Contacto'];
	$Notas = $rs['Notas'];
	$NombreArchivo = $rs['NombreArchivo'];
	$Uuid = $rs['Uuid'];
	$IdInmobiliaria = $rs['IdInmobiliaria'];

	$TranslationIdInmobiliaria = "<a href='InmobiliariaView.php?Id=".$IdInmobiliaria. "'>".TranslateDescription("$Cfg[SqlPrefix]inmobiliarias",$IdInmobiliaria,"Nombre","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="AgenteList.php">Agentes</a>
<a class="btn btn-primary" href="AgenteForm.php?Id=<? echo $Id; ?>">Actualiza</a>
<a class="btn btn-danger" href="AgenteDelete.php?Id=<? echo $Id; ?>">Elimina</a>
</div>

<?
	TableOpen('', '', 'view');
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticMemoGenerate("Datos de Contacto",$Contacto);
	FieldStaticMemoGenerate("Notas",$Notas);
	FieldStaticGenerate("Nombre de Archivo",$NombreArchivo);
	FieldStaticGenerate("Código Interno",$Uuid);
	FieldStaticGenerate("Inmobiliaria",$TranslationIdInmobiliaria);
	TableClose();
?>



<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
