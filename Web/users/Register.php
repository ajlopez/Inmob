<?
	$Page->Title = 'Registrarse';
	$Page->Prefix = '../';
	$FileJs = 'utilities.js';

	include_once($Page->Prefix.'ajfwk/Errors.inc.php');
	include_once($Page->Prefix.'ajfwk/Forms.inc.php');
	include_once($Page->Prefix.'ajfwk/Tables.inc.php');
	include_once($Page->Prefix.'ajfwk/Database.inc.php');

	include_once($Page->Prefix.'includes/Header.inc.php');

	DbConnect();

	$rsCountries = mysql_query('select Id, Description from $Cfg[SqlPrefix]countries');
	$IdGenre = 1;
	$IdCountry = 1;
?>

<div>
Para ser usuario de este sitio, complete los datos del siguiente formulario. 
Tenga en cuenta que su c&oacute;digo y contrase&ntilde;a le ser&aacute;n requeridos cada vez que quiera
ingresar a las secciones privadas del sitio. Los campos marcados con <font color=red>*</font> son obligatorios.
</div>

<?
	ErrorRender();
?>

<script language="javascript">
function FormValidate(thisform)
{
	with (thisform) {
<?
	if (!$Id) {
?>
		if (IsBlank(UserName.value)) {
			alert("Debe ingresar Código");
			Codigo.focus();
			return false;
		}
<?
	}
?>
		if (IsBlank(Password.value)) {
			alert("Debe ingresar Contraseña");
			Contrasenia.focus();
			return false;
		}
		if (Password.value!=Password2.value) {
			alert("No coinciden las Contraseñas ingresadas");
			Contrasenia.focus();
			return false;
		}
		if (IsBlank(Email.value)) {
			alert("Debe ingresar Email");
			Email.focus();
			return false;
		}
		if (!EmailValidate(Email)) {
			alert("Email inválido");
			Email.focus();
			return false;
		}
	}
}

</script>

<form action="RegisterUpdate.php" method=post onsubmit="return FormValidate(this);">
<?
	TableOpen();
	FieldTextGenerate("UserName","Código de Usuario",$UserName,16,true);
	FieldPasswordGenerate("Password","Contraseña",$Password,16,true);
	FieldPasswordGenerate("Password2","Reingrese Contraseña",$Password2,16,true);
	FieldTextGenerate("FirstName","Nombre",$FirstName,40);
	FieldTextGenerate("LastName","Apellido",$LastName,40);
	FieldTextGenerate("Email","Email",$Email,50,true);
	FieldOkGenerate();
	TableClose();
?>
</form>

<?
	DbDisconnect();
	include_once($Page->Prefix.'includes/Footer.inc.php');
?>

