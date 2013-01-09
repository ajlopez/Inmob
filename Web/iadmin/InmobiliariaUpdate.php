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

    $Id = UserIdInmobiliaria();

	if (empty($Nombre))
		ErrorAdd('Debe ingresar Nombre');

	DbConnect();
	DbTransactionBegin();

	if (ErrorHas()) {
		DbDisconnect();
		include('InmobiliariaForm.php');
		exit;
	}

    $sql = "Update";

	$sql .= " $Cfg[SqlPrefix]inmobiliarias set
		Nombre = '$Nombre' , 
		Domicilio = '$Domicilio' , 
		Descripcion = '$Descripcion' , 
		Contacto = '$Contacto' , 
		Notas = '$Notas' ";
		
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

	$Link = SessionGet("InmobiliariaLink");
	SessionRemove("InmobiliariaLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
