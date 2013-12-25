<?php
    include_once('../Configuration.inc.php');
    
	$Page->Title = 'Tipo de Propiedad';
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
	include_once($Page->Prefix.'includes/TipoPropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/PropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/ZonaFunctions.inc.php');
	include_once($Page->Prefix.'includes/InmobiliariaFunctions.inc.php');

	DbConnect();
	
	SessionPut('TipoPropiedadLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = TipoPropiedadGetById($Id);
	$Nombre = $rs['Nombre'];


	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="TipoPropiedadList.php">Tipos de Propiedad</a>
<a class="btn btn-primary" href="TipoPropiedadForm.php?Id=<?php echo $Id; ?>">Actualiza</a>
<a class="btn btn-danger" href="TipoPropiedadDelete.php?Id=<?php echo $Id; ?>">Elimina</a>
</div>

<?php
	TableOpen('', '', 'view');
	FieldStaticGenerate("Nombre",$Nombre);
	TableClose();
?>


<h2>Propiedades</h2>
<div class="btn-group">
<a class="btn btn-primary" href='PropiedadForm.php?IdTipo=<?=$Id?>'>Nueva Propiedad...</a>
</div>

<br />

<div>
<?php
	$rsPropiedades = PropiedadGetByTipoPropiedad($Id);

	$titles = array('', 'Nombre', 'Domicilio', 'Zona', 'Inmobiliaria', 'Habilitada');

	TableOpen($titles);

	while ($reg=DbNextRow($rsPropiedades)) {
		RowOpen();
		DatumLinkGenerate("Ver...","PropiedadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Domicilio']);
		$ColumnDescription = ZonaTranslate($reg['IdZona']);
		DatumLinkGenerate($ColumnDescription, "ZonaView.php?Id=".$reg['IdZona']);
		$ColumnDescription = InmobiliariaTranslate($reg['IdInmobiliaria']);
		DatumLinkGenerate($ColumnDescription, "InmobiliariaView.php?Id=".$reg['IdInmobiliaria']);
		DatumGenerate(TranslateBoolean($reg['Habilitada'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsPropiedades);
?>
</div>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
