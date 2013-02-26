<?

/*
 *	Functions
 * for Entity Reserva
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function ReservaCountInRange($IdReserva, $IdUsoMultiple, $FechaDesde, $HoraDesde, $FechaHasta, $HoraHasta) {
	global $Cfg;

	$sql = "select count(*) as cuenta from $Cfg[SqlPrefix]reservas where IdUsoMultiple = $IdUsoMultiple and Id <> $IdReserva and (((DesdeFecha = '$FechaDesde' and DesdeHora >= '$HoraDesde') or DesdeFecha > '$FechaDesde') and ((DesdeFecha = '$FechaHasta' and DesdeHora < '$HoraHasta') or DesdeFecha < '$FechaHasta') or ((HastaFecha = '$FechaDesde' and HastaHora > '$HoraDesde') or HastaFecha > '$FechaDesde') and ((HastaFecha = '$FechaHasta' and HastaHora <= '$HoraHasta') or HastaFecha < '$FechaHasta'))";

	$rs = DbExecuteQuery($sql);
	$data = DbNextRow($rs);
	DbFreeResult($rs);
	
	return $data['cuenta'];
}

?>
