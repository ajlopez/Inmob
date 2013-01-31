<?

/*
 *	Functions
 * for Entity Agente
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function AgenteGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre, Contacto, Notas, NombreArchivo, Uuid, IdInmobiliaria from $Cfg[SqlPrefix]agentes where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function AgenteGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre, Contacto, Notas, NombreArchivo, Uuid, IdInmobiliaria from $Cfg[SqlPrefix]agentes";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}


function AgenteGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function AgenteInsert($Nombre, $Contacto, $Notas, $NombreArchivo, $Uuid, $IdInmobiliaria) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]agentes set
		Nombre = '$Nombre',
		Contacto = '$Contacto',
		Notas = '$Notas',
		NombreArchivo = '$NombreArchivo',
		Uuid = '$Uuid',
		IdInmobiliaria = $IdInmobiliaria";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function AgenteUpdate($Id, $Nombre, $Contacto, $Notas, $NombreArchivo, $Uuid, $IdInmobiliaria) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]agentes set
		Nombre = '$Nombre',
		Contacto = '$Contacto',
		Notas = '$Notas',
		NombreArchivo = '$NombreArchivo',
		Uuid = '$Uuid',
		IdInmobiliaria = $IdInmobiliaria where Id = $Id";

	DbExecuteUpdate($sql);
}

function AgenteDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]agentes where Id = $Id";
	DbExecuteUpdate($sql);
}

function AgenteTranslate($Id) {
	global $AgenteNames;
	global $Cfg;

	if ($AgenteNames[$Id])
		return $AgenteNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]agentes",$Id,"Nombre");

	$AgenteNames[$Id] = $description;

	return $description;
}


function AgenteGetByInmobiliaria($IdInmobiliaria) {
	return AgenteGetList("IdInmobiliaria = $IdInmobiliaria");
}

?>
