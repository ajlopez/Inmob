<?php
    include_once('../Configuration.inc.php');
    
	if (!$Page->Prefix)
		$Page->Prefix = '../';
        
	include_once('./Security.inc.php');
	
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');

	include_once($Page->Prefix.'includes/PropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/ImagenPropiedadFunctions.inc.php');
	include_once($Page->Prefix.'includes/ImagenPropiedadFunctionsEx.inc.php');

	if (!isset($Id))
		PageExit();

	$sql = "delete from $Cfg[SqlPrefix]propiedades where Id = $Id";

	DbConnect();

    $imagenes = ImagenPropiedadGetList("IdPropiedad = $Id");

    while ($imagen = DbNextRow($imagenes)) {
        $Uuid = $imagen['Uuid'];
        $NombreArchivo = $imagen['NombreArchivo'];

        if ($Uuid) {
            $ArchivoNombre = ImagenPropiedadNombreArchivo($Uuid, $NombreArchivo);
            if (file_exists('../images/photos/' . $ArchivoNombre))
                unlink('../images/photos/' . $ArchivoNombre);
        }
    }

	DbFreeResult($imagenes);

	$sql = "delete from $Cfg[SqlPrefix]comentarios where IdPropiedad = $Id";
	DbExecuteUpdate($sql);

	$sql = "delete from $Cfg[SqlPrefix]propiedadimagenes where IdPropiedad = $Id";
	DbExecuteUpdate($sql);

	$sql = "delete from $Cfg[SqlPrefix]propiedades where Id = $Id";
	DbExecuteUpdate($sql);

	DbDisconnect();

	$Link = SessionGet("PropiedadDeleteLink");
	SessionRemove("PropiedadDeleteLink");

	if ($Link)
		PageAbsoluteRedirect($Link);
	else
		PageAbsoluteRedirect('PropiedadList.php');

	exit;
?>
