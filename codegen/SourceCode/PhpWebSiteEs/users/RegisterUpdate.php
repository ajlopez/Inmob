<?
	$Page->Prefix = '../';

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Validations.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/PostParameters.inc.php');

	include_once($Page->Prefix.'includes/Users.inc.php');

	if (empty($UserName))
		ErrorAdd('Debe ingresar Código');

	if (empty($Password))
		ErrorAdd('Debe ingresar Contraseña');

	if ($Password2 != $Password)
		ErrorAdd('No coinciden las contraseñas ingresadas');

	if (!$Email)
		ErrorAdd('Debe ingresar Email');

	DbConnect();

	$sql = "Select * from $Cfg[SqlPrefix]users where UserName = '$UserName'";
	$res = mysql_query($sql);

	if ($res && mysql_num_rows($res)>0) {
		ErrorAdd('Usuario existente');
	}

	if (ErrorHas()) {
		DbDisconnect();
		include('Register.php');
		exit;
	}

	mysql_free_result($res);

	$IdCountry += 0;
	$IdGenre += 0;

	$sql = "Insert users set UserName = '$UserName',
			Password = Password('$Password'),
			FirstName = '$FirstName',
			LastName = '$LastName',
			Email = '$Email',
			DateTimeInsert = now()
			";

	mysql_query($sql);

	$user->Id = mysql_insert_id;
	$user->UserName = $UserName;
	$user->FirstName = $FirstName;
	$user->LastName = $LastName;

	UserLogin($user);

	DbDisconnect();

	$UserLink = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($UserLink);
	exit;
?>