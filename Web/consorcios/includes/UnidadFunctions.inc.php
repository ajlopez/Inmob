<?

/*
 *	Functions
 * for Entity Unidad
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function UnidadGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre, Codigo, Piso, Numero, IdConsorcio, Notas from $Cfg[SqlPrefix]unidades where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function UnidadGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre, Codigo, Piso, Numero, IdConsorcio, Notas from $Cfg[SqlPrefix]unidades";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function UnidadGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, Nombre, Codigo, Piso, Numero, IdConsorcio, Notas from $Cfg[SqlPrefix]unidades";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function UnidadGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function UnidadInsert($Nombre, $Codigo, $Piso, $Numero, $IdConsorcio, $Notas) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]unidades set
		Nombre = '$Nombre',
		Codigo = '$Codigo',
		Piso = '$Piso',
		Numero = '$Numero',
		IdConsorcio = $IdConsorcio,
		Notas = '$Notas'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function UnidadUpdate($Id, $Nombre, $Codigo, $Piso, $Numero, $IdConsorcio, $Notas) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]unidades set
		Nombre = '$Nombre',
		Codigo = '$Codigo',
		Piso = '$Piso',
		Numero = '$Numero',
		IdConsorcio = $IdConsorcio,
		Notas = '$Notas' where Id = $Id";

	DbExecuteUpdate($sql);
}

function UnidadDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]unidades where Id = $Id";
	DbExecuteUpdate($sql);
}

function UnidadTranslate($Id) {
	global $UnidadNames;
	global $Cfg;

	if ($UnidadNames[$Id])
		return $UnidadNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]unidades",$Id,"Nombre");

	$UnidadNames[$Id] = $description;

	return $description;
}


function UnidadGetByConsorcio($IdConsorcio) {
	return UnidadGetList("IdConsorcio = $IdConsorcio");
}

?>
