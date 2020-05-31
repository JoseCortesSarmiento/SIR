<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';

if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}

include 'global/header.php';
include 'addArticulo.php';


?>


<?php
$sentencia = $pdo->prepare('SELECT ap.id_articulos_proveedores, a.id_articulo, a.nombre, ap.precio, a.unidad_medida, a.stock_minimo, a.stock_almacenado, a.stock_maximo, a.descripcion, a.estatus, p.nombre as proveedor
FROM articulos a, proveedores p, articulos_proveedores ap 
WHERE a.id_articulo = ap.id_articulo and p.id_proveedor = ap.id_proveedor');
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
		<a href="articuloExistente.php" class="text-decoration-none">Agregar proveedor nuevo a artículo ya existente</a>
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
                        <th>Proveedor</th>
                        <th>Acciones</th>
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
                        <td> <?=$articulo['proveedor']?></td>  
                        
                        <td>

                        <span style="font-size: 32px; color: darkturquoise;">
                            <a href="updateArticulos.php?id_articulo=<?=$articulo['id_articulo']?>"class="btn btn-default btn-rounded mb-4" > <i class="fas fa-edit"></i></a>
                        </span>

                        <span style="font-size: 32px; color: tomato;">
                            <a href="deleteArticulo.php?id_articulos_proveedores=<?=$articulo['id_articulos_proveedores']?>" class="btn btn-red btn-rounded mb-4" > <i class="fas fa-trash-alt"></i></a>
                        </span>  
                       
                        </td>   
					</tr>

				<?php endforeach; ?>
			</table>  

            <div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalAddArticulo">Agregar articulo</a>
</div>
		</div>  
	</div>  
</body>  
</html>  
<script>  
	$(document).ready(function(){  
		$('#articulos').DataTable();  
	}); 
</script>  