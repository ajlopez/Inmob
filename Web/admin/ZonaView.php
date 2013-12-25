<?php
    include_once('../Configuration.inc.php');
    
	$Page->Title = 'Zona';
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
	include_once($Page->Prefix.'includes/ZonaFunctions.inc.php');
	include_once($Page->Prefix.'includes/PropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/InmobiliariaFunctions.inc.php');
	include_once($Page->Prefix.'includes/TipoPropiedadFunctions.inc.php');

	DbConnect();
	
	SessionPut('ZonaLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = ZonaGetById($Id);
	$Nombre = $rs['Nombre'];
	$IdZonaPadre = $rs['IdZonaPadre'];

	$TranslationIdZonaPadre = "<a href='ZonaView.php?Id=".$IdZonaPadre. "'>".TranslateDescription("$Cfg[SqlPrefix]zonas",$IdZonaPadre,"Nombre","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="ZonaList.php">Zonas</a>
<a class="btn btn-primary" href="ZonaForm.php?Id=<?php echo $Id; ?>">Actualiza</a>
<a class="btn btn-danger" href="ZonaDelete.php?Id=<?php echo $Id; ?>">Elimina</a>
</div>

<?php
	TableOpen('', '', 'view');
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Zona Padre",$TranslationIdZonaPadre);
	TableClose();
?>


<h2>Propiedades</h2>
<div class="btn-group">
<a class="btn btn-primary" href='PropiedadForm.php?IdZona=<?=$Id?>'>Nueva Propiedad...</a>
</div>

<br />

<div>
<?php
	$rsPropiedades = PropiedadGetByZona($Id);

	$titles = array('', 'Nombre', 'Domicilio', 'Inmobiliaria', 'Tipo de Propiedad', 'Habilitada');

	TableOpen($titles);

	while ($reg=DbNextRow($rsPropiedades)) {
		RowOpen();
		DatumLinkGenerate("Ver...","PropiedadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Domicilio']);
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
<h2>Zonas</h2>
<div class="btn-group">
<a class="btn btn-primary" href='ZonaForm.php?IdZonaPadre=<?=$Id?>'>Nueva Zona...</a>
</div>

<br />

<div>
<?php
	$rsZonas = ZonaGetByZona($Id);

	$titles = array('', 'Nombre');

	TableOpen($titles);

	while ($reg=DbNextRow($rsZonas)) {
		RowOpen();
		DatumLinkGenerate("Ver...","ZonaView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsZonas);
?>
</div>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
