<?
	$Page->Title = 'Propiedades';
	include_once('./Security.inc.php');
	include_once($Page->Prefix.'includes/Header.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');
	include_once($Page->Prefix.'includes/Enumerations.inc.php');

	DbConnect();

    $sql = "select prop.Id, prop.Nombre, prop.Domicilio, prop.IdTipo, tipo.Nombre as TipoNombre, zona.Nombre as ZonaNombre, prop.Operacion, prop.IdZona, prop.Precio, prop.Ambientes, prop.IdMoneda, imagen.NombreArchivo, imagen.Uuid from $Cfg[SqlPrefix]propiedades as prop left join $Cfg[SqlPrefix]propiedadimagenes as imagen on prop.Id = imagen.IdPropiedad , $Cfg[SqlPrefix]zonas as zona, $Cfg[SqlPrefix]tipospropiedad as tipo where prop.IdTipo = tipo.Id and imagen.Principal = 1 and prop.IdZona = zona.Id order by prop.Id desc limit 0, 20";
    $rs = DbExecuteQuery($sql);

	while ($reg=DbNextRow($rs)) {
        $TranslationOperacion = TranslateEnumeration($EnumOperacion,$reg['Operacion']);
?>
<div class='propitem'>
<div class='propname'>
</div>
<div>
<a href="<?= $Page->Prefix ?>PropertyView.php?Id=<?= $rs['Id'] ?>">
<img src="<?= $Page->Prefix ?>images/photos/<?= $reg['Uuid'] . '.' . pathinfo($reg['NombreArchivo'], PATHINFO_EXTENSION)?>" border="0" width="200"/>
</a>
</div>
<div>
<span class='proptipo'><?= $reg['TipoNombre'] ?></span> <span class='propoper'>en <?= $TranslationOperacion ?></span>
</div>
<div class='propzona'><?= $reg['ZonaNombre'] ?></div>
<div><a href="<?= $Page->Prefix ?>PropertyView.php?Id=<?= $rs['Id'] ?>">Ver...</a></div>
</div>
<?
    }
?>

<?
    DbFreeResult($rs);
	DbDisconnect();
	include_once('includes/Footer.inc.php');
?>
