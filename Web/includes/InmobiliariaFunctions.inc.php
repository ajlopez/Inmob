<?

/*
 *	Functions
 * for Entity Inmobiliaria
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function InmobiliariaGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre, Domicilio, Descripcion, Contacto, Notas, IdInmobiliaria, Habilitada from $Cfg[SqlPrefix]inmobiliarias where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function InmobiliariaGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre, Domicilio, Descripcion, Contacto, Notas, IdInmobiliaria, Habilitada from $Cfg[SqlPrefix]inmobiliarias";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function InmobiliariaGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, Nombre, Domicilio, IdInmobiliaria, Habilitada from $Cfg[SqlPrefix]inmobiliarias";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function InmobiliariaGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function InmobiliariaInsert($Nombre, $Domicilio, $Descripcion, $Contacto, $Notas, $IdInmobiliaria, $Habilitada) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]inmobiliarias set
		Nombre = '$Nombre',
		Domicilio = '$Domicilio',
		Descripcion = '$Descripcion',
		Contacto = '$Contacto',
		Notas = '$Notas',
		IdInmobiliaria = $IdInmobiliaria,
		Habilitada = '$Habilitada'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function InmobiliariaUpdate($Id, $Nombre, $Domicilio, $Descripcion, $Contacto, $Notas, $IdInmobiliaria, $Habilitada) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]inmobiliarias set
		Nombre = '$Nombre',
		Domicilio = '$Domicilio',
		Descripcion = '$Descripcion',
		Contacto = '$Contacto',
		Notas = '$Notas',
		IdInmobiliaria = $IdInmobiliaria,
		Habilitada = '$Habilitada' where Id = $Id";

	DbExecuteUpdate($sql);
}

function InmobiliariaDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]inmobiliarias where Id = $Id";
	DbExecuteUpdate($sql);
}

function InmobiliariaTranslate($Id) {
	global $InmobiliariaNames;
	global $Cfg;

	if ($InmobiliariaNames[$Id])
		return $InmobiliariaNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]inmobiliarias",$Id,"Nombre");

	$InmobiliariaNames[$Id] = $description;

	return $description;
}


function InmobiliariaGetByInmobiliaria($IdInmobiliaria) {
	return InmobiliariaGetList("IdInmobiliaria = $IdInmobiliaria");
}

?>
