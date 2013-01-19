<?

/*
 *	Functions
 * for Entity ImagenPropiedad
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function ImagenPropiedadInmobiliariaGetList($IdInmobiliaria, $where='',$order='') {
	global $Cfg;

	$sql = "select pi.Id, pi.Nombre, pi.Descripcion, pi.NombreArchivo, pi.Uuid, pi.IdPropiedad, pi.Notas, pi.Principal, pi.Habilitada from $Cfg[SqlPrefix]propiedadimagenes pi inner join $Cfg[SqlPrefix]propiedades p on pi.IdPropiedad = p.Id where p.IdInmobiliaria = $IdInmobiliaria";

	if ($where)
		$sql .= " and $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function ImagenPropiedadInmobiliariaGetListView($IdInmobiliaria, $where='',$order='') {
	global $Cfg;

	$sql = "select pi.Id, pi.Nombre, pi.IdPropiedad, pi.Principal, pi.Habilitada from $Cfg[SqlPrefix]propiedadimagenes pi inner join $Cfg[SqlPrefix]propiedades p on pi.IdPropiedad = p.Id where p.IdInmobiliaria = $IdInmobiliaria";

	if ($where)
		$sql .= " and $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function ImagenPropiedadNombreArchivo($Uuid, $NombreArchivo)
{
    return $Uuid . '.' . pathinfo($NombreArchivo, PATHINFO_EXTENSION);
}

?>
