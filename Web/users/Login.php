<?php
    include_once('../Configuration.inc.php');
    
	$Page->Title = "Ingreso de Usuario";
	$Page->Prefix = '../';

	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	
	include_once($Page->Prefix.'includes/Header.inc.php');
?>

<div>
Ingrese su c&oacute;digo de usuario y su contrase&ntilde;a.
</div>

<?php
	ErrorRender();
?>


<form action="LoginValidate.php" method=post>

<?php
	TableOpen();
	FieldTextGenerate("UserName","C�digo de Usuario",$Codigo,16);
	FieldPasswordGenerate("Password","Contrase�a",$Contrasenia,16);
	FieldOkGenerate();
	TableClose();
?>
</form>

</center>

<?php
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>

