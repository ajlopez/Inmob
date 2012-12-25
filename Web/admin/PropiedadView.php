<?
	$Page->Title = 'Propiedad';
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
	include_once($Page->Prefix.'includes/PropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/ImagenPropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/ComentarioFunctions.inc.php');

	DbConnect();
	
	SessionPut('PropiedadLink',PageCurrent());


	if (!isset($Id))
		PageExit();

	$rs = PropiedadGetById($Id);
	$Nombre = $rs['Nombre'];
	$Domicilio = $rs['Domicilio'];
	$Metros = $rs['Metros'];
	$Ambientes = $rs['Ambientes'];
	$IdTipo = $rs['IdTipo'];
	$Descripcion = $rs['Descripcion'];
	$Precio = $rs['Precio'];
	$IdMoneda = $rs['IdMoneda'];
	$Operacion = $rs['Operacion'];
	$IdZona = $rs['IdZona'];
	$IdInmobiliaria = $rs['IdInmobiliaria'];
	$Notas = $rs['Notas'];
	$Habilitada = $rs['Habilitada'];
	$AceptaComentarios = $rs['AceptaComentarios'];

	$TranslationIdTipo = "<a href='TipoPropiedadView.php?Id=".$IdTipo. "'>".TranslateDescription("$Cfg[SqlPrefix]tipospropiedad",$IdTipo,"Nombre","Id")."</a>";
	$TranslationIdMoneda = "<a href='MonedaView.php?Id=".$IdMoneda. "'>".TranslateDescription("$Cfg[SqlPrefix]monedas",$IdMoneda,"Nombre","Id")."</a>";
	$TranslationIdZona = "<a href='ZonaView.php?Id=".$IdZona. "'>".TranslateDescription("$Cfg[SqlPrefix]zonas",$IdZona,"Nombre","Id")."</a>";
	$TranslationIdInmobiliaria = "<a href='InmobiliariaView.php?Id=".$IdInmobiliaria. "'>".TranslateDescription("$Cfg[SqlPrefix]inmobiliarias",$IdInmobiliaria,"Nombre","Id")."</a>";
	$TranslationOperacion = TranslateEnumeration($EnumOperacion,$Operacion);

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="PropiedadList.php">Propiedades</a>
<a class="btn btn-primary" href="PropiedadForm.php?Id=<? echo $Id; ?>">Actualiza</a>
<a class="btn btn-danger" href="PropiedadDelete.php?Id=<? echo $Id; ?>">Elimina</a>
</div>

<?
	TableOpen('', '', 'view');
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Domicilio",$Domicilio);
	FieldStaticGenerate("Tipo de Propiedad",$TranslationIdTipo);
	FieldStaticMemoGenerate("Descripción",$Descripcion);
	FieldStaticGenerate("Moneda",$TranslationIdMoneda);
	FieldStaticGenerate("Operacion",$TranslationOperacion);
	FieldStaticGenerate("Zona",$TranslationIdZona);
	FieldStaticGenerate("Inmobiliaria",$TranslationIdInmobiliaria);
	FieldStaticMemoGenerate("Notas",$Notas);
	FieldStaticGenerate("Habilitada",TranslateBoolean($Habilitada, 'S&iacute;', 'No'));
	FieldStaticGenerate("Acepta Comentarios",TranslateBoolean($AceptaComentarios, 'S&iacute;', 'No'));
	TableClose();
?>


<h2>Imágenes de Propiedades</h2>
<div class="btn-group">
<a class="btn btn-primary" href='ImagenPropiedadForm.php?IdPropiedad=<?=$Id?>'>Nueva Imagen de Propiedad...</a>
</div>

<br />

<div>
<?
	$rsImagenesPropiedad = ImagenPropiedadGetByPropiedad($Id);

	$titles = array('', 'Nombre', 'Habilitada');

	TableOpen($titles);

	while ($reg=DbNextRow($rsImagenesPropiedad)) {
		RowOpen();
		DatumLinkGenerate("Ver...","ImagenPropiedadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate(TranslateBoolean($reg['Habilitada'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsImagenesPropiedad);
?>
</div>
<h2>Comentarios</h2>
<div class="btn-group">
<a class="btn btn-primary" href='ComentarioForm.php?IdPropiedad=<?=$Id?>'>Nuevo Comentario...</a>
</div>

<br />

<div>
<?
	$rsComentarios = ComentarioGetByPropiedad($Id);

	$titles = array();

	TableOpen($titles);

	while ($reg=DbNextRow($rsComentarios)) {
		RowOpen();
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsComentarios);
?>
</div>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
