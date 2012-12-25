<?

/*
 *	Functions
 * for Entity Propiedad
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function PropiedadGetById($Id) {
	global $Cfg;

	$sql = "select Id, Nombre, Domicilio, Metros, Ambientes, IdTipo, Descripcion, Precio, IdMoneda, Operacion, IdZona, IdInmobiliaria, Notas, Habilitada, AceptaComentarios from $Cfg[SqlPrefix]propiedades where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function PropiedadGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Nombre, Domicilio, Metros, Ambientes, IdTipo, Descripcion, Precio, IdMoneda, Operacion, IdZona, IdInmobiliaria, Notas, Habilitada, AceptaComentarios from $Cfg[SqlPrefix]propiedades";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function PropiedadGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, Nombre, Domicilio, IdZona, IdInmobiliaria, IdTipo, Habilitada from $Cfg[SqlPrefix]propiedades";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function PropiedadGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function PropiedadInsert($Nombre, $Domicilio, $Metros, $Ambientes, $IdTipo, $Descripcion, $Precio, $IdMoneda, $Operacion, $IdZona, $IdInmobiliaria, $Notas, $Habilitada, $AceptaComentarios) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]propiedades set
		Nombre = '$Nombre',
		Domicilio = '$Domicilio',
		Metros = '$Metros',
		Ambientes = '$Ambientes',
		IdTipo = $IdTipo,
		Descripcion = '$Descripcion',
		Precio = '$Precio',
		IdMoneda = $IdMoneda,
		Operacion = '$Operacion',
		IdZona = $IdZona,
		IdInmobiliaria = $IdInmobiliaria,
		Notas = '$Notas',
		Habilitada = '$Habilitada',
		AceptaComentarios = '$AceptaComentarios'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function PropiedadUpdate($Id, $Nombre, $Domicilio, $Metros, $Ambientes, $IdTipo, $Descripcion, $Precio, $IdMoneda, $Operacion, $IdZona, $IdInmobiliaria, $Notas, $Habilitada, $AceptaComentarios) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]propiedades set
		Nombre = '$Nombre',
		Domicilio = '$Domicilio',
		Metros = '$Metros',
		Ambientes = '$Ambientes',
		IdTipo = $IdTipo,
		Descripcion = '$Descripcion',
		Precio = '$Precio',
		IdMoneda = $IdMoneda,
		Operacion = '$Operacion',
		IdZona = $IdZona,
		IdInmobiliaria = $IdInmobiliaria,
		Notas = '$Notas',
		Habilitada = '$Habilitada',
		AceptaComentarios = '$AceptaComentarios' where Id = $Id";

	DbExecuteUpdate($sql);
}

function PropiedadDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]propiedades where Id = $Id";
	DbExecuteUpdate($sql);
}

function PropiedadTranslate($Id) {
	global $PropiedadNames;
	global $Cfg;

	if ($PropiedadNames[$Id])
		return $PropiedadNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]propiedades",$Id,"Nombre");

	$PropiedadNames[$Id] = $description;

	return $description;
}


function PropiedadGetByTipoPropiedad($IdTipo) {
	return PropiedadGetList("IdTipo = $IdTipo");
}

function PropiedadGetByMoneda($IdMoneda) {
	return PropiedadGetList("IdMoneda = $IdMoneda");
}

function PropiedadGetByZona($IdZona) {
	return PropiedadGetList("IdZona = $IdZona");
}

function PropiedadGetByInmobiliaria($IdInmobiliaria) {
	return PropiedadGetList("IdInmobiliaria = $IdInmobiliaria");
}

?>
