<?

/*
 *	Functions
 * for Entity UsoMultiple
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function UsoMultipleGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre, Codigo, IdConsorcio, Notas from $Cfg[SqlPrefix]usomultiples where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function UsoMultipleGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre, Codigo, IdConsorcio, Notas from $Cfg[SqlPrefix]usomultiples";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function UsoMultipleGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, Nombre, Codigo, IdConsorcio, Notas from $Cfg[SqlPrefix]usomultiples";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function UsoMultipleGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function UsoMultipleInsert($Nombre, $Codigo, $IdConsorcio, $Notas) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]usomultiples set
		Nombre = '$Nombre',
		Codigo = '$Codigo',
		IdConsorcio = $IdConsorcio,
		Notas = '$Notas'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function UsoMultipleUpdate($Id, $Nombre, $Codigo, $IdConsorcio, $Notas) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]usomultiples set
		Nombre = '$Nombre',
		Codigo = '$Codigo',
		IdConsorcio = $IdConsorcio,
		Notas = '$Notas' where Id = $Id";

	DbExecuteUpdate($sql);
}

function UsoMultipleDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]usomultiples where Id = $Id";
	DbExecuteUpdate($sql);
}

function UsoMultipleTranslate($Id) {
	global $UsoMultipleNames;
	global $Cfg;

	if ($UsoMultipleNames[$Id])
		return $UsoMultipleNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]usomultiples",$Id,"Nombre");

	$UsoMultipleNames[$Id] = $description;

	return $description;
}


function UsoMultipleGetByConsorcio($IdConsorcio) {
	return UsoMultipleGetList("IdConsorcio = $IdConsorcio");
}

?>
