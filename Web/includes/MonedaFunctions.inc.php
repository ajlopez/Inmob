<?

/*
 *	Functions
 * for Entity Moneda
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function MonedaGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre from $Cfg[SqlPrefix]monedas where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function MonedaGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre from $Cfg[SqlPrefix]monedas";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function MonedaGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, Nombre from $Cfg[SqlPrefix]monedas";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function MonedaGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function MonedaInsert($Nombre) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]monedas set
		Nombre = '$Nombre'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function MonedaUpdate($Id, $Nombre) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]monedas set
		Nombre = '$Nombre' where Id = $Id";

	DbExecuteUpdate($sql);
}

function MonedaDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]monedas where Id = $Id";
	DbExecuteUpdate($sql);
}

function MonedaTranslate($Id) {
	global $MonedaNames;
	global $Cfg;

	if ($MonedaNames[$Id])
		return $MonedaNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]monedas",$Id,"Nombre");

	$MonedaNames[$Id] = $description;

	return $description;
}


?>
