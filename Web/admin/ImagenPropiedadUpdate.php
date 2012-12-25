<?
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
		
	if (empty($Id))
	{
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

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("ImagenPropiedadLink");
	SessionRemove("ImagenPropiedadLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
