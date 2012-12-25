<?

/*
 *	Functions
 * for Entity TipoPropiedad
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function TipoPropiedadGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre from $Cfg[SqlPrefix]tipospropiedad where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function TipoPropiedadGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre from $Cfg[SqlPrefix]tipospropiedad";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function TipoPropiedadGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, Nombre from $Cfg[SqlPrefix]tipospropiedad";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function TipoPropiedadGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function TipoPropiedadInsert($Nombre) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]tipospropiedad set
		Nombre = '$Nombre'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function TipoPropiedadUpdate($Id, $Nombre) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]tipospropiedad set
		Nombre = '$Nombre' where Id = $Id";

	DbExecuteUpdate($sql);
}

function TipoPropiedadDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]tipospropiedad where Id = $Id";
	DbExecuteUpdate($sql);
}

function TipoPropiedadTranslate($Id) {
	global $TipoPropiedadNames;
	global $Cfg;

	if ($TipoPropiedadNames[$Id])
		return $TipoPropiedadNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]tipospropiedad",$Id,"Nombre");

	$TipoPropiedadNames[$Id] = $description;

	return $description;
}


?>
