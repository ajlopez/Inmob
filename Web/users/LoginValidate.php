<?
	$Page->Prefix = '../';
	
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');
	
	include_once($Page->Prefix.'includes/Users.inc.php');
	include_once($Page->Prefix.'includes/EventoFunctionsEx.inc.php');

	if (empty($UserName))
		ErrorAdd('Debe ingresar C�digo');

	if (empty($Password))
		ErrorAdd('Debe ingresar Contrase�a');

	if (ErrorHas()) {
		include('Login.php');
		exit;
	}

	DbConnect();

	$sql = "Select *, Password('$Password') as Password2 from $Cfg[SqlPrefix]users where UserName = '$UserName'";
	$res = mysql_query($sql);

	if (!$res || mysql_num_rows($res)==0) {
		DbDisconnect();
		ErrorAdd('Usuario inexistente');
		include('Login.php');
		exit;
	}

	$user = mysql_fetch_object($res);
	mysql_free_result($res);

	if ($user->Password != $user->Password2) {
		DbDisconnect();
		ErrorAdd('Contrase�a incorrecta');
		include('Login.php');
		exit;
	}

	UserLogin($user);
	
	EventoWrite('LIN');

	DbDisconnect();

	$UserLink = SessionGet("UserLink");
	SessionRemove("UserLink");

	//PageRedirect($UserLink);
	PageRedirect(PageMain());
	exit;
?>