<?php

/*
 *	Functions
 * for Entity DocumentoConsorcio
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function DocumentoConsorcioGetExtendedList($where='',$order='') {
	global $Cfg;

	$sql = "select documentos.Id, documentos.Nombre, documentos.Descripcion, documentos.NombreArchivo, documentos.Uuid, documentos.IdConsorcio, documentos.Notas, consorcios.Nombre as NombreConsorcio from $Cfg[SqlPrefix]documentosconsorcio as documentos, $Cfg[SqlPrefix]consorcios as consorcios";

	if ($where)
		$sql .= " where $where and documentos.IdConsorcio = consorcios.Id";
	else
		$sql .= " where documentos.IdConsorcio = consorcios.Id";

	if (!$order)
		$order = 'Id';
		
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function DocumentoConsorcioGetExtendedListView($where='',$order='') {
	global $Cfg;

	$sql = "select documentos.Id, documentos.Nombre, documentos.Descripcion, documentos.NombreArchivo, documentos.Uuid, documentos.IdConsorcio, documentos.Notas, consorcios.Nombre as NombreConsorcio from $Cfg[SqlPrefix]documentosconsorcio as documentos, $Cfg[SqlPrefix]consorcios as consorcios";

	if ($where)
		$sql .= " where $where and documentos.IdConsorcio = consorcios.Id";
	else
		$sql .= " where documentos.IdConsorcio = consorcios.Id";
	
	if (!$order)
		$order = 'Id';
		
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

?>
