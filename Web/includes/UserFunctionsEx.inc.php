<?

/*
 *	Functions
 * for Entity User
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');

function UserGetByUserName($UserName, $Id) {
	global $Cfg;

    $Id += 0;

	$sql = "select Id, UserName, Password, FirstName, LastName, Email, Genre, IsAdministrator, DateTimeInsert, DateTimeUpdate, DateTimeLastLogin, LoginCount, Habilitado, Notas, IdInmobiliaria, EsAdmInmobiliaria from $Cfg[SqlPrefix]users where UserName = '$UserName' and Id <> $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

?>
