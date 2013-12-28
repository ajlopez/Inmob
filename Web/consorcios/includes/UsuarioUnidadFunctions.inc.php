<?php

/*
 *	Functions
 * for Entity UsuarioUnidad
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function UsuarioUnidadGetById($Id) {
	global $Cfg;

	$sql = "select Id, IdUser, IdConsorcio, IdUnidad from $Cfg[SqlPrefix]userunidades where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function UsuarioUnidadGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, IdUser, IdConsorcio, IdUnidad from $Cfg[SqlPrefix]userunidades";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}


function UsuarioUnidadGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function UsuarioUnidadInsert($IdUser, $IdConsorcio, $IdUnidad) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]userunidades set
		IdUser = $IdUser,
		IdConsorcio = $IdConsorcio,
		IdUnidad = $IdUnidad";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function UsuarioUnidadUpdate($Id, $IdUser, $IdConsorcio, $IdUnidad) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]userunidades set
		IdUser = $IdUser,
		IdConsorcio = $IdConsorcio,
		IdUnidad = $IdUnidad where Id = $Id";

	DbExecuteUpdate($sql);
}

function UsuarioUnidadDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]userunidades where Id = $Id";
	DbExecuteUpdate($sql);
}

function UsuarioUnidadTranslate($Id) {
	global $UsuarioUnidadNames;
	global $Cfg;

	if ($UsuarioUnidadNames[$Id])
		return $UsuarioUnidadNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]userunidades",$Id,"IdUser");

	$UsuarioUnidadNames[$Id] = $description;

	return $description;
}


function UsuarioUnidadGetByUser($IdUser) {
	return UsuarioUnidadGetList("IdUser = $IdUser");
}

function UsuarioUnidadGetByConsorcio($IdConsorcio) {
	return UsuarioUnidadGetList("IdConsorcio = $IdConsorcio");
}

function UsuarioUnidadGetByUnidad($IdUnidad) {
	return UsuarioUnidadGetList("IdUnidad = $IdUnidad");
}

?>
