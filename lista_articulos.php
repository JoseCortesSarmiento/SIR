<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';

if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}

include 'global/header.php';



?>


<?php


$sentencia = $pdo->prepare('SELECT ap.id_articulos_proveedores, a.id_articulo, a.nombre, ap.precio, a.unidad_medida, a.stock_minimo, a.stock_almacenado, a.stock_maximo, a.descripcion, a.estatus, p.nombre as proveedor
FROM lista_articulos a, proveedores p, articulos_proveedores ap 
WHERE a.id_articulo = ap.id_articulo and p.id_proveedor = ap.id_proveedor');
$sentencia->execute();
$articulos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>






<div class="view full-page-intro" style="background-image: url('https://www.losdanzantes.com/assets/img/oaxaca/los-danzantes-oaxaca.jpg'); background-repeat: no-repeat; background-size: cover;">

	
	
	
	<div class="container" style="margin-top:10vh;margin-bottom:50vh; ">  
		<div class="card">
		
		
		
		<div class="card-body">
		
		
		<h3 align="center">Lista de Compras</h3>  
		<br />  
		<div class="table-responsive">  
			<table id="lista_articulos" class="table table-striped table-bordered">  
				<thead>  
					<tr>  
						<th>Nombre</th>
						<th>Precio</th>
						<th>Unidad medida</th>
						<th>Stock minimo</th>
						<th>Stock almacenado</th>
						<th>Stock máximo</th>
						<th>Descripción</th>
						<th>Proveedor</th>
					</tr>  
				</thead>  
				<?php foreach ($articulos as $articulo): ?>
					
					<tr>
						<td> <?=$articulo['nombre']?></td>
						<td>$ <?=$articulo['precio']?></td>
						<td> <?=$articulo['unidad_medida']?></td>
						<td> <?=$articulo['stock_minimo']?></td>
						<td> <?=$articulo['stock_almacenado']?></td>
						<td> <?=$articulo['stock_maximo']?></td>
						<td> <?=$articulo['descripcion']?></td> 
						<td> <?=$articulo['proveedor']?></td>   
					</tr>

				<?php endforeach; ?>
			</table>  
			</div>  
		
	
		</div>
		<hr>
		
		
		</div>
	</div>  

</div>
<script>  
	$(document).ready(function(){  
		$('#lista_articulos').DataTable();  
	}); 
</script>  