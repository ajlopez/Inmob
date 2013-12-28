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

    $Id = UserId();

	if (empty($FirstName))
		ErrorAdd('Debe ingresar Nombre');
	if (empty($LastName))
		ErrorAdd('Debe ingresar Apellido');
        
	if (ErrorHas()) {
		include('UserForm.php');
		exit;
	}

	DbConnect();
	DbTransactionBegin();

	if (ErrorHas()) {
		DbDisconnect();
		include('UserForm.php');
		exit;
	}

	$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]users set
		FirstName = '$FirstName' , 
		LastName = '$LastName' , 
		Email = '$Email' , 
		Genre = '$Genre' , 
		Notas = '$Notas' ";
		
    $DateTimeUpdate = date('Y-m-d H:i:s');
	$sql .= ", DateTimeUpdate = '$DateTimeUpdate'";

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

	$Link = SessionGet("UserLink");
	SessionRemove("UserLink");

    // PageRedirect("iusers/UserView.php");

	PageAbsoluteRedirect($Link);
	exit;
?>
