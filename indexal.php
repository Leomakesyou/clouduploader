<?php
session_start();
header("Cache-control: no-cache");
include $_SERVER[DOCUMENT_ROOT] . "/clouduploader/conf_ini.php";
$rutapublica= "http://" . $_SERVER[HTTP_HOST] . "/clouduploader";
$validarlogin['1'] = "Ingrese los datos faltantes";
$stringlogin['1'] = "";
$stringlogin['2'] = "Nombre de Usuario";
$stringlogin['3'] = "Clave";
$stringlogin['4'] = "";
$stringlogin['5'] = "Ingresar";


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>DiezEquis CloudUploader</title>
	<link rel="icon" href="tqgroup.ico">
	<link href="<?php echo $rutapublica . '/style/style.css' ?>" type=text/css rel=stylesheet>
	<meta charset=UTF-8 />
	<script language="JavaScript">
	function valida_campos() 
	{
		if (document.formulario.login.value=='') 
		{
			rc=alert('<?= $validarlogin['1'] ?>');
			document.formulario.login.focus();
			return false;		
		}

		if (document.formulario.password.value=='') 
		{
			rc=alert('<?= $validarlogin['1'] ?>');
			document.formulario.password.focus();
			return false;
		}

		document.formulario.submitButton.disabled = true;
		return true;

	}
	</script>
</head>
<body onLoad="javascript:document.formulario.login.focus();">
	<?php


	if (isset($_POST[action]) && $_POST[login] == '')
	{
		echo "<br><center><font color=red><strong>Ingrese los Datos de Acceso</strong></font><center>";
		$_POST[action] = "no";
	}
	$Accion = $_POST[action];
	if (isset($Accion) && $Accion == 'Ingresar' && isset($_POST[login]))
	{	
		$_SESSION['form'] = "Aviso";

			//$login = htmlspecialchars(trim(strtoupper($_POST['userlogin'])));
		$login = strtolower($_POST['login']);
		$pass = md5($_POST['password']); 
			//error_reporting(ALL);

		$link = mysql_connect($gloDbHost, $gloDbUser, $gloDbPassword) or trigger_error(mysql_error(),E_USER_ERROR); 
		mysql_select_db($gloDb, $link) or die (mysql_error());

		$sql  = " SELECT userid, login, password, name";
		$sql .= " FROM users";
		$sql .= " Where login = '$login' and password= '$pass'";

		$result = mysql_query($sql, $link) or die (mysql_error());	
		$row = mysql_fetch_assoc($result);
		$numDatos = @mysql_num_rows($result);

		if ($numDatos <= 0) 
		{
			echo "<br><center><font color=red><strong>
			Usuario o Clave invalidos, Verifique el usuario y la clave introducidos
			</strong></font></center>";

			mysql_close($link);	
		}
		else
		{
						//echo "si es usuario";
			$menu = "home.php";
						//$row = @mysql_fetch_array($result);
			$_SESSION["sudlogin"] = $row[login];
						//$_SESSION["sudnombre"] = $row[nombre];
						// $_SESSION["sudperfil"] = $row[idperfil];
						//$_SESSION["suddesperfil"] = $row[desperfil];

			mysql_close($link) or die (mysql_error());
			?>
			<script type="text/javascript">
			location.replace("<?= $menu; ?>");
			</script>

			<?php
		}
	}
	else{

		session_unset();
		session_destroy();			

	}

	if ($_SESSION['sesIdUsuario'] == "NOBODY" || $_SESSION['sesIdUsuario'] == "" || empty($_SESSION['sesIdUsuario']))
		{ ?>
	<div id="container">
		<section>
			<h2>CloudUploader for Rackspace</h2>
			<img id="logorck" src="<?php echo $rutapublica . '/images/logo.png' ?>" alt="Rackspace"/>
		</section>
		<section>
			<form name="formulario" method="post" action="" onSubmit='return valida_campos();'>
				<fieldset>
					<label for="login">Usuario</label>
					<input type="text" name="login" id="login" required autofocus >
					<label for="password">Contraseña</label>
					<input type="password" name="password" id="password" required>		
				</fieldset>	
				<fieldset>
					<button type="submit" name="submitButton" id="submitButton">Ingresar</button>
					<input type="hidden"  name="action" value="Ingresar">
				</fieldset>
			</form>
		</section>
	</div>

	<?php
}	?>
</body>
</html>