<?php
    include_once('../Configuration.inc.php');
    
	if (!$Page->Prefix)
		$Page->Prefix = '../';
	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Validations.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');

	if (empty($IdPropiedad))
		ErrorAdd('Debe ingresar Propiedad');
	$IdPropiedad += 0;

	DbConnect();
	DbTransactionBegin();

	if (ErrorHas()) {
		DbDisconnect();
		include('ImagenPropiedadForm.php');
		exit;
	}
    
    if ($_FILES['Archivo'] && $_FILES['Archivo']['name'])
    {
        $NuevoNombreArchivo = $_FILES['Archivo']['name'];
        $ext = strtolower(pathinfo($NuevoNombreArchivo, PATHINFO_EXTENSION));
        
        if ($ext == 'bmp' || $ext == 'jpg' || $ext == 'gif' || $ext == 'png') {
            $NombreArchivo = $NuevoNombreArchivo;
            if (empty($Uuid))
                $Uuid = uniqid();
            $filename = $Uuid . '.' . $ext;
            copy($_FILES['Archivo']['tmp_name'], '../images/photos/' . $filename);
        }
    }

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]propiedadimagenes set
		Nombre = '$Nombre' , 
		Descripcion = '$Descripcion' , 
		NombreArchivo = '$NombreArchivo' , 
		IdPropiedad = $IdPropiedad , 
		Notas = '$Notas' , 
		Principal = '$Principal' , 
		Habilitada = '$Habilitada' 		";
		
	if (empty($Id) || !empty($Uuid))
	{
		$sql .= ", Uuid = '$Uuid'";
	}
	else
	{
	}

	if (!empty($Id))
		$sql .= " where Id=$Id";

	DbExecuteUpdate($sql);
    
    $dberror = DbLastSqlError();
    
    if ($dberror) {
        DbTransactionRollback();
        DbDisconnect();
        echo $dberror;
    }
    
    if ($Principal) {
        if (!$Id)
            $Id = DbLastId();
        $sql = "Update $Cfg[SqlPrefix]propiedadimagenes set Principal = 0 where IdPropiedad = $IdPropiedad and Id <> $Id";
        DbExecuteUpdate($sql);
    }

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("ImagenPropiedadLink");
	SessionRemove("ImagenPropiedadLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
