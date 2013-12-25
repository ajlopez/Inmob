<?php
    include_once('../Configuration.inc.php');
    
	$Page->Title = 'Moneda';
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
	include_once($Page->Prefix.'includes/MonedaFunctions.inc.php');
	include_once($Page->Prefix.'includes/PropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/ZonaFunctions.inc.php');
	include_once($Page->Prefix.'includes/InmobiliariaFunctions.inc.php');
	include_once($Page->Prefix.'includes/TipoPropiedadFunctions.inc.php');

	DbConnect();
	
	SessionPut('MonedaLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = MonedaGetById($Id);
	$Nombre = $rs['Nombre'];
	$Simbolo = $rs['Simbolo'];


	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="MonedaList.php">Monedas</a>
<a class="btn btn-primary" href="MonedaForm.php?Id=<?php echo $Id; ?>">Actualiza</a>
<a class="btn btn-danger" href="MonedaDelete.php?Id=<?php echo $Id; ?>">Elimina</a>
</div>

<?php
	TableOpen('', '', 'view');
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Símbolo",$Simbolo);
	TableClose();
?>


<h2>Propiedades</h2>
<div class="btn-group">
<a class="btn btn-primary" href='PropiedadForm.php?IdMoneda=<?=$Id?>'>Nueva Propiedad...</a>
</div>

<br />

<div>
<?php
	$rsPropiedades = PropiedadGetByMoneda($Id);

	$titles = array('', 'Nombre', 'Domicilio', 'Zona', 'Inmobiliaria', 'Tipo de Propiedad', 'Habilitada');

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
		$ColumnDescription = TipoPropiedadTranslate($reg['IdTipo']);
		DatumLinkGenerate($ColumnDescription, "TipoPropiedadView.php?Id=".$reg['IdTipo']);
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
