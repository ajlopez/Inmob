<?
	include_once($Page->Prefix.'ajfwk/Configuration.inc.php');
	include_once($Page->Prefix.'ajfwk/Pages.inc.php');
?>
<body>

<#
	if Technology.Web.Menu = "Top" then
#>
<div id="subheader">
<? echo $Cfg['SiteDescription'] ?>
</div>
<? include_once("MenuTop.inc.php"); ?>
<#
	else
#>
<div id="header">
<?= $Cfg['SiteName'] ?>
</div>
<div id="subheader">
<? echo $Cfg['SiteDescription'] ?>
</div>
<div id=menu>
<? include_once("MenuLeft.inc.php"); ?>
</div>			
<#
	end if
#>

<div id=content>
<h2><? echo $Page->Title ?></h2>
