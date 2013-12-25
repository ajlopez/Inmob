<?php
// Security Controls for this directory
include_once($Page->Prefix.'includes/Users.inc.php');
include_once($Page->Prefix.'ajfwk/Pages.inc.php');
include_once($Page->Prefix.'ajfwk/Session.inc.php');
AdministratorControl(PageLogin());
?>
