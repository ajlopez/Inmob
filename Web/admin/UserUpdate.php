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

	$IdInmobiliaria += 0;

	DbConnect();
	DbTransactionBegin();

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

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
