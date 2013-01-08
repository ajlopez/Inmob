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

	if (empty($Password))
		ErrorAdd('Debe ingresar Contraseña');
	if (empty($Password2))
		ErrorAdd('Debe ingreser Reingreso de Contraseña');
	if ($Password <> $Password2)
		ErrorAdd('No coinciden las Contraseñas');
	
	if (ErrorHas()) {
		include('UserPasswordForm.php');
		exit;
	}

	DbConnect();
	DbTransactionBegin();

	$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]users set
		Password = Password('$Password')";
		
	$DateTimeUpdate = date('Y-m-d H:i:s');
	$sql .= ", DateTimeUpdate = '$DateTimeUpdate'";

	$sql .= " where Id=$Id";

	DbExecuteUpdate($sql);

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
