<?

/*
 *	Functions
 * for Entity Consorcio
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function ConsorcioGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre, Codigo, Domicilio, Ciudad, Provincia, Pais, Notas from $Cfg[SqlPrefix]consorcios where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function ConsorcioGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre, Codigo, Domicilio, Ciudad, Provincia, Pais, Notas from $Cfg[SqlPrefix]consorcios";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";
    
	return DbExecuteQuery($sql);
}

function ConsorcioGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, Nombre, Codigo, Domicilio, Ciudad, Provincia, Pais, Notas from $Cfg[SqlPrefix]consorcios";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function ConsorcioGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function ConsorcioInsert($Nombre, $Codigo, $Domicilio, $Ciudad, $Provincia, $Pais, $Notas) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]consorcios set
		Nombre = '$Nombre',
		Codigo = '$Codigo',
		Domicilio = '$Domicilio',
		Ciudad = '$Ciudad',
		Provincia = '$Provincia',
		Pais = '$Pais',
		Notas = '$Notas'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function ConsorcioUpdate($Id, $Nombre, $Codigo, $Domicilio, $Ciudad, $Provincia, $Pais, $Notas) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]consorcios set
		Nombre = '$Nombre',
		Codigo = '$Codigo',
		Domicilio = '$Domicilio',
		Ciudad = '$Ciudad',
		Provincia = '$Provincia',
		Pais = '$Pais',
		Notas = '$Notas' where Id = $Id";

	DbExecuteUpdate($sql);
}

function ConsorcioDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]consorcios where Id = $Id";
	DbExecuteUpdate($sql);
}

function ConsorcioTranslate($Id) {
	global $ConsorcioNames;
	global $Cfg;

	if ($ConsorcioNames[$Id])
		return $ConsorcioNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]consorcios",$Id,"Nombre");

	$ConsorcioNames[$Id] = $description;

	return $description;
}


?>
