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
 
 <div class="view full-page-intro" style="background-image: url('https://www.losdanzantes.com/assets/img/oaxaca/los-danzantes-oaxaca.jpg'); background-repeat: no-repeat; background-size: cover;">

  <div class="container" style="margin-top:10vh;margin-bottom:50vh; ">  
  <div class="card">
    <div class="card-body">
    <h3 align="center">Backup Proveedores</h3>  
		<br />  
		<div class="table-responsive">  

<table id="proveedores" class="display" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
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
            $rows = $client->executeQuery('proveedores.backup', $query);

            // Convert rows to Array and send result back to javascript as json
            $rowsArr = $rows->toArray();
            //echo json_encode($rowsArr);

            $json_encoded = json_encode($rowsArr);

            $json_decoded = json_decode($json_encoded);

            foreach($json_decoded as $result){
            echo '<tr>';
                echo '<td>'.$result->nombre.'</td>';
                echo '<td>'.$result->correo.'</td>';
                echo '<td>'.$result->telefono.'</td>';
                echo '<td>'.$result->direccion.'</td>';
            echo '</tr>';
            }


    ?>
</table>
<div class="text-center">
  <a href="backupProveedoresScript.php" 
  class="btn btn-default btn-rounded mb-4">Actualizar</a>
</div>
<div class="text-center">
  <a href="deleteBackupProveedores.php" 
  class="btn btn-default btn-rounded mb-4">Borrar</a>
</div>
</div>  
    
    </div>
  </div>
	</div> 
  
  </div>
<script>  
	$(document).ready(function(){  
		$('#proveedores').DataTable();  
	}); 
</script>  


