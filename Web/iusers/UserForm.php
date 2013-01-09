<?
	$Page->Title = 'Actualiza Mis Datos';
	if (!$Page->Prefix)
		$Page->Prefix = '../';

	include_once('./Security.inc.php');
	include_once($Page->Prefix.'ajfwk/GetParameters.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

	include_once($Page->Prefix.'includes/Enumerations.inc.php');
	include_once($Page->Prefix.'includes/UserFunctions.inc.php');

    $Id = UserId();

	DbConnect();
	
	if (!ErrorHas()) {
		$rs = UserGetById($Id);
		$UserName = $rs['UserName'];
		$FirstName = $rs['FirstName'];
		$LastName = $rs['LastName'];
		$Email = $rs['Email'];
		$Genre = $rs['Genre'];
		$IsAdministrator = $rs['IsAdministrator'];
		$Habilitado = $rs['Habilitado'];
		$Notas = $rs['Notas'];
		$IdInmobiliaria = $rs['IdInmobiliaria'];
		$EsAdmInmobiliaria = $rs['EsAdmInmobiliaria'];

		$IsNew = 0;
	}	

	$rsIdInmobiliaria = TranslateQuery("$Cfg[SqlPrefix]inmobiliarias","Nombre as Nombre");

	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div class="btn-group">
<a class="btn btn-info" href="UserView.php">Mis Datos</a>
</div>


<?
	ErrorRender();
?>

<form action="UserUpdate.php" method=post>

<?
	TableOpen('','','form');
    FieldStaticGenerate("Código",$UserName);

	FieldTextGenerate("FirstName", "Nombre", $FirstName, 30, False);
	FieldTextGenerate("LastName", "Apellido", $LastName, 30, False);
	FieldTextGenerate("Email", "Correo Electrónico", $Email, 30, False);
	FieldTextGenerate("Genre", "Género", $Genre, 30, False);
	FieldMemoGenerate("Notas", "Notas", $Notas, 10, 30, False);

	FieldOkGenerate();
	TableClose();
?>

</form>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>
