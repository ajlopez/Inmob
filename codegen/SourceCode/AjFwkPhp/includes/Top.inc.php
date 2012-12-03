<?
	include_once($Page->Prefix.'ajfwk/Configuration.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
?>
<body>

<div id="header">
<?= $Cfg['SiteName'] ?>
</div>

<div id="subheader">
<? echo $Cfg['SiteDescription'] ?>
</div>
<div id=menu>
<? include_once("MenuLeft.inc.php"); ?>
</div>			

<div id=content>
<h1><? echo $Page->Title ?></h1>
