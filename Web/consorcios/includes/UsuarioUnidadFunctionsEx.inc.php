<?php

/*
 *	Functions
 * for Entity UsuarioUnidad
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function UsuarioUnidadGetListEx($where='',$order='') {
	global $Cfg;

	$sql = "select uu.Id, uu.IdUser, u.UserName, u.DateTimeLastLogin, uu.IdConsorcio, uu.IdUnidad, un.Nombre as UnidadNombre from $Cfg[SqlPrefix]userunidades uu left join $Cfg[SqlPrefix]users u on uu.IdUser = u.Id left join $Cfg[SqlPrefix]unidades un on uu.IdUnidad = un.Id";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}


function UsuarioUnidadGetByUserEx($IdUser) {
	return UsuarioUnidadGetListEx("uu.IdUser = $IdUser");
}

function UsuarioUnidadGetByConsorcioEx($IdConsorcio) {
	return UsuarioUnidadGetListEx("uu.IdConsorcio = $IdConsorcio");
}

function UsuarioUnidadGetByUnidadEx($IdUnidad) {
	return UsuarioUnidadGetListEx("uu.IdUnidad = $IdUnidad");
}

?>
