<?
	include_once($Page->Prefix.'ajfwk/Configuration.inc.php');
	include_once($Page->Prefix.'ajfwk/Session.inc.php');
	include_once($Page->Prefix.'ajfwk/Cache.inc.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><? echo $Cfg['SiteName']; ?> - <? echo $Page->Title; ?></title>

<META name="title" content="<? echo $Page->Title ?>">
<META name="description" content="<? echo $Cfg['SiteDescription'] ?>">
<META name="keywords" content="ajlopez, Angel Java Lopez">
<META name="language" content="es">
<META name="revisit-after" content="3 days">
<META name="rating" content="General">
<META name="author" content="Angel J Lopez">
<META name="owner" content="Angel J Lopez">
<META name="robot" content="index, follow">

<link rel="stylesheet" href="<? echo $Page->Prefix; ?>styles/style.css">
<link rel="stylesheet" href="<? echo $Page->Prefix; ?>css/bootstrap.css">
<link rel="stylesheet" href="<? echo $Page->Prefix; ?>css/docs.css">
<link rel="stylesheet" href="<? echo $Page->Prefix; ?>styles/styleex.css">
<?
	if ($Page->FileJs)
		echo "<script language='javascript' src='{$Page->Prefix}js/{$Page->FileJs}'></script>\n";
		
	if ($Page->FilesJs)
		foreach ($Page->FilesJs as $filejs)
			echo "<script language='javascript' src='{$Page->Prefix}js/{$filejs}'></script>\n";
			
	if ($Page->FilesCss)
		foreach ($Page->FilesCss as $filecss)
			echo "<link rel='stylesheet' href='{$Page->Prefix}styles/{$filecss}'>\n";
?>
</head>

