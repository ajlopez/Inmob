<?php

/*
 *	Functions
 * for Entity User
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');


function UserTranslateFullName($Id) {
	global $UserFullNames;
	global $Cfg;

	if ($UserFullNames[$Id])
		return $UserFullNames[$Id];

	$user = UserGetById($Id);
	$fullname = $user['FirstName'] . ' ' . $user['LastName'];
	$UserFullNames[$Id] = $fullname;

	return $fullname;
}

?>
