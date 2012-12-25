<?
	$Page->Title = 'Actualiza Zona';
	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/ZonaFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = ZonaGetById($Id);
		$Nombre = $rs['Nombre'];
		$IdZonaPadre = $rs['IdZonaPadre'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nueva Zona";
		$IsNew = 1;
	}

	$rsIdZonaPadre = TranslateQuery("$Cfg[SqlPrefix]zonas","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="ZonaList.php">Zonas</a>
<?
	if (!$IsNew) {
?>
<a class="btn btn-info" href="ZonaView.php?Id=<? echo $Id; ?>">Zona</a>
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="ZonaUpdate.php" method=post>

<?
	TableOpen('','','form');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, False);
	FieldComboRsGenerate("IdZonaPadre", "Zona Padre", $rsIdZonaPadre, $IdZonaPadre,"Id","Nombre", True, False);

	FieldOkGenerate();
	TableClose();
?>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
