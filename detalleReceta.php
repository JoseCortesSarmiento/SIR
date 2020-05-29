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


$sql2 = "SELECT a.nombre, a.unidad_medida, ap.precio, ra.gramaje from articulos_proveedores ap,  articulos a, recetas r, recetas_articulos ra where  ra.id_receta = ? AND a.id_articulo = ra.id_articulo";
$sql3="SELECT a.nombre, a.unidad_medida from  articulos a, recetas r, recetas_articulos ra WHERE  ra.id_receta = ? AND a.id_articulo = ra.id_articulo";

$sql4="SELECT a.nombre,ra.gramaje, a.unidad_medida
FROM articulos a, recetas_articulos ra, recetas r
WHERE r.id_receta=? AND ra.id_receta=r.id_receta AND ra.id_articulo=a.id_articulo";

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
					</tr>  
				</thead>  
				 <?php foreach ($articulos as $articulo): ?> 
					
					<tr>
						<td> <?=$articulo['nombre']?></td>
						<td> <?=$articulo['gramaje']?></td>
						<td> <?=$articulo['unidad_medida']?></td>
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