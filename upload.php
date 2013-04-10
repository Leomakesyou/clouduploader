<?php

$archivo = $_FILES['archivo']['name'];
$tamano = $_FILES['archivo']['size'];
$tipo = $_FILES['archivo']['type'];
$temp = $_FILES['archivo']['tmp_name'];    
$error = $_FILES['archivo']['error'];



if (is_uploaded_file($_FILES["archivo"]['tmp_name']))
{
   $nombreDirectorio = "/var/www/clouduploader/up/";
   $tipodocumento = $_POST[typedoc];
   $codigoarchivo = $_POST[numcode];
   $nombrearchivo = $_POST[docname];
   $idUnico = time();
   $ext = strrchr($_FILES['archivo']['name'],'.');  

   $nombreFichero = $idUnico.'-'.$tipodocumento.'-'.$codigoarchivo.'-'.$nombrearchivo.$ext;
// $nombreCompleto = $nombreDirectorio . $nombreFichero;


 // if (is_file($nombreCompleto))
 // {
 // $nombreFichero = $idUnico . "-" . $nombreFichero;
 // echo $nombreFichero;
 // }


   move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreDirectorio.$nombreFichero);

   $rack = 'rack.php';  ?>

   <script type="text/javascript">
   // alert ("Se ha subido correctamente");
   location.replace("<?= $rack; ?>");
   </script>

   <?php
// function rack();

}

else{
   print ("No se ha podido subir el fichero");
}


?>
