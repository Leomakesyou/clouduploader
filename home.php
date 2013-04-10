<? session_start();
header("Cache-control: no-cache");
include $_SERVER[DOCUMENT_ROOT] . "/clouduploader/conf_ini.php";
// require ($gloIncludeAplicacion . "/extranet_chklogin.php");
if (!isset($_SESSION['sudlogin']) or $_SESSION['sudlogin'] == '')
{
	$rutaPublica;
	?>
	<script>
	window.location.replace("<?= $rutaPublica ?>");
	r = alert('Sesion No Iniciada.');
	</script>
	<?php
}
else
{
	?>
	<html>
	<head>
		<title><?= $gloNombreAplicacion ?></title>
		<link rel="icon" href="tqgroup.ico">
		<link href="<?php echo $rutaPublica . '/style/style.css' ?>" type=text/css rel=stylesheet>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>	
		<meta charset=UTF-8 />
	</head>
<!-- <frameset rows="15%,*" frameborder="1" border="1" framespacing="0">
			<frame src="frame_superior.php" name="frameSuperior" scrolling="NO" noresize>
			frameset cols="20%,*" frameborder="1" border="1" framespacing="0"
			<frame src="menu_izquierdo.php" name="frameInferior" scrolling="yes">
				frame name="contenido" scrolling="yes"
			/frameset
		</frameset> -->
		<body>




			<img id="brgrck" src="<?php echo $rutaPublica . '/images/logo.png' ?>" alt="Rackspace"/>
			<section>
				<div id="box">	
					<div id="loadframe"> 
						<form method="post" action="upload.php" enctype="multipart/form-data">
							<fieldset>
								<label for="typedoc">Tipo de documento</label>
								<select name="typedoc" id="typedoc1" required>
									<option></option>
									<option value="1">Imagen</option>
									<option value="2">Factura</option>																		
									<option value="3">Orden de Venta</option>									
								</select>
							</br>
								<label for="numcode">Numero de documento</label>
								<input type="text" name="numcode" required>
								<label for="docname">Nombre de documento</label>
								<input type="text" name="docname" required>
							</fieldset>
							<fieldset>
								<label for ="archivo">Seleccione un archivo</label>
								<input type="file" name='archivo'>
							</fieldset>
							<fieldset>
								<input type="submit" name="submit" value="upload">
								<input type="hidden" name="action" value="up"> 
							</fieldset>
						</form> 


					</div>
				</div>
			</section>




		</body>
		</html>
		<?php
	} ?>