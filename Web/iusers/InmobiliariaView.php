<?
	$Page->Title = 'Inmobiliaria';
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
	include_once($Page->Prefix.'includes/InmobiliariaFunctions.inc.php');
	include_once($Page->Prefix.'includes/PropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');
	include_once($Page->Prefix.'includes/ZonaFunctions.inc.php');
	include_once($Page->Prefix.'includes/TipoPropiedadFunctions.inc.php');

    $Id = UserCurrent()->IdInmobiliaria;

	DbConnect();
	
	SessionPut('InmobiliariaLink',PageCurrent());
	SessionPut('PropiedadLink',PageCurrent());

	if (!isset($Id))
		PageExit();

	$rs = InmobiliariaGetById($Id);
	$Nombre = $rs['Nombre'];
	$Domicilio = $rs['Domicilio'];
	$Descripcion = $rs['Descripcion'];
	$Contacto = $rs['Contacto'];
	$Notas = $rs['Notas'];
	$IdInmobiliaria = $rs['IdInmobiliaria'];
	$Habilitada = $rs['Habilitada'];

	$TranslationIdInmobiliaria = "<a href='InmobiliariaView.php?Id=".$IdInmobiliaria. "'>".TranslateDescription("$Cfg[SqlPrefix]inmobiliarias",$IdInmobiliaria,"Nombre","Id")."</a>";

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<?
	TableOpen('', '', 'view');
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Domicilio",$Domicilio);
	FieldStaticMemoGenerate("Descripción",$Descripcion);
	FieldStaticMemoGenerate("Datos de Contacto",$Contacto);
	FieldStaticMemoGenerate("Notas",$Notas);
	FieldStaticGenerate("Sucursal de",$TranslationIdInmobiliaria);
	FieldStaticGenerate("Habilitada",TranslateBoolean($Habilitada, 'S&iacute;', 'No'));
	TableClose();
?>

<h2>Propiedades</h2>
<div class="btn-group">
<a class="btn btn-primary" href='PropiedadForm.php'>Nueva Propiedad...</a>
</div>

<br />

<div>
<?
	$rsPropiedades = PropiedadGetByInmobiliaria($Id);

	$titles = array('', 'Nombre', 'Domicilio', 'Zona', 'Tipo de Propiedad', 'Habilitada');

	TableOpen($titles);

	while ($reg=DbNextRow($rsPropiedades)) {
		RowOpen();
		DatumLinkGenerate("Ver...","PropiedadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Domicilio']);
		$ColumnDescription = ZonaTranslate($reg['IdZona']);
		DatumGenerate($ColumnDescription);
		$ColumnDescription = TipoPropiedadTranslate($reg['IdTipo']);
		DatumGenerate($ColumnDescription);
		DatumGenerate(TranslateBoolean($reg['Habilitada'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsPropiedades);
?>
</div>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
