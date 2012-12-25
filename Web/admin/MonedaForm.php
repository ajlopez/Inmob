<?
	$Page->Title = 'Actualiza Moneda';
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
	include_once($Page->Prefix.'includes/MonedaFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = MonedaGetById($Id);
		$Nombre = $rs['Nombre'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nueva Moneda";
		$IsNew = 1;
	}


	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="MonedaList.php">Monedas</a>
<?
	if (!$IsNew) {
?>
<a class="btn btn-info" href="MonedaView.php?Id=<? echo $Id; ?>">Moneda</a>
<?
	}
?>
</div>


<?
	ErrorRender();
?>

<form action="MonedaUpdate.php" method=post>

<?
	TableOpen('','','form');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, False);

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
