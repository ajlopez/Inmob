<?php
    include_once('../Configuration.inc.php');
    
	$Page->Title = 'Actualiza Tipo de Propiedad';
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
	include_once($Page->Prefix.'includes/TipoPropiedadFunctions.inc.php');

	DbConnect();
	
	if (!ErrorHas() && isset($Id)) {
		$rs = TipoPropiedadGetById($Id);
		$Nombre = $rs['Nombre'];

		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$Page->Title = "Nuevo Tipo de Propiedad";
		$IsNew = 1;
	}


	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="TipoPropiedadList.php">Tipos de Propiedad</a>
<?php
	if (!$IsNew) {
?>
<a class="btn btn-info" href="TipoPropiedadView.php?Id=<?php echo $Id; ?>">Tipo de Propiedad</a>
<?php
	}
?>
</div>

<?php
	ErrorRender();
?>

<form action="TipoPropiedadUpdate.php" method=post>

<?php
	TableOpen('','','form');
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Nombre", "Nombre", $Nombre, 30, False);

	FieldOkGenerate();
	TableClose();
?>

<?php
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
