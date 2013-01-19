<?
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

    $IdInmobiliaria = UserIdInmobiliaria();

	$sql = "delete from $Cfg[SqlPrefix]propiedadimagenes where Id = $Id";

	DbConnect();

    $reg = ImagenPropiedadGetById($Id);

    if (!$reg)
        PageExit();

    $propiedad = PropiedadGetById($reg['IdPropiedad']);

    if (!$propiedad)
        PageExit();

    if ($propiedad['IdInmobiliaria'] <> $IdInmobiliaria)
        PageExit();

    if ($reg['Uuid']) {
        $ArchivoNombre = ImagenPropiedadNombreArchivo($reg['Uuid'], $reg['NombreArchivo']);
        //$ArchivoNombre = realpath($ArchivoNombre);
        //echo '../images/photos/' . $ArchivoNombre;
        if (file_exists('../images/photos/' . $ArchivoNombre))
            unlink('../images/photos/' . $ArchivoNombre);
    }

	DbExecuteUpdate($sql);
	DbDisconnect();

	$Link = SessionGet("ImagenPropiedadDeleteLink");
	SessionRemove("ImagenPropiedadDeleteLink");

	if ($Link)
		PageAbsoluteRedirect($Link);
	else
		PageAbsoluteRedirect('ImagenPropiedadList.php');

	exit;
?>
