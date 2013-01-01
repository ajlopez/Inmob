<?
	$Page->Title = 'Inmob';
	include_once('./Security.inc.php');
	include_once($Page->Prefix.'includes/Header.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	DbConnect();

    $sql = "select prop.Id, prop.Nombre, prop.Domicilio, prop.IdTipo, tipo.Nombre as TipoNombre, imagen.NombreArchivo, imagen.Uuid from $Cfg[SqlPrefix]propiedades as prop left join $Cfg[SqlPrefix]propiedadimagenes as imagen on prop.Id = imagen.IdPropiedad , $Cfg[SqlPrefix]tipospropiedad as tipo where prop.IdTipo = tipo.Id and imagen.Principal = 1 order by prop.Id desc";
    $rs = DbExecuteQuery($sql);
?>

<div>
<?= $sql ?>
</div>
<?
	while ($reg=DbNextRow($rs)) {
?>
<div class='propitem'>
<div class='propname'>
</div>
<div>
<img src="<?= $Page->Prefix ?>images/photos/<?= $reg['Uuid'] . '.' . pathinfo($reg['NombreArchivo'], PATHINFO_EXTENSION)?>" border="0" width="200"/>
</div>
</div>
<?
    }
?>

<?
    DbFreeResult($rs);
	DbDisconnect();
	include_once('includes/Footer.inc.php');
?>
