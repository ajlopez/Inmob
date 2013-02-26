<?

/*
 *	Functions
 * for Entity Consorcio
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');

function ConsorciosByUser($IdUser) {
	global $Cfg;

	$sql = "SELECT DISTINCT u.idconsorcio FROM $Cfg[SqlPrefix]unidades u, $Cfg[SqlPrefix]userunidades uu WHERE u.id = uu.idunidad AND uu.iduser = $IdUser";

	return DbExecuteQuery($sql);
}

?>
