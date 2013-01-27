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

	include_once($Page->Prefix.'includes/UsersEx.inc.php');
	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/PropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/ImagenPropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/ImagenPropiedadFunctionsEx.inc.php');
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

    if (UserIdInmobiliaria() <> $IdInmobiliaria)
        PageExit();

	$TranslationIdTipo = TranslateDescription("$Cfg[SqlPrefix]tipospropiedad",$IdTipo,"Nombre","Id");
	$TranslationIdMoneda = TranslateDescription("$Cfg[SqlPrefix]monedas",$IdMoneda,"Nombre","Id");
	$TranslationIdZona = TranslateDescription("$Cfg[SqlPrefix]zonas",$IdZona,"Nombre","Id");
	$TranslationIdInmobiliaria = TranslateDescription("$Cfg[SqlPrefix]inmobiliarias",$IdInmobiliaria,"Nombre","Id");
	$TranslationOperacion = TranslateEnumeration($EnumOperacion,$Operacion);

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="PropiedadList.php">Propiedades</a>
<a class="btn btn-info" href="<?= $Page->Prefix ?>PropiedadView.php?Id=<? echo $Id; ?>">Ve</a>
<a class="btn btn-primary" href="PropiedadForm.php?Id=<? echo $Id; ?>">Actualiza</a>
</div>

<?
	TableOpen('', '', 'view');
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Domicilio",$Domicilio);
	FieldStaticGenerate("Tipo de Propiedad",$TranslationIdTipo);
	FieldStaticMemoGenerate("Descripci�n",$Descripcion);
	FieldStaticGenerate("Moneda",$TranslationIdMoneda);
	FieldStaticGenerate("Operacion",$TranslationOperacion);
	FieldStaticGenerate("Zona",$TranslationIdZona);
	FieldStaticGenerate("Inmobiliaria",$TranslationIdInmobiliaria);
	FieldStaticMemoGenerate("Notas",$Notas);
	FieldStaticGenerate("Habilitada",TranslateBoolean($Habilitada, 'S&iacute;', 'No'));
	FieldStaticGenerate("Acepta Comentarios",TranslateBoolean($AceptaComentarios, 'S&iacute;', 'No'));
	TableClose();
?>

<div class='row-fluid'>
<?
	$rsImagenesPropiedad = ImagenPropiedadGetByPropiedad($Id);

	while ($reg=DbNextRow($rsImagenesPropiedad)) {
		$archivoimagen = ImagenPropiedadNombreArchivo($reg['Uuid'], $reg['NombreArchivo']);
?>
<div class='galleryitem'>
<a href="ImagenPropiedadView.php?Id=<?= $reg['Id'] ?>">
<img src="<?= $Page->Prefix ?>images/photos/<?= $archivoimagen ?>" border="0" width="200"/>
</a>
</div>
<?
	}

	DbFreeResult($rsImagenesPropiedad);
?>
</div>


<h2>Im�genes de Propiedades</h2>
<div class="btn-group">
<a class="btn btn-primary" href='ImagenPropiedadForm.php?IdPropiedad=<?=$Id?>'>Nueva Imagen de Propiedad...</a>
</div>

<br />

<div>
<?
	$rsImagenesPropiedad = ImagenPropiedadGetByPropiedad($Id);

	$titles = array('', 'Nombre', 'Principal', 'Habilitada');

	TableOpen($titles);

	while ($reg=DbNextRow($rsImagenesPropiedad)) {
		RowOpen();
		DatumLinkGenerate("Ver...","ImagenPropiedadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate(TranslateBoolean($reg['Principal'], 'S&iacute;', 'No'));
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
