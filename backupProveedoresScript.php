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

try {
    
        //$db = new PDO($dsn, $g_connUserId, $g_connPwd, $options);

        $sql = "SELECT * FROM proveedores";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rst = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (is_array($rst)) {
            //borramos todos los documentos antes de hacer backup
            $bulk = new MongoDB\Driver\BulkWrite;
            $bulk->delete([]);
            $client->executeBulkWrite('proveedores.backup', $bulk);

            foreach($rst as $row) {
            // get column data from mysql
            $id_proveedor = $row["id_proveedor"];
            $nombre = $row["nombre"];
            $correo = $row["correo"];
            $telefono = $row["telefono"];
            $direccion = $row["direccion"];
            //print $id_proveedor . "," . $nombre . "," . $correo . "," . $telefono .
              //  "," . $direccion . "<br>";


                // only insert
                try {
                    $bulk = new MongoDB\Driver\BulkWrite;
                    
                    $doc = ['_id' => new MongoDB\BSON\ObjectID, 
                    'id_proveedor' => $id_proveedor, 
                    'nombre' => $nombre,
                    'correo' => $correo,
                    'telefono' => $telefono,   
                    'direccion' => $direccion];
                    
                    $bulk->insert($doc);
                    
                    $client->executeBulkWrite('proveedores.backup', $bulk);
                        
                } catch (MongoDB\Driver\Exception\Exception $e) {
                
                    $filename = basename(__FILE__);
                    
                    echo "The $filename script has experienced an error.\n"; 
                    echo "It failed with the following exception:\n";
                    
                    echo "Exception:", $e->getMessage(), "\n";
                    echo "In file:", $e->getFile(), "\n";
                    echo "On line:", $e->getLine(), "\n";    
                } 
            }
        }    
    } catch (PDOException $pdex) {
        exit($pdex->getMessage());
    }
?>
<script> location.replace("backupProveedores.php"); </script>