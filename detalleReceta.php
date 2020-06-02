<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';


if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}





if (!empty($_GET['id_receta'])) { 
    $id_receta = $_REQUEST['id_receta']; 
    //  echo $id_proveedor;
} 



function getImporte(int $id_receta){

   $host= "localhost";
   $dbname= "sistemarest";
   $username="root";
   $password="";
  


    try{
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $sql10= "CALL calculaImporte(:id_receta, @total)";
        $importe= $pdo->prepare($sql10);
        $importe->bindParam(':id_receta',$id_receta, PDO::PARAM_INT);
        $importe->execute();
        $importe->closeCursor();
        
        
        $row2 = $pdo->query("SELECT @total AS total")->fetch(PDO::FETCH_ASSOC);
                if ($row2) {
                    return $row2 !== false ? $row2['total'] : null;
                }
               
        
        echo $row2['total'];
    }
        catch (PDOException $e) {
            die("Error occurred:" . $e->getMessage());
        }
        return null;
    
        
}
$miImporte=getImporte($id_receta);

$insertado="UPDATE recetas set importe_total=:importe_total WHERE id_receta=:id_receta";
$stmt10 = $pdo->prepare($insertado); 
$stmt10->execute(['importe_total'=>$miImporte, 'id_receta'=>$id_receta]);







$sql = "SELECT * FROM recetas where  id_receta = ?";
$q=$pdo->prepare($sql);
$q->execute(array($id_receta));
$receta = $q->fetch(PDO::FETCH_ASSOC); 




$sql4="SELECT a.nombre,ra.gramaje, a.unidad_medida, ap.precio, ra.costo_total
FROM articulos a, recetas_articulos ra, recetas r, articulos_proveedores ap
WHERE r.id_receta=? AND ra.id_receta=r.id_receta AND ra.id_articulos_proveedores=ap.id_articulos_proveedores AND ap.id_articulo=a.id_articulo";

$q=$pdo->prepare($sql4);
$q->execute(array($id_receta));
$articulos = $q->fetchAll(PDO::FETCH_ASSOC); 



?>

<div class="view full-page-intro" style="background-image: url('https://www.losdanzantes.com/assets/img/oaxaca/los-danzantes-oaxaca.jpg'); background-repeat: no-repeat; background-size: cover;">



<div class="container" style="margin-top:10vh; margin-bottom:10vh;">

    
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
                        <td>$<?=$articulo['costo_total']?></td>
					</tr>

				<?php endforeach; ?> 
			</table>  
        </div>
        <br>
        <hr class="my-2">
        <div class="text-right">
        <p class="lead">  <strong>Importe:</strong> $<?= $miImporte?></p>
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
    <div class="text-center">
  <a class="btn btn-purple btn-rounded mb-4" href="backupDetalleRecetas.php?id_receta=<?=$receta['id_receta']?>">Backup</a>
</div>
</div>
</div>



</div>
<script>  
	$(document).ready(function(){  
		$('#articulos').DataTable();  
	}); 
</script> 