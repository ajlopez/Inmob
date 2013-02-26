<?
include_once($Page->Prefix.'ajfwk/Pages.inc.php');
include_once($Page->Prefix.'ajfwk/Database.inc.php');
include_once($Page->Prefix.'ajfwk/Session.inc.php');
include_once($Page->Prefix.'includes/UsoMultipleFunctionsEx.inc.php');
include_once('Events.inc.php');

function UserControl($link='') {
	global $PHP_SELF;
	global $HTTP_SERVER_VARS;

	$User = SessionGet("CurrentUser");
	$UserId = $User->Id;

	if (empty($UserId)) {
		if (empty($link)) {
			$enlace = $PHP_SELF;
			if ($HTTP_SERVER_VARS["QUERY_STRING"])
				$enlace .= "?" . $HTTP_SERVER_VARS["QUERY_STRING"];
		}
		SessionPut("UserLink", $link);
		PageRedirect(PageLogin());
		exit;
	}
}

function UserIdentified() {
	$User = SessionGet("CurrentUser");
	if (isset($User))
		return(true);
	return(false);	
}	

function UserVerified() {
	if (!UserIdentified())
		return false;
	$User = UserCurrent();
	if (IsSet($User))
		return true;
	return false;
}

function UserCurrent() {
	return SessionGet("CurrentUser");
}

function UserId() {
	$User = UserCurrent();
	return($User->Id);
}

function UserHasMultiple() {
	$User = UserCurrent();
	return($User->HasMultiple && !$User->NoReserva);
}

function UserHasManyMultiple() {
	$User = UserCurrent();
	return($User->HasManyMultiple);
}

function UserName() {
	$User = UserCurrent();
	return($User->UserName);
}

function UserPassword() {
	$User = UserCurrent();
	return($User->Password);
}

function UserFirstName() {
	$User = UserCurrent();
	return($User->FirstName);
}

function UserLastName() {
	$User = UserCurrent();
	return($User->LastName);
}

function UserGenre() {
	$User = UserCurrent();
	return($User->Genre);
}

function UserEmail() {
	$User = UserCurrent();
	return($User->Email);
}

function UserIsAdministrator() {
	$User = UserCurrent();
	return($User->IsAdministrator);
}

function UserIsUser() {
	if (!UserIsAdministrator())
		return true;
	return false;
}

function UserIsInRole($role) {
}

function UserRole() {
	if (UserIsAdministrator())
		return 'Administrator';
	if (UserIdentified() && UserIsUser())
		return 'User';
}

function AdministratorControl($link='') {
	UserControl($link);

	if (!UserIsAdministrator())
		PageRedirect(PageMain());
}

function UserLogin($user) {
	SessionPut("CurrentUser", $user);
	EventLogin();
	DbConnect();
	DbExecuteUpdate("update users set DateTimeLastLogin = now(), LoginCount = LoginCount+1 where Id = " . UserId());
	$rs = UsoMultipleGetListByUser($user->Id);
	$multiple = DbNextRow($rs);
	if ($multiple) {
		$user->HasMultiple = $multiple;
		$second = DbNextRow($rs);
		if ($second)
			$user->HasManyMultiple = true;
	}
	DbFreeResult($rs);
	DbDisconnect();
}

function UserLogout() {
	EventLogout();
	SessionDestroy();
}

function UserTranslateId($Id) {
	global $UsersTable;

	if (!$Id)
		return '';

	if ($UsersTabla[$Id])
		return $UsersTabla[$Id];

	DbConnect();

	$rs = DbExecuteQuery("select UserName from users where Id = $Id");

	if ($rs && DbNumRows($rs)) {
		$reg = DbNextRow($rs);
		$Code = $reg['UserName'];
	}
	else
		$Code = $Id;

	$UsersTable[$Id] = $Code;

	DbDisconnect();

	return $Code;
}
?>