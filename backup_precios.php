<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';


if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}

include 'global/header.php';

?>


<?php
$sentencia = $pdo->prepare('SELECT  ba.id_articulo, a.nombre, ba.precioAnterior
FROM articulos a, backup_precio_articulos ba
WHERE ba.id_articulo = a.id_articulo');
$sentencia->execute();
$articulos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>






<div class="view full-page-intro" style="background-image: url('https://www.losdanzantes.com/assets/img/oaxaca/los-danzantes-oaxaca.jpg'); background-repeat: no-repeat; background-size: cover;">

	
	
	
	<div class="container" style="margin-top:10vh;margin-bottom:50vh; ">  
		<div class="card">
		
		
		
		<div class="card-body">
		
		
		<h3 align="center">Backup Precios</h3>  
		<br />  
		<div class="table-responsive">  
			<table id="backup_precios" class="table table-striped table-bordered">  
				<thead>  
					<tr>  
						<th>Nombre</th>
						<th>Precio</th>
					</tr>  
				</thead>  
				<?php foreach ($articulos as $articulo): ?>			
					<tr>
						<td> <?=$articulo['nombre']?></td>
						<td>$ <?=$articulo['precioAnterior']?></td>
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
		$('#backup_precios').DataTable();  
	}); 
</script>  