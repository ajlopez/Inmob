<?php
    include_once('./Configuration.inc.php');
	$Page->Title = 'Propiedades';
	include_once('./Security.inc.php');
	include_once($Page->Prefix.'includes/Header.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');
	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/EventoFunctionsEx.inc.php');

	DbConnect();
	
	EventoWrite('HOME');

    $sql = "select prop.Id, prop.Nombre, prop.Domicilio, prop.IdTipo,
                prop.Operacion, prop.IdZona, prop.Precio, prop.Ambientes,
                prop.Metros, prop.IdMoneda,
                tipo.Nombre as TipoNombre, zona.Nombre as ZonaNombre, 
                moneda.Simbolo, imagen.NombreArchivo, imagen.Uuid 
            from 
                $Cfg[SqlPrefix]propiedades as prop 
                    left join $Cfg[SqlPrefix]propiedadimagenes as imagen on prop.Id = imagen.IdPropiedad and imagen.Principal = 1 and imagen.Habilitada = 1,
                $Cfg[SqlPrefix]zonas as zona,
                $Cfg[SqlPrefix]tipospropiedad as tipo, $Cfg[SqlPrefix]monedas as moneda  
            where 
                prop.Habilitada = 1 and 
                prop.IdTipo = tipo.Id and 
                prop.IdZona = zona.Id and 
                prop.IdMoneda = moneda.Id";

    if ($IdZona)
        $sql .= " and (prop.IdZona = $IdZona or zona.IdZonaPadre = $IdZona)";
    if ($IdTipo)
        $sql .= " and prop.IdTipo = $IdTipo";
    if ($Operacion)
        $sql .= " and prop.Operacion = $Operacion";

    $sql .= " order by imagen.Principal desc, prop.Id desc limit 0, 20";
    $rs = DbExecuteQuery($sql);

    $rsIdTipo = TranslateQuery("$Cfg[SqlPrefix]tipospropiedad","Nombre as Nombre");
    $rsIdZona = TranslateQuery("$Cfg[SqlPrefix]zonas","Nombre as Nombre");
    $rsIdZona = TranslateQuery("$Cfg[SqlPrefix]zonas","Nombre as Nombre");
?>
<div class='search'>
<form method='post'>
Zona <? ComboRsGenerate('IdZona', $rsIdZona, $IdZona, 'Id', 'Nombre', true, false); ?>
Tipo <? ComboRsGenerate('IdTipo', $rsIdTipo, $IdTipo, 'Id', 'Nombre', true, false); ?>
Operación <? ComboHashGenerate('Operacion', $EnumOperacion, $Operacion, true); ?>
<input class='btn btn-primary' type='submit' name='Ok' value='Buscar'>
</form>
</div>
<?php
	while ($reg=DbNextRow($rs)) {
        $TranslationOperacion = TranslateEnumeration($EnumOperacion,$reg['Operacion']);
?>
<div class='propitem'>
<div class='propname'>
</div>
<div>
<span class='proptipo'><?= $reg['TipoNombre'] ?></span> <span class='propoper'>en <?= $TranslationOperacion ?></span>
</div>
<?php
    if ($reg['Uuid']) {
?>
<div class='propimagen'>
<a href="<?= $Page->Prefix ?>PropiedadView.php?Id=<?= $reg['Id'] ?>">
<img src="<?= $Page->Prefix ?>images/photos/<?= $reg['Uuid'] . '.' . pathinfo($reg['NombreArchivo'], PATHINFO_EXTENSION)?>" border="0" width="200"/>
</a>
</div>
<?php
    }
?>
<div class='propzona'><?= $reg['ZonaNombre'] ?></div>
<div>
<?php
    if ($reg['Precio']) {
?>
<?= $reg['Simbolo'] ?> <?= $reg['Precio'] ?>.
<?php
    }
?>
<?php
    if ($reg['Ambientes']) {
?>
<?= $reg['Ambientes'] ?> <?= $reg['Ambientes'] == 1 ? 'Ambiente' : 'Ambientes' ?>.
<?php
    }
?>
<?php
    if ($reg['Metros']) {
?>
<?= $reg['Metros'] ?> m2.
<?php
    }
?>
</div>
<div><a href="<?= $Page->Prefix ?>PropiedadView.php?Id=<?= $reg['Id'] ?>">Ver...</a></div>
</div>
<?php
    }
?>

<?php
    DbFreeResult($rs);
	DbDisconnect();
	include_once('includes/Footer.inc.php');
?>
