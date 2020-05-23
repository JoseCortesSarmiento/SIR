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
            <th>Acciones</th>
        </tr>
    </thead>
    <?php foreach ($articulos as $articulo): ?>
        <tr>
            <td> <?=$articulo['nombre']?></td>
            <td> <?=$articulo['correo']?></td>
            <td> <?=$articulo['telefono']?></td>
            <td> <?=$articulo['direccion']?></td>
            <td>
            <span style="font-size: 32px; color: tomato;">
                <i class="fas fa-trash-alt"></i>
            </span>

            <span style="font-size: 32px; color: darkturquoise;">
                <i class="fas fa-edit"></i>
            </span>
            
            </td>
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