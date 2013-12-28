<?php

/*
 *	Functions
 * for Entity Unidad
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function UnidadTranslateToCodigo($Id) {
	global $UnidadCodes;
	global $Cfg;

	if ($UnidadCodes[$Id])
		return $UnidadCodes[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]unidades",$Id,"Codigo");

	$UnidadCodes[$Id] = $description;

	return $description;
}


?>
