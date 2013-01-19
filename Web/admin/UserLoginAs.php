<?
	$Page->Prefix = '../';
	
	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');
	
	include_once($Page->Prefix.'includes/Users.inc.php');

	DbConnect();

	$sql = "Select * from $Cfg[SqlPrefix]users where Id = $Id";
	$res = mysql_query($sql);

	if (!$res || mysql_num_rows($res)==0) {
		DbDisconnect();
		ErrorAdd('Usuario inexistente');
		include('UserList.php');
		exit;
	}

	$user = mysql_fetch_object($res);
	mysql_free_result($res);

	UserLogin($user);

	DbDisconnect();

	$UserLink = SessionGet("UserLink");
	SessionRemove("UserLink");

	//PageRedirect($UserLink);
	PageRedirect(PageMain());
	exit;
?>