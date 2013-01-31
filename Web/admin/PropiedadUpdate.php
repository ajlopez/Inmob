<?
	if (!$Page->Prefix)
		$Page->Prefix = '../';
	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Validations.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');

	if (empty($IdTipo))
		ErrorAdd('Debe ingresar Tipo de Propiedad');
	if (empty($IdMoneda))
		ErrorAdd('Debe ingresar Moneda');
	if (empty($Operacion))
		ErrorAdd('Debe ingresar Operacion');
	if (empty($IdZona))
		ErrorAdd('Debe ingresar Zona');
	if (empty($IdInmobiliaria))
		ErrorAdd('Debe ingresar Inmobiliaria');
	$Metros += 0;
	$Lote += 0;
	$Ambientes += 0;
	$Dormitorios += 0;
	$Banios += 0;
	$Toilettes += 0;
	$Plantas += 0;
	$IdTipo += 0;
	$Precio += 0;
	$IdMoneda += 0;
	$Operacion += 0;
	$IdZona += 0;
	$IdInmobiliaria += 0;
	$IdAgente += 0;

	DbConnect();
	DbTransactionBegin();

	if (ErrorHas()) {
		DbDisconnect();
		include('PropiedadForm.php');
		exit;
	}

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Cfg[SqlPrefix]propiedades set
		Nombre = '$Nombre' , 
		Domicilio = '$Domicilio' , 
		Metros = '$Metros' , 
		Lote = '$Lote' , 
		Ambientes = '$Ambientes' , 
		Dormitorios = '$Dormitorios' , 
		Banios = '$Banios' , 
		Toilettes = '$Toilettes' , 
		Plantas = '$Plantas' , 
		IdTipo = $IdTipo , 
		Descripcion = '$Descripcion' , 
		Precio = '$Precio' , 
		IdMoneda = $IdMoneda , 
		Operacion = '$Operacion' , 
		IdZona = $IdZona , 
		IdInmobiliaria = $IdInmobiliaria , 
		IdAgente = $IdAgente , 
		Notas = '$Notas' , 
		Habilitada = '$Habilitada' , 
		AceptaComentarios = '$AceptaComentarios' 		";
		
	if (empty($Id))
	{
	}
	else
	{
	}

	if (!empty($Id))
		$sql .= " where Id=$Id";

	DbExecuteUpdate($sql);
    
    $dberror = DbLastSqlError();
    
    if ($dberror) {
        DbTransactionRollback();
        DbDisconnect();
        echo $dberror;
    }

	DbTransactionCommit();
	DbDisconnect();

	$Link = SessionGet("PropiedadLink");
	SessionRemove("PropiedadLink");

	PageAbsoluteRedirect($Link);
	exit;
?>
