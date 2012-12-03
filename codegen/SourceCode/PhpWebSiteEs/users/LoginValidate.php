<?
	$Page->Prefix = '../';
	
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');
	
	include_once($Page->Prefix.'includes/Users.inc.php');

	if (empty($UserName))
		ErrorShow('Debe ingresar Código');

	if (empty($Password))
		ErrorShow('Debe ingresar Contraseña');

	DbConnect();

	$sql = "Select * from $Cfg[SqlPrefix]users where UserName = '$UserName'";
	$res = mysql_query($sql);

	if (!$res || mysql_num_rows($res)==0) {
		Disconnect();
		ErrorShow('Usuario inexistente');
	}

	$user = mysql_fetch_object($res);
	mysql_free_result($res);

	if ($user->Password != $Password) {
		Disconnect();
		ErrorShow('Contraseña incorrecta');
	}

	UserLogin($user);

	DbDisconnect();

	$UserLink = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($UserLink);
	exit;
?>