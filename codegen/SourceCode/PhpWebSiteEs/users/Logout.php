<?
	$Page->Prefix = '../';
	include($Page->Prefix.'ajfwk/Pages.inc.php');
	include($Page->Prefix.'includes/Users.inc.php');

	UserLogout();

	PageRedirect(PageMain());
?>