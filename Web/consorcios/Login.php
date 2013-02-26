<?
	$Page->Title = "Ingreso de Usuario";

	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');

	include_once($Page->Prefix.'ajfwk/Translations.inc.php');
	include_once($Page->Prefix . 'ajfwk/Database.inc.php');

	DbConnect();

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
    $sql .= " order by imagen.Principal desc, prop.Id desc limit 0, 20";
    $rs = DbExecuteQuery($sql);

    $rsIdTipo = TranslateQuery("$Cfg[SqlPrefix]tipospropiedad","Nombre as Nombre");
    $rsIdZona = TranslateQuery("$Cfg[SqlPrefix]zonas","Nombre as Nombre");
    $rsIdZona = TranslateQuery("$Cfg[SqlPrefix]zonas","Nombre as Nombre");
	
	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div>
Ingrese su c&oacute;digo de usuario y su contrase&ntilde;a.
</div>

<?
	if ($Error && !$Errors)
		$Errors[] = $Error;

	ErrorRender();
	
	$url = $Cfg['SiteUrl'] . 'users/LoginValidateEx.php';
?>

<form action="<?= $url ?>" method=post>

<?
	TableOpen();
	FieldTextGenerate("UserName","Código de Usuario",$Codigo,16);
	FieldPasswordGenerate("Password","Contraseña",$Contrasenia,16);
	FieldOkGenerate();
	TableClose();
?>
</form>

</center>

<h2>ciapropiedades.com.ar</h2>

<?
	$Page->Prefix = '../';
	while ($reg=DbNextRow($rs)) {
        $TranslationOperacion = TranslateEnumeration($EnumOperacion,$reg['Operacion']);
?>
<div class='propitem'>
<div class='propname'>
</div>
<div>
<span class='proptipo'><?= $reg['TipoNombre'] ?></span> <span class='propoper'>en <?= $TranslationOperacion ?></span>
</div>
<?
    if ($reg['Uuid']) {
?>
<div class='propimagen'>
<a href="<?= $Page->Prefix ?>PropiedadView.php?Id=<?= $reg['Id'] ?>">
<img src="<?= $Page->Prefix ?>images/photos/<?= $reg['Uuid'] . '.' . pathinfo($reg['NombreArchivo'], PATHINFO_EXTENSION)?>" border="0" width="200"/>
</a>
</div>
<?
    }
?>
<div class='propzona'><?= $reg['ZonaNombre'] ?></div>
<div>
<?
    if ($reg['Precio']) {
?>
<?= $reg['Simbolo'] ?> <?= $reg['Precio'] ?>.
<?
    }
?>
<?
    if ($reg['Ambientes']) {
?>
<?= $reg['Ambientes'] ?> <?= $reg['Ambientes'] == 1 ? 'Ambiente' : 'Ambientes' ?>.
<?
    }
?>
<?
    if ($reg['Metros']) {
?>
<?= $reg['Metros'] ?> m2.
<?
    }
?>
</div>
<div><a href="<?= $Page->Prefix ?>PropiedadView.php?Id=<?= $reg['Id'] ?>">Ver...</a></div>
</div>
<?
    }
?>

<?
    DbFreeResult($rs);
	DbDisconnect();
	include_once('includes/Footer.inc.php');
?>

