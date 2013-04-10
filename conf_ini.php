<?php
// For Rackspace Uploader app 
// $rutaPublica= "http://" . $_SERVER[HTTP_HOST] . "/sap_web";
define('INIFILE', 'conf.ini');

/**
 * Load the .INI file and set the Global propierties for all the program 
 */
$ini = parse_ini_file(INIFILE, TRUE);
if (!$ini) {
    printf("Unable to load .ini file [%s]\n", INIFILE);
    exit;
}

//define variables from .ini file

$rutaPublica =  "http://".$_SERVER[HTTP_HOST]."/".$ini['ruta']['rutapublica']."/";
$pathPublica = $_SERVER[DOCUMENT_ROOT]."/".$ini['ruta']['rutapublica'];
$gloInclude= $pathPublica . "/conexion";
$gloIdiomaAplicacion= $ini['general']['idiomaapp'];
// $gloAdodb= $gloInclude . "/adodb";
// $clase_BD= $gloInclude . "/dbm.php";
// $gloPaginar= $gloInclude . "/paginar.php";
$gloNombrePublico= $ini['general']['nombreapp'];
$gloNombreAdmin= $ini['general']['administrador'];
$gloNombreAplicacion= $ini['general']['appname'];
$gloNombreCliente= $ini['general']['cliente'];
$gloNumRegistro= "";
$gloVersionPaquete= $ini['general']['version'];

//datos de conexión de mysql desde el .ini
$gloDbDriver= $ini['database']['driver'];
$gloDbHost= $ini['database']['host'];
$gloDb= $ini['database']['db'];
$gloDbUser= $ini['database']['usuario'];
$gloDbPassword = $ini['database']['contrasena'];



?>
