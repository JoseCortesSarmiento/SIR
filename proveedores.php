<?php
include 'global/config.php';
include 'global/conexion.php';
include 'global/header.php'
?>



<?php
$sentencia = $pdo->prepare('SELECT * FROM proveedores');
$sentencia->execute();
$articulos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<br />
<br />  
	<div class="container">  
		<h3 align="center">Proveedores</h3>  
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
    <?php foreach ($articulos as $articulo): ?>
        <tr>
            <td> <?=$articulo['nombre']?></td>
            <td> <?=$articulo['correo']?></td>
            <td> <?=$articulo['telefono']?></td>
            <td> <?=$articulo['direccion']?></td>
        </tr>
    <?php endforeach; ?>
</table>
</div>  
	</div> 
<script>  
	$(document).ready(function(){  
		$('#proveedores').DataTable();  
	}); 
</script>  