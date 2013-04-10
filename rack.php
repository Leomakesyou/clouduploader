<?php 


require('/var/www/clouduploader/php-opencloud-master/lib/rackspace.php');

define('TEMP_URL_SECRET', 'My Secret for now');
define('DIRECTORY', '/var/www/clouduploader');
define('CONTAINERNAME', 'SAPFiles');


$USERNAME = 'Juancanob';
$PASSWORD = 'Vitualla@2742072';
$APIKEY = '4a2bf93aed4935687bf6a3c6864c5e85';
$TENANT = '902379';
$endpoint = 'https://identity.api.rackspacecloud.com/v2.0/';
$credentials = array(
    'username' => $USERNAME,
    'apiKey' => $APIKEY,
    'password' => $PASSWORD,
    'tenantName' => $TENANT);


function UploadProgress($len) {
  printf("[uploading %d bytes]\n", $len);
}



if(!is_dir(DIRECTORY)){
    exit;
}
else{
    echo "Directory Exists...\n";
}

// authenticate
$cloud = new OpenCloud\Rackspace($endpoint, $credentials);
$cloud->SetUploadProgressCallback('UploadProgress');
$objstore = $cloud->ObjectStore('cloudFiles', 'DFW');
$objstore->SetTempUrlSecret(TEMP_URL_SECRET);
$container = $objstore->Container();
$container->Create(array('name'=>CONTAINERNAME));
$files = glob(DIRECTORY . "/up/*");
foreach ($files as $file) { 
    printf("Creating object...\n");
    $object = $container->DataObject();
    $object->Create(array('name'=>basename($file)),
        $file);
}

if($files){
 $home = 'home.php';  ?>

 <script type="text/javascript">
 alert ("Se ha subido correctamente");
 location.replace("<?= $home; ?>");
 </script>

 <?php

}
else{
    echo "<p>Error</p>";
}
?>