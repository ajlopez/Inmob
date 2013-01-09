<?

/*
 *	Functions
 * for Entity User
 *
 */

	include_once($Page->Prefix.'ajfwk/Database.inc.php');
	include_once($Page->Prefix.'ajfwk/Translations.inc.php');

function UserGetById($Id) {
	global $Cfg;

	$sql = "select Id, UserName, Password, FirstName, LastName, Email, Genre, IsAdministrator, DateTimeInsert, DateTimeUpdate, DateTimeLastLogin, LoginCount, Habilitado, Notas, IdInmobiliaria, EsAdmInmobiliaria from $Cfg[SqlPrefix]users where Id = $Id";

	$rs = DbExecuteQuery($sql);
	return DbNextRow($rs);
}

function UserGetList($where='',$order='') {
	global $Cfg;

	$sql = "select Id, UserName, Password, FirstName, LastName, Email, Genre, IsAdministrator, DateTimeInsert, DateTimeUpdate, DateTimeLastLogin, LoginCount, Habilitado, Notas, IdInmobiliaria, EsAdmInmobiliaria from $Cfg[SqlPrefix]users";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function UserGetListView($where='',$order='') {
	global $Cfg;

	$sql = "select Id, Id, UserName, FirstName, LastName, IdInmobiliaria, Habilitado, EsAdmInmobiliaria from $Cfg[SqlPrefix]users";

	if ($where)
		$sql .= " where $where";
	if (!$order)
		$order = 'Id';
	$sql .= " order by $order";

	return DbExecuteQuery($sql);
}

function UserGetView($where='',$order='') {
	global $Cfg;

}

//	function GetListBy...
//	function GetViewBy...

function UserInsert($UserName, $Password, $FirstName, $LastName, $Email, $Genre, $IsAdministrator, $DateTimeInsert, $DateTimeUpdate, $DateTimeLastLogin, $LoginCount, $Habilitado, $Notas, $IdInmobiliaria, $EsAdmInmobiliaria) {
	global $Cfg;

	$sql = "insert $Cfg[SqlPrefix]users set
		UserName = '$UserName',
		Password = '$Password',
		FirstName = '$FirstName',
		LastName = '$LastName',
		Email = '$Email',
		Genre = '$Genre',
		IsAdministrator = '$IsAdministrator',
		DateTimeInsert = '$DateTimeInsert',
		DateTimeUpdate = '$DateTimeUpdate',
		DateTimeLastLogin = '$DateTimeLastLogin',
		LoginCount = $LoginCount,
		Habilitado = '$Habilitado',
		Notas = '$Notas',
		IdInmobiliaria = $IdInmobiliaria,
		EsAdmInmobiliaria = '$EsAdmInmobiliaria'";

	DbExecuteUpdate($sql);

	return DbLastId();
}

function UserUpdate($Id, $UserName, $Password, $FirstName, $LastName, $Email, $Genre, $IsAdministrator, $DateTimeInsert, $DateTimeUpdate, $DateTimeLastLogin, $LoginCount, $Habilitado, $Notas, $IdInmobiliaria, $EsAdmInmobiliaria) {
	global $Cfg;

	$sql = "update $Cfg[SqlPrefix]users set
		UserName = '$UserName',
		Password = '$Password',
		FirstName = '$FirstName',
		LastName = '$LastName',
		Email = '$Email',
		Genre = '$Genre',
		IsAdministrator = '$IsAdministrator',
		DateTimeInsert = '$DateTimeInsert',
		DateTimeUpdate = '$DateTimeUpdate',
		DateTimeLastLogin = '$DateTimeLastLogin',
		LoginCount = $LoginCount,
		Habilitado = '$Habilitado',
		Notas = '$Notas',
		IdInmobiliaria = $IdInmobiliaria,
		EsAdmInmobiliaria = '$EsAdmInmobiliaria' where Id = $Id";

	DbExecuteUpdate($sql);
}

function UserDelete($Id) {
	global $Cfg;

	$sql = "delete from $Cfg[SqlPrefix]users where Id = $Id";
	DbExecuteUpdate($sql);
}

function UserTranslate($Id) {
	global $UserNames;
	global $Cfg;

	if ($UserNames[$Id])
		return $UserNames[$Id];

	$description = TranslateDescription("$Cfg[SqlPrefix]users",$Id,"UserName");

	$UserNames[$Id] = $description;

	return $description;
}


function UserGetByInmobiliaria($IdInmobiliaria) {
	return UserGetList("IdInmobiliaria = $IdInmobiliaria");
}

?>
