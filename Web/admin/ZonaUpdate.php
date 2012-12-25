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

	$IdZonaPadre += 0;

	DbConnect();
	DbTransactionBegin();

	if (ErrorHas()) {
		DbDisconnect();
		include('ZonaForm.php');
		exit;
	}

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]zonas set
		Nombre = '$Nombre' , 
		IdZonaPadre = $IdZonaPadre 		";
		
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

	$Link = SessionGet("ZonaLink");
	SessionRemove("ZonaLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
