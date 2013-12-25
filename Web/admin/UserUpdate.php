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
	include_once($Page->Prefix.'includes/UserFunctionsEx.inc.php');

	$IdInmobiliaria += 0;

	if (empty($UserName))
		ErrorAdd('Debe ingresar Código');

    for ($k = 0; $k < strlen($UserName); $k++) 
        if (!($UserName[$k] >= 'a' && $UserName[$k] <= 'z' || $UserName[$k] >= '0' && $UserName[$k] <= '9')) {
            ErrorAdd('Sólo puede usar letras minúsculas o dígitos en Código');
            break;
        }
		
	if (empty($Id)) {
		if (empty($Password))
			ErrorAdd('Debe ingresar Contraseña');
		if (empty($Password2))
			ErrorAdd('Debe ingreser Reingreso de Contraseña');
		if ($Password <> $Password2)
			ErrorAdd('No coinciden las Contraseñas');
	}
	
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

    if (UserGetByUserName($UserName, $Id))
        ErrorAdd('Ya existe Usuario con ese Código');

	if (ErrorHas()) {
		DbDisconnect();
		include('UserForm.php');
		exit;
	}

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]users set
		UserName = '$UserName' , 
		FirstName = '$FirstName' , 
		LastName = '$LastName' , 
		Email = '$Email' , 
		Genre = '$Genre' , 
		IsAdministrator = '$IsAdministrator' , 
		Habilitado = '$Habilitado' , 
		Notas = '$Notas' , 
		IdInmobiliaria = $IdInmobiliaria , 
		EsAdmInmobiliaria = '$EsAdmInmobiliaria' 		";
		
	if (empty($Id))
	{
		$sql .= ", Password = Password('$Password') ";	
		$DateTimeInsert = date('Y-m-d H:i:s');
		$sql .= ", DateTimeInsert = '$DateTimeInsert'";
	}
	else
	{
		$DateTimeUpdate = date('Y-m-d H:i:s');
		$sql .= ", DateTimeUpdate = '$DateTimeUpdate'";
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

    if (empty($Id)) {
        $NewIdUser = DbLastId();
    }

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("UserLink");
	SessionRemove("UserLink");

    if ($NewIdUser)
        PageRedirect("admin/UserView.php?Id=$NewIdUser");

	PageAbsoluteRedirect($Link);
	exit;
?>
