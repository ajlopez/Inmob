<?
	$Page->Title = 'Propiedad';

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
	include_once($Page->Prefix.'includes/MonedaFunctions.inc.php');
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

	$TranslationIdTipo = TranslateDescription("$Cfg[SqlPrefix]tipospropiedad",$IdTipo,"Nombre","Id");
	$TranslationIdMoneda = TranslateDescription("$Cfg[SqlPrefix]monedas",$IdMoneda,"Nombre","Id");
	$TranslationIdZona = TranslateDescription("$Cfg[SqlPrefix]zonas",$IdZona,"Nombre","Id");
	$TranslationIdInmobiliaria = TranslateDescription("$Cfg[SqlPrefix]inmobiliarias",$IdInmobiliaria,"Nombre","Id");
	$TranslationOperacion = TranslateEnumeration($EnumOperacion,$Operacion);

    $rsImagen = ImagenPropiedadGetList("IdPropiedad = $Id and Principal = 1");
    $regImagen = DbNextRow($rsImagen);
    DbFreeResult($rsImagen);

    $regMoneda = MonedaGetById($IdMoneda);

    $inmobiliaria = InmobiliariaGetById($IdInmobiliaria);

    if ($Nombre)
        $Page->Title = $Nombre;

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class='row-fluid'>
<div>
<span class='proptipo'><?= $TranslationIdTipo ?></span> <span class='propoper'>en <?= $TranslationOperacion ?></span>
</div>
<div class='propzona'><?= $TranslationIdZona ?></div>
<div>
<?= $Domicilio ?>
</div>
<?
    if ($Precio) {
?>
<div>
<?= $Precio ? $regMoneda['Simbolo'] . ' ' . $Precio: '' ?>
</div>
<?
    }
?>
</div>
<div>
<?= $Ambientes ? $Ambientes : '' ?>
<?= $Ambientes == 1 ? ' Ambiente. ' : ($Ambientes ? ' Ambientes. ' : ' ') ?>
<?= $Metros ? $Metros : '' ?>
<?= $Metros ? ' Metros Cuadrados. ' : '' ?>
</div>
</div>

<div class='row-fluid'>
<?
    if ($regImagen) {
        $Uuid = $regImagen['Uuid'];
        $NombreArchivo = $regImagen['NombreArchivo'];
		$archivoimagen = ImagenPropiedadNombreArchivo($Uuid, $NombreArchivo);
?>
<div class="propimagen">
<a data-jkit="[lightbox:group=images]" href="<?= $Page->Prefix ?>images/photos/<?= $archivoimagen ?>">
<img src="<?= $Page->Prefix ?>images/photos/<?= $archivoimagen ?>" border="0"/>
<br/>
<?= $regImagen['Nombre'] ?>
</a>
</div>
<?
    }
?>
<div>
<div class="caption">Descripción</div>
<?= $Descripcion ?>
</div>
<div class="caption">Inmobiliaria</div>
<div>
<?= $inmobiliaria['Nombre'] ?>
</div>
<div>
<?= $inmobiliaria['Contacto'] ?>
</div>
</div>
</div>

<div class='row-fluid' style='clear: both'>
<?
	$rsImagenesPropiedad = ImagenPropiedadGetList("IdPropiedad = $Id and Habilitada <> 0 and Principal = 0");

	while ($reg=DbNextRow($rsImagenesPropiedad)) {
		$archivoimagen = ImagenPropiedadNombreArchivo($reg['Uuid'], $reg['NombreArchivo']);
?>
<div class='galleryitem'>
<a data-jkit="[lightbox:group=images]" href="<?= $Page->Prefix ?>images/photos/<?= $archivoimagen ?>">
<img src="<?= $Page->Prefix ?>images/photos/<?= $archivoimagen ?>" border="0" width="200"/>
<?= $reg['Nombre'] ?>
</a>
</div>
<?
	}

	DbFreeResult($rsImagenesPropiedad);
?>
</div>
</div>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
<script type="text/javascript" src="<?= $Page->Prefix ?>js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="<?= $Page->Prefix ?>js/jquery.jkit.1.1.15.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('body').jKit();
});
</script>