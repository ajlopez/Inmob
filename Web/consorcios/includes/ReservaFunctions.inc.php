<?

/*
 *	Functions
 * for Entity Reserva
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function ReservaGetById($Id) {
	global $Cfg;

	$sql = "select Id, DesdeFecha, DesdeHora, HastaFecha, HastaHora, IdUsoMultiple, IdUser from $Cfg[SqlPrefix]reservas where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function ReservaGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, DesdeFecha, DesdeHora, HastaFecha, HastaHora, IdUsoMultiple, IdUser from $Cfg[SqlPrefix]reservas";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";
	
	return DbExecuteQuery($sql);
}

function ReservaGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, DesdeFecha, DesdeHora, HastaFecha, HastaHora, IdUsoMultiple, IdUser from $Cfg[SqlPrefix]reservas";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function ReservaGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function ReservaInsert($DesdeFecha, $DesdeHora, $HastaFecha, $HastaHora, $IdUsoMultiple, $IdUser) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]reservas set
		DesdeFecha = '$DesdeFecha',
		DesdeHora = '$DesdeHora',
		HastaFecha = '$HastaFecha',
		HastaHora = '$HastaHora',
		IdUsoMultiple = $IdUsoMultiple,
		IdUser = $IdUser";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function ReservaUpdate($Id, $DesdeFecha, $DesdeHora, $HastaFecha, $HastaHora, $IdUsoMultiple, $IdUser) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]reservas set
		DesdeFecha = '$DesdeFecha',
		DesdeHora = '$DesdeHora',
		HastaFecha = '$HastaFecha',
		HastaHora = '$HastaHora',
		IdUsoMultiple = $IdUsoMultiple,
		IdUser = $IdUser where Id = $Id";

	DbExecuteUpdate($sql);
}

function ReservaDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]reservas where Id = $Id";
	DbExecuteUpdate($sql);
}

function ReservaTranslate($Id) {
	global $ReservaNames;
	global $Cfg;

	if ($ReservaNames[$Id])
		return $ReservaNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]reservas",$Id,"DesdeFecha");

	$ReservaNames[$Id] = $description;

	return $description;
}


function ReservaGetByUsoMultiple($IdUsoMultiple) {
	return ReservaGetList("IdUsoMultiple = $IdUsoMultiple");
}

function ReservaGetByUser($IdUser) {
	return ReservaGetList("IdUser = $IdUser");
}

?>
