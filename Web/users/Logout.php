<?
	$Page->Prefix = '../';
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'includes/Users.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'includes/EventoFunctionsEx.inc.php');

	DbConnect();
	EventoWrite('LOUT');
	DbDisconnect();
	
	UserLogout();

	PageRedirect(PageMain());
?>