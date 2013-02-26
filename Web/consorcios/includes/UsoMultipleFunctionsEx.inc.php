<?

/*
 *	Functions
 * for Entity UsoMultiple
 *
 */

	include_once($Page->Prefix.'includes/UsoMultipleFunctions.inc.php');

function UsoMultipleGetListByUser($iduser) {
	global $Cfg;
    
    $where = "IdConsorcio in (SELECT DISTINCT u.idconsorcio FROM $Cfg[SqlPrefix]unidades u, $Cfg[SqlPrefix]userunidades uu WHERE u.id = uu.idunidad AND uu.iduser = $iduser)";
    $order = "Codigo";

	return UsoMultipleGetList($where, $order);
}

?>
