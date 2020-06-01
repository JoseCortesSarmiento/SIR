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
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);

try {
        $sql = "SELECT * FROM recetas";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $rst = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (is_array($rst)) {
            //borramos todos los documentos antes de hacer backup
            $bulk = new MongoDB\Driver\BulkWrite;
            $bulk->delete([]);
            $client->executeBulkWrite('recetas.backup', $bulk);

            foreach($rst as $row) {
            // get column data from mysql
            $id_receta = $row["id_receta"];
            $nombre_platillo = $row["nombre_platillo"];
            $foto_receta = $row["foto_receta"];
            $codigo = $row["codigo"];
            $categoria = $row["categoria"];
            $rendimiento = $row["rendimiento"];
            $presentacion = $row["presentacion"];
            $mise_en_place = $row["mise_en_place"];
            $preparacion = $row["preparacion"];

              if (!empty($result['id_receta'])) { 
                $id_receta = $result['id_receta']; 
                echo $id_receta;
            } 
            
            $sql="SELECT a.nombre,ra.gramaje, a.unidad_medida, ap.precio, ra.costo_total
            FROM articulos a, recetas_articulos ra, recetas r, articulos_proveedores ap
            WHERE r.id_receta=? AND ra.id_receta=r.id_receta AND ra.id_articulos_proveedores=ap.id_articulos_proveedores AND ap.id_articulo=a.id_articulo";
            if($sql){
                $q=$pdo->prepare($sql);
                $q->execute(array($id_receta));
                $articulos = $q->fetchAll(PDO::FETCH_ASSOC); 
            
                foreach ($articulos as $articulo){
                    $nombre_final = $articulo['nombre'];
                    $gramaje_final = $articulo['gramaje'];
                    $unidad_medida_final = $articulo['unidad_medida'];
                    $precio_final = $articulo['precio'];
                    $costo_total_final = $articulo['costo_total'];
                }
            } else {
                echo "ERROR";
            }

                // only insert
                try {
                    $bulk = new MongoDB\Driver\BulkWrite;
                    
                    $doc = ['_id' => new MongoDB\BSON\ObjectID, 
                    'id_receta' => $id_receta, 
                    'nombre_platillo' => $nombre_platillo,
                    'foto_receta' => $foto_receta,
                    'codigo' => $codigo,   
                    'categoria' => $categoria,
                    'rendimiento' => $rendimiento,
                    
                    'articulos' => $articulos,
                    
                    'presentacion' => $presentacion,
                    'mise_en_place' => $mise_en_place,
                    'preparacion' => $preparacion];
                    
                    $bulk->insert($doc);
                    
                    $client->executeBulkWrite('recetas.backup', $bulk);
                        
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
<script> location.replace("backupDetalleRecetas.php"); </script>