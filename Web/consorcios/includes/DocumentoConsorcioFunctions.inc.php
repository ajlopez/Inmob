<?

/*
 *	Functions
 * for Entity DocumentoConsorcio
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function DocumentoConsorcioGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre, Descripcion, NombreArchivo, Uuid, IdConsorcio, Notas from $Cfg[SqlPrefix]documentosconsorcio where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function DocumentoConsorcioGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre, Descripcion, NombreArchivo, Uuid, IdConsorcio, Notas from $Cfg[SqlPrefix]documentosconsorcio";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function DocumentoConsorcioGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, Nombre, Descripcion, NombreArchivo, Uuid, IdConsorcio, Notas from $Cfg[SqlPrefix]documentosconsorcio";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function DocumentoConsorcioGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function DocumentoConsorcioInsert($Nombre, $Descripcion, $NombreArchivo, $Uuid, $IdConsorcio, $Notas) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]documentosconsorcio set
		Nombre = '$Nombre',
		Descripcion = '$Descripcion',
		NombreArchivo = '$NombreArchivo',
		Uuid = '$Uuid',
		IdConsorcio = $IdConsorcio,
		Notas = '$Notas'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function DocumentoConsorcioUpdate($Id, $Nombre, $Descripcion, $NombreArchivo, $Uuid, $IdConsorcio, $Notas) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]documentosconsorcio set
		Nombre = '$Nombre',
		Descripcion = '$Descripcion',
		NombreArchivo = '$NombreArchivo',
		Uuid = '$Uuid',
		IdConsorcio = $IdConsorcio,
		Notas = '$Notas' where Id = $Id";

	DbExecuteUpdate($sql);
}

function DocumentoConsorcioDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]documentosconsorcio where Id = $Id";
	DbExecuteUpdate($sql);
}

function DocumentoConsorcioTranslate($Id) {
	global $DocumentoConsorcioNames;
	global $Cfg;

	if ($DocumentoConsorcioNames[$Id])
		return $DocumentoConsorcioNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]documentosconsorcio",$Id,"Nombre");

	$DocumentoConsorcioNames[$Id] = $description;

	return $description;
}


function DocumentoConsorcioGetByConsorcio($IdConsorcio) {
	return DocumentoConsorcioGetList("IdConsorcio = $IdConsorcio");
}

?>
