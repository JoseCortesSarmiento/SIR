<?php
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';
include 'global/header.php';
?>

<?php
//MONGOMONGOMONGOMONGOMONGOMONGOMONGOMONGOMONGOMONGOMONGO
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

//borramos todos los documentos antes de hacer backup
$bulk = new MongoDB\Driver\BulkWrite;
$bulk->delete([]);
$client->executeBulkWrite('proveedores.backup', $bulk);   
?>
<script> location.replace("backupProveedores.php"); </script>