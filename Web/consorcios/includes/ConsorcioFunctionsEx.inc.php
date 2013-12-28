<?php

/*
 *	Functions
 * for Entity Consorcio
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
    include_once($Page->Prefix . 'includes/DocumentoConsorcioFunctions.inc.php');

function ConsorciosByUser($IdUser) {
	global $Cfg;

	$sql = "SELECT DISTINCT u.idconsorcio FROM $Cfg[SqlPrefix]unidades u, $Cfg[SqlPrefix]userunidades uu WHERE u.id = uu.idunidad AND uu.iduser = $IdUser";

	return DbExecuteQuery($sql);
}

function ConsorcioDeleteEx($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]unidades where IdConsorcio = $Id";
	DbExecuteUpdate($sql);
    
    $rsdocs = DocumentoConsorcioGetByConsorcio($Id);
    
  	while ($reg=DbNextRow($rsdocs)) {
		$NombreArchivo = $reg['NombreArchivo'];
        $Uuid = $reg['Uuid'];
        $ext = pathinfo($NombreArchivo, PATHINFO_EXTENSION);
        $filename = $Uuid . '.' . $ext;
        $filename = '../files/' . $filename;
        unlink($filename);
	}
    
	$sql = "delete from $Cfg[SqlPrefix]documentosconsorcio where IdConsorcio = $Id";
	DbExecuteUpdate($sql);
	$sql = "delete from $Cfg[SqlPrefix]consorcios where Id = $Id";
	DbExecuteUpdate($sql);
}

?>
