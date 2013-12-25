<?php
    include_once('../Configuration.inc.php');

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

	DbConnect();
	
	SessionPut('InmobiliariaLink',PageCurrent());


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

<div class="btn-group">
<a class="btn btn-info" href="InmobiliariaList.php">Inmobiliarias</a>
<a class="btn btn-primary" href="InmobiliariaForm.php?Id=<?php echo $Id; ?>">Actualiza</a>
<a class="btn btn-danger" href="InmobiliariaDelete.php?Id=<?php echo $Id; ?>">Elimina</a>
</div>

<?php
	TableOpen('', '', 'view');
	FieldStaticGenerate("Nombre",$Nombre);
	FieldStaticGenerate("Domicilio",$Domicilio);
	FieldStaticMemoGenerate("Descripción",$Descripcion);
	FieldStaticMemoGenerate("Datos de Contacto",$Contacto);
	FieldStaticMemoGenerate("Notas (uso interno)",$Notas);
	FieldStaticGenerate("Sucursal de",$TranslationIdInmobiliaria);
	FieldStaticGenerate("Habilitada",TranslateBoolean($Habilitada, 'S&iacute;', 'No'));
	TableClose();
?>


<h2>Propiedades</h2>
<div class="btn-group">
<a class="btn btn-primary" href='PropiedadForm.php?IdInmobiliaria=<?=$Id?>'>Nueva Propiedad...</a>
</div>

<br />

<div>
<?php
	$rsPropiedades = PropiedadGetByInmobiliaria($Id);

	$titles = array('', 'Nombre', 'Domicilio', 'Zona', 'Tipo de Propiedad', 'Habilitada');

	TableOpen($titles);

	while ($reg=DbNextRow($rsPropiedades)) {
		RowOpen();
		DatumLinkGenerate("Ver...","PropiedadView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Domicilio']);
		$ColumnDescription = ZonaTranslate($reg['IdZona']);
		DatumLinkGenerate($ColumnDescription, "ZonaView.php?Id=".$reg['IdZona']);
		$ColumnDescription = TipoPropiedadTranslate($reg['IdTipo']);
		DatumLinkGenerate($ColumnDescription, "TipoPropiedadView.php?Id=".$reg['IdTipo']);
		DatumGenerate(TranslateBoolean($reg['Habilitada'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsPropiedades);
?>
</div>
<h2>Inmobiliarias</h2>
<div class="btn-group">
<a class="btn btn-primary" href='InmobiliariaForm.php?IdInmobiliaria=<?=$Id?>'>Nueva Inmobiliaria...</a>
</div>

<br />

<div>
<?
	$rsInmobiliarias = InmobiliariaGetByInmobiliaria($Id);

	$titles = array('', 'Nombre', 'Domicilio', 'Habilitada');

	TableOpen($titles);

	while ($reg=DbNextRow($rsInmobiliarias)) {
		RowOpen();
		DatumLinkGenerate("Ver...","InmobiliariaView.php?Id=".$reg['Id']);
		DatumGenerate($reg['Nombre']);
		DatumGenerate($reg['Domicilio']);
		DatumGenerate(TranslateBoolean($reg['Habilitada'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsInmobiliarias);
?>
</div>
<h2>Usuarios</h2>
<div class="btn-group">
<a class="btn btn-primary" href='UserForm.php?IdInmobiliaria=<?=$Id?>'>Nuevo Usuario...</a>
</div>

<br />

<div>
<?php
	$rsUsers = UserGetByInmobiliaria($Id);

	$titles = array('', 'Código', 'Nombre', 'Apellido', 'Habilitado');

	TableOpen($titles);

	while ($reg=DbNextRow($rsUsers)) {
		RowOpen();
		DatumLinkGenerate("Ver...","UserView.php?Id=".$reg['Id']);
		DatumGenerate($reg['UserName']);
		DatumGenerate($reg['FirstName']);
		DatumGenerate($reg['LastName']);
		DatumGenerate(TranslateBoolean($reg['Habilitado'], 'S&iacute;', 'No'));
		RowClose();
	}

	TableClose();	

	DbFreeResult($rsUsers);
?>
</div>

<?php
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
