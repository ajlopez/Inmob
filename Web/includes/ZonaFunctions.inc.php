<?

/*
 *	Functions
 * for Entity Zona
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function ZonaGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre, IdZonaPadre from $Cfg[SqlPrefix]zonas where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function ZonaGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre, IdZonaPadre from $Cfg[SqlPrefix]zonas";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function ZonaGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, Nombre, IdZonaPadre from $Cfg[SqlPrefix]zonas";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function ZonaGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function ZonaInsert($Nombre, $IdZonaPadre) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]zonas set
		Nombre = '$Nombre',
		IdZonaPadre = $IdZonaPadre";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function ZonaUpdate($Id, $Nombre, $IdZonaPadre) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]zonas set
		Nombre = '$Nombre',
		IdZonaPadre = $IdZonaPadre where Id = $Id";

	DbExecuteUpdate($sql);
}

function ZonaDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]zonas where Id = $Id";
	DbExecuteUpdate($sql);
}

function ZonaTranslate($Id) {
	global $ZonaNames;
	global $Cfg;

	if ($ZonaNames[$Id])
		return $ZonaNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]zonas",$Id,"Nombre");

	$ZonaNames[$Id] = $description;

	return $description;
}


function ZonaGetByZona($IdZonaPadre) {
	return ZonaGetList("IdZonaPadre = $IdZonaPadre");
}

?>
