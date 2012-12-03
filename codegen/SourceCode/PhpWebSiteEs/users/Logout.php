<?
	$Page->Prefix = '../';
	include($Page->Prefix.'ajfwk/Pages.inc.php');
	include($Page->Prefix.'ajfwk/Users.inc.php');

	UserLogout();

	PageRedirect(PageMain());
?>