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

<br />
<br />  
	<div class="container">  
		<h3 align="center">Backup Recetas</h3>  
		<br />  
		<div class="table-responsive">  
        
<table id="recetas" class="display" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>id_receta</th>
            <th>nombre_platillo</th>
            <th>foto_receta</th>
            <th>codigo</th>
            <th>categoria</th>
            <th>rendimiento</th>
            <th>articulos</th>
            <th>presentacion</th>
            <th>mise_en_place</th>
            <th>preparacion</th>
        </tr>
    </thead>
    <?php
            //Mostrar errores en linux
            ini_set("display_errors", "1");
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED); 

            // Query Class
            $filter = [];
            $query = new MongoDB\Driver\Query($filter);

            // Output of the executeQuery will be object of MongoDB\Driver\Cursor class
            $rows = $client->executeQuery('recetas.backup', $query);

            // Convert rows to Array and send result back to javascript as json
            $rowsArr = $rows->toArray();
            //echo json_encode($rowsArr);

            $json_encoded = json_encode($rowsArr);

            $json_decoded = json_decode($json_encoded, true);
    ?>
        <?php foreach ($json_decoded as $result): 
            //Mostrar errores en linux
            ini_set("display_errors", "1");
            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
            ?>
            <tr>
                <td><?=$result['id_receta']?></td>
                <td><?=$result['nombre_platillo']?> </td>
                <td><?=$result['foto_receta']?></td>
                <td><?=$result['codigo']?></td>
                <td><?=$result['categoria']?></td>
                <td><?=$result['rendimiento']?></td>
                <td> <?php 				
                if (!empty($result['id_receta'])) { 
                    $id_receta = $result['id_receta']; 
                } 
                
                $sql="SELECT a.nombre,ra.gramaje, a.unidad_medida, ap.precio, ra.costo_total
                FROM articulos a, recetas_articulos ra, recetas r, articulos_proveedores ap
                WHERE r.id_receta=? AND ra.id_receta=r.id_receta AND ra.id_articulos_proveedores=ap.id_articulos_proveedores AND ap.id_articulo=a.id_articulo";
                if($sql){
                    $q=$pdo->prepare($sql);
                    $q->execute(array($id_receta));
                    $articulos = $q->fetchAll(PDO::FETCH_ASSOC); 
                
                    foreach ($articulos as $articulo){
                    //echo '<ul>';
                        echo '<li style="display:inline-block; overflow:auto;">', '<strong>',"Nombre: ",'</strong>', $articulo['nombre'], '</li>';
                        echo '<li style="display:inline-block; overflow:auto;">', '<strong>',"Gramaje: ", '</strong>', $articulo['gramaje'], '</li>';
                        echo '<li style="display:inline-block; overflow:auto;">', '<strong>',"Unidad de Medida: ", '</strong>', $articulo['unidad_medida'], '</li>';
                        echo '<li style="display:inline-block; overflow:auto;">', '<strong>',"Precio: ", '</strong>', $articulo['precio'], '</li>';
                        echo '<li style="display:inline-block; overflow:auto;">', '<strong>',"Costo Total: ", '</strong>', $articulo['costo_total'], '</li>';
                    //echo '<ul>';
                    echo '<br>';
                    echo '<br>';
                    }
                } else {
                    echo "ERROR";
                }
                ?></td>			
                
            
                <td><?=$result['presentacion']?></td>
                <td><?=$result['mise_en_place']?></td>
                <td><?=$result['preparacion']?></td>
            </tr>
        <?php endforeach; ?>
    
</table>
<div class="text-center">
  <a href="backupDetRecetasScript.php" 
  class="btn btn-default btn-rounded mb-4">Actualizar</a>
</div>
<div class="text-center">
  <a href="deleteBackupDetRecetas.php" 
  class="btn btn-default btn-rounded mb-4">Borrar</a>
</div>
</div>  
	</div> 
<script>  
	$(document).ready(function(){  
		$('#recetas').DataTable();  
	}); 
</script>  


