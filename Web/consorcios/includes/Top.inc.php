<?php
	include_once($Page->Prefix.'ajfwk/Configuration.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
?>
<body>

<div id="header">
<?= $Cfg['SiteName'] ?>
</div>

<div id="subheader">
<?php echo $Cfg['SiteDescription'] ?>
</div>
<div id=menu>
<?php include_once("MenuLeft.inc.php"); ?>
</div>			

<div id=content>
<h2><?php echo $Page->Title ?></h2>
