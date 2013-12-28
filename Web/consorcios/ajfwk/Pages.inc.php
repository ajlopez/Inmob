<?php
	include_once('Random.inc.php');

function PageCurrent() {
	$link = $_SERVER['SCRIPT_NAME'];

	if ($_SERVER['QUERY_STRING'])
		$link .= '?' . $_SERVER['QUERY_STRING'];

	return $link;
}

function PageMain() {
	return "index.php";
}

function PageLogin() {
	return "users/Login.php";	
}

function PageUser() {
	return "index.php";
}

function PageAdministrator() {
	return "admin/index.php";
}

function PageControl($link = '') {
	if ($link)
		return $link;

	return PageMain();
}

function PageRedirect($link = '', $alternative = '') {
	global $Page;

	if (!$link && !$alternative)
		header("Location: $Page->Prefix" . PageControl());
	elseif (!$link)
		header("Location: $Page->Prefix$alternative");
	else
		header("Location: $Page->Prefix$link");
	exit;
}

function PageAbsoluteRedirect($link = '', $alternative = '') {
	global $Page;

	if (!$link && !$alternative)
		header("Location: $Page->Prefix" . PageControl());
	elseif (!$link)
		header("Location: $alternative");
	else
		header("Location: $link");
	exit;
}

function PageExit() {
	PageRedirect(PageControl());
}

?>