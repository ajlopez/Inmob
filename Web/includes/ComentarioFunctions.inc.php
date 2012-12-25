<?

/*
 *	Functions
 * for Entity Comentario
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function ComentarioGetById($Id) {
	global $Cfg;

	$sql = "select Id, Texto, IdPropiedad, IdUser from $Cfg[SqlPrefix]comentarios where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function ComentarioGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Texto, IdPropiedad, IdUser from $Cfg[SqlPrefix]comentarios";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}


function ComentarioGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function ComentarioInsert($Texto, $IdPropiedad, $IdUser) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]comentarios set
		Texto = '$Texto',
		IdPropiedad = $IdPropiedad,
		IdUser = $IdUser";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function ComentarioUpdate($Id, $Texto, $IdPropiedad, $IdUser) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]comentarios set
		Texto = '$Texto',
		IdPropiedad = $IdPropiedad,
		IdUser = $IdUser where Id = $Id";

	DbExecuteUpdate($sql);
}

function ComentarioDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]comentarios where Id = $Id";
	DbExecuteUpdate($sql);
}

function ComentarioTranslate($Id) {
	global $ComentarioNames;
	global $Cfg;

	if ($ComentarioNames[$Id])
		return $ComentarioNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]comentarios",$Id,"Texto");

	$ComentarioNames[$Id] = $description;

	return $description;
}


function ComentarioGetByPropiedad($IdPropiedad) {
	return ComentarioGetList("IdPropiedad = $IdPropiedad");
}

function ComentarioGetByUser($IdUser) {
	return ComentarioGetList("IdUser = $IdUser");
}

?>
