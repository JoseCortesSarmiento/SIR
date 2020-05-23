<?php
include 'global/config.php';
include 'global/conexion.php';
include 'global/header.php'
?>

<?php
$sentencia = $pdo->prepare('SELECT * FROM articulos  ORDER BY id_articulo DESC');
$sentencia->execute();
$articulos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>  
<html>  
<head>  
	<title>Artículos</title>  
</head>  
<body>  
	<br /><br />  
	<div class="container">  
		<h3 align="center">Artículos</h3>  
		<br />  
		<div class="table-responsive">  
			<table id="articulos" class="table table-striped table-bordered">  
				<thead>  
					<tr>  
						<th>Nombre</th>
						<th>Precio</th>
						<th>Unidad medida</th>
						<th>Stock minimo</th>
						<th>Stock almacenado</th>
						<th>Stock máximo</th>
						<th>Descripción</th>
						<th>Estatus</th>
					</tr>  
				</thead>  
				<?php foreach ($articulos as $articulo): ?>
					
					<tr>
						<td> <?=$articulo['nombre']?></td>
						<td> <?=$articulo['precio']?></td>
						<td> <?=$articulo['unidad_medida']?></td>
						<td> <?=$articulo['stock_minimo']?></td>
						<td> <?=$articulo['stock_almacenado']?></td>
						<td> <?=$articulo['stock_maximo']?></td>
						<td> <?=$articulo['descripcion']?></td>
						<td> <?=$articulo['estatus']?></td>   
					</tr>

				<?php endforeach; ?>
			</table>  
		</div>  
	</div>  
</body>  
</html>  
<script>  
	$(document).ready(function(){  
		$('#articulos').DataTable();  
	}); 
</script>  