<?
	include_once($Page->Prefix.'includes/Users.inc.php');
?>
<div class="navbar">
<div class="navbar-inner">
<div class="container">
<div class="nav">
<ul class="nav">

<?
function MenuTop($text, $link)
{
	global $Page;
?>
  <li class="">
	<a href="<?= $Page->Prefix ?><?= $link ?>"><?= $text ?></a>
  </li>
<?
}

function MenuTopOpen($title)
{
?>
  <li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $title ?><b class="caret"></b></a>
	<ul class="dropdown-menu">
<?
}

function MenuTopOption($text, $link)
{
	global $Page;
?>
    <li><a href="<?= $Page->Prefix ?><?= $link ?>"><?= $text ?></a></li>
<?
}

function MenuTopClose()
{
?>
    </ul>
  </li>
<?
}

?>

<?
	MenuTop($Cfg['SiteName'], 'index.php');

	MenuTopOpen('Entities');
<#
	for each List in Project.Model.Lists
#>
	MenuTopOption('${List.Title}','${WebDir}${List.Entity.Name}List.php');
<#
	end for
#>
	MenuTopClose();
<#
	if Project.HasUsers then
#>

	if (UserIdentified()) {
		MenuTopOpen(UserName());
		MenuTopOption('My Page', 'users/User.php');
		If (UserIsAdministrator()) {
			MenuTopOption('Administrator','admin/index.php');
		}
		MenuTopOption('Logout','users/Logout.php');
		MenuTopClose();
	}
	else {
		MenuTopOpen('Users');
		MenuTopOption('Login','users/Login.php');
		MenuTopOption('Register','users/Register.php');
		MenuTopClose();
	}
<#
	end if
#>
?>
</ul>
</div>
</div>
</div>
</div>
