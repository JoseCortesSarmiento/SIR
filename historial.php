<?php 
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);

include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';
include 'global/header.php';
?>


<?php 
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);

echo "Historial";
$sentencia = $conn->prepare('SELECT * FROM historial');
$sentencia->execute();
$historiales = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<br />
<br />  
	<div class="container">  
		<h3 align="center">Historial</h3>  
		<br />  
		<div class="table-responsive">  

<table id="historial" class="display" class="table table-striped table-bordered" align="center"> 
    <thead>
        <tr>
            <th>Indice</th>
            <th>Usuario</th>
            <th>Descripción</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <?php foreach ($historiales as $historial): ?>
        <tr>
            <td> <?=$historial['id_historial']?></td>
            <td> <?=$historial['id_usuario']?></td>
            <td> <?=$historial['descripcion']?></td>
            <td> <?=$historial['fecha']?></td>
  
        </tr>
    <?php endforeach; ?>
</table>
</div>  
	</div> 
<script>  
	$(document).ready(function(){  
		$('#historial').DataTable();  
	}); 
</script>  



