<?php

/*
 *	Functions
 * for Entity Evento
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function EventoGetById($Id) {
	global $Cfg;

	$sql = "select Id, Tipo, IdParametro, IdUsuario, FechaHora from $Cfg[SqlPrefix]eventos where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function EventoGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Tipo, IdParametro, IdUsuario, FechaHora from $Cfg[SqlPrefix]eventos";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}


function EventoGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function EventoInsert($Tipo, $IdParametro, $IdUsuario, $FechaHora) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]eventos set
		Tipo = '$Tipo',
		IdParametro = '$IdParametro',
		IdUsuario = $IdUsuario,
		FechaHora = '$FechaHora'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function EventoUpdate($Id, $Tipo, $IdParametro, $IdUsuario, $FechaHora) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]eventos set
		Tipo = '$Tipo',
		IdParametro = '$IdParametro',
		IdUsuario = $IdUsuario,
		FechaHora = '$FechaHora' where Id = $Id";

	DbExecuteUpdate($sql);
}

function EventoDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]eventos where Id = $Id";
	DbExecuteUpdate($sql);
}

function EventoTranslate($Id) {
	global $EventoNames;
	global $Cfg;

	if ($EventoNames[$Id])
		return $EventoNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]eventos",$Id,"Tipo");

	$EventoNames[$Id] = $description;

	return $description;
}


function EventoGetByUser($IdUsuario) {
	return EventoGetList("IdUsuario = $IdUsuario");
}

?>
