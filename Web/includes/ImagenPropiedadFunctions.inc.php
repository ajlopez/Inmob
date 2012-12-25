<?

/*
 *	Functions
 * for Entity ImagenPropiedad
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function ImagenPropiedadGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre, Descripcion, NombreArchivo, Uuid, IdPropiedad, Notas, Principal, Habilitada from $Cfg[SqlPrefix]propiedadimagenes where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function ImagenPropiedadGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre, Descripcion, NombreArchivo, Uuid, IdPropiedad, Notas, Principal, Habilitada from $Cfg[SqlPrefix]propiedadimagenes";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function ImagenPropiedadGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, Nombre, IdPropiedad, Principal, Habilitada from $Cfg[SqlPrefix]propiedadimagenes";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function ImagenPropiedadGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function ImagenPropiedadInsert($Nombre, $Descripcion, $NombreArchivo, $Uuid, $IdPropiedad, $Notas, $Principal, $Habilitada) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]propiedadimagenes set
		Nombre = '$Nombre',
		Descripcion = '$Descripcion',
		NombreArchivo = '$NombreArchivo',
		Uuid = '$Uuid',
		IdPropiedad = $IdPropiedad,
		Notas = '$Notas',
		Principal = '$Principal',
		Habilitada = '$Habilitada'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function ImagenPropiedadUpdate($Id, $Nombre, $Descripcion, $NombreArchivo, $Uuid, $IdPropiedad, $Notas, $Principal, $Habilitada) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]propiedadimagenes set
		Nombre = '$Nombre',
		Descripcion = '$Descripcion',
		NombreArchivo = '$NombreArchivo',
		Uuid = '$Uuid',
		IdPropiedad = $IdPropiedad,
		Notas = '$Notas',
		Principal = '$Principal',
		Habilitada = '$Habilitada' where Id = $Id";

	DbExecuteUpdate($sql);
}

function ImagenPropiedadDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]propiedadimagenes where Id = $Id";
	DbExecuteUpdate($sql);
}

function ImagenPropiedadTranslate($Id) {
	global $ImagenPropiedadNames;
	global $Cfg;

	if ($ImagenPropiedadNames[$Id])
		return $ImagenPropiedadNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]propiedadimagenes",$Id,"Nombre");

	$ImagenPropiedadNames[$Id] = $description;

	return $description;
}


function ImagenPropiedadGetByPropiedad($IdPropiedad) {
	return ImagenPropiedadGetList("IdPropiedad = $IdPropiedad");
}

?>
