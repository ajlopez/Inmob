<?

/*
 *	Functions
 * for Entity Evento
 *
 */

	include_once($Page->Prefix.'includes/EventoFunctions.inc.php');
	include_once($Page->Prefix.'includes/Users.inc.php');

function EventoWrite($Tipo, $IdParametro = null) {
	global $Cfg;
	
	if (!$IdParametro)
		$IdParametro = 'null';
	
	if (UserCurrent())
		$IdUsuario = UserId();
	else
		$IdUsuario = 'null';

	$sql = "insert $Cfg[SqlPrefix]eventos set
		Tipo = '$Tipo',
		IdParametro = $IdParametro,
		IdUsuario = $IdUsuario,
		FechaHora = now()";

	DbExecuteUpdate($sql);

	return DbLastId();
}

?>
