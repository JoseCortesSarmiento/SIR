<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';



if (!empty($_GET['id_receta'])) { 
    $id_receta = $_REQUEST['id_receta']; 
    //  echo $id_proveedor;
} 



$sql = "SELECT * FROM recetas where  id_receta = ?";
$q=$pdo->prepare($sql);
$q->execute(array($id_receta));
$receta = $q->fetch(PDO::FETCH_ASSOC); 




$sql4="SELECT a.nombre,ra.gramaje, a.unidad_medida, ap.precio
FROM articulos a, recetas_articulos ra, recetas r, articulos_proveedores ap
WHERE r.id_receta=? AND ra.id_receta=r.id_receta AND ra.id_articulos_proveedores=ap.id_articulos_proveedores AND ap.id_articulo=a.id_articulo";

$q=$pdo->prepare($sql4);
$q->execute(array($id_receta));
$articulos = $q->fetchAll(PDO::FETCH_ASSOC); 











?>

<div class="container">

    
<div class="jumbotron">
    <h2 class="h1-responsive text-center" ><?= ucfirst($receta['nombre_platillo'])?></h2>
    <br>
    <br>
    <div class="row">
    <div class="col-sm">
        <img src="https://res.cloudinary.com/dlkn9mexh/image/upload/v1590681496/los-danzantes-oaxaca_nyhcmd.jpg" class="img-fluid" alt="Responsive image">
    </div>

    <div class="col-sm">
        <img src="<?=$receta['foto_receta']?>" class="img-fluid" alt="Responsive image">
    </div>
        
    </div>
    <br>
        <br>
    <div class="text-left">
          <p>
            <strong>Código:</strong> <?=$receta['codigo']?>
          </p>

          <p>
            <strong>Categoria:</strong> <?= ucfirst($receta['categoria'])?>
          </p>


          <p>
            <strong>Rendimiento:</strong> <?=$receta['rendimiento']?>
          </p>
          
    </div>
    <hr>
    <div class="row">
    <div class="col-4"></div>
        <div class="col-4 ">
            <img src="https://res.cloudinary.com/dlkn9mexh/image/upload/v1590681517/28e961d4bdff55d94628b69482fa9a0f_frtcwu.jpg" class="img-fluid" alt="Responsive image">
        </div>
    <div class="col-4"></div>
    </div>

    <div class="table-responsive">  
			<table id="articulos" class="table table-striped table-bordered">  
				<thead>  
					<tr>  
						<th>Nombre</th>
						<th>Gramaje</th>
						<th>Unidad medida</th>
                        <th>Costo unitario</th>
                        <th>Costo total</th>
					</tr>  
				</thead>  
				 <?php foreach ($articulos as $articulo): ?> 
					
					<tr>
						<td> <?=$articulo['nombre']?></td>
						<td> <?=$articulo['gramaje']?></td>
						<td> <?=$articulo['unidad_medida']?></td>
                        <td> $<?=$articulo['precio']?>.00</td>
                        <td>Hola</td>
					</tr>

				<?php endforeach; ?> 
			</table>  
        </div>
    <p>
        <strong>Presentación:</strong>
    </p>
    <p class="lead">  <?=ucfirst($receta['presentacion'])?></p>

    <hr class="my-2">
    <p>
        <strong>Mise en place:</strong>
    </p>
    <p class="lead">  <?=ucfirst($receta['mise_en_place'])?></p>
    <hr class="my-2">

    <p>
        <strong>Preparación:</strong>
    </p>
    <p class="lead">  <?=ucfirst($receta['preparacion'])?></p>
   
    <a class="btn btn-primary btn-lg" role="button" href="recetas.php">Ver todas</a>
</div>
</div>

<script>  
	$(document).ready(function(){  
		$('#articulos').DataTable();  
	}); 
</script> 