<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';



if (!empty($_GET['id_receta'])) { 
    $id_receta = $_REQUEST['id_receta']; 
} 

$rendimiento2=0;

if ( !empty($_POST)) {
    
			
    $rendimiento2 = $_POST['rendimiento2'];
    $id_receta=$_POST['id_receta'];
    echo "eL NUEVO RENDIMIENTO ES ".$rendimiento2;
    echo "El id de la receta es  ".$id_receta;

    $sql4="SELECT a.nombre,ra.gramaje, a.unidad_medida, ap.precio, ra.costo_total, r.rendimiento, a.id_articulo, a.stock_almacenado
    FROM articulos a, recetas_articulos ra, recetas r, articulos_proveedores ap
    WHERE r.id_receta=? AND ra.id_receta=r.id_receta AND ra.id_articulos_proveedores=ap.id_articulos_proveedores AND ap.id_articulo=a.id_articulo";

    $q=$pdo->prepare($sql4);
    $q->execute(array($id_receta));
    $articulos = $q->fetchAll(PDO::FETCH_ASSOC); 

    $_SESSION['listado'] = array();

    foreach ($articulos as $articulo){
        echo "adios";

        
        //  $_SESSION['listado']=array($articulo['id_articulo'] =>($rendimiento2*$articulo['gramaje']));
         echo $articulo['nombre'];

        //agrego los productos de la receta  a mi session de listado
         if (isset($_SESSION['listado']) && is_array($_SESSION['listado'])) {
            if (!array_key_exists($articulo['id_articulo'], $_SESSION['listado'])) {
                // el articulo no existe en mi listado
                $_SESSION['listado'][$articulo['id_articulo']] = $rendimiento2*$articulo['gramaje'];
            } else {
                
               
            }
        } else {
            // agregar el primer articulo
            $_SESSION['listado']=array($articulo['id_articulo'] =>($rendimiento2*$articulo['gramaje']));
        }

    }



    try{

    $disminuirStock =  $pdo->prepare("UPDATE articulos SET stock_almacenado = :stock_almacenado WHERE id_articulo = :id_articulo");

    $pdo->beginTransaction();

    foreach ($articulos as $articulo) {
        if($articulo['stock_almacenado']-($articulo['gramaje']*$rendimiento2)<0) {
            $disminuirStock->execute(['dsa']);
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ERROR!","El producto no pudo ser actualizado","error");'; 
            echo '}, 500);</script>'; 
        }
            
        else{
            $disminuirStock->execute(['stock_almacenado'=>($articulo['stock_almacenado']-($articulo['gramaje']*$rendimiento2)),'id_articulo'=>$articulo['id_articulo']]); 
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Si puede hacer la receta, hay suficientes productos","success");'; 
            echo '}, 500);</script>';  
        }
    }

    $_SESSION['listado'] = array();
    $pdo->commit(); 
    // print_r($_SESSION)['listado'];

     }
    catch(Exception $e){
        if($pdo->inTransaction()) $pdo->rollback();
        $errores = 1;  
        // var_dump($e);
    }
   

}


$sql = "SELECT * FROM recetas where  id_receta = ?";
$q=$pdo->prepare($sql);
$q->execute(array($id_receta));
$receta = $q->fetch(PDO::FETCH_ASSOC); 

$sql4="SELECT a.nombre,ra.gramaje, a.unidad_medida, ap.precio, ra.costo_total, r.rendimiento, a.id_articulo, a.stock_almacenado
FROM articulos a, recetas_articulos ra, recetas r, articulos_proveedores ap
WHERE r.id_receta=? AND ra.id_receta=r.id_receta AND ra.id_articulos_proveedores=ap.id_articulos_proveedores AND ap.id_articulo=a.id_articulo";

$q=$pdo->prepare($sql4);
$q->execute(array($id_receta));
$articulos = $q->fetchAll(PDO::FETCH_ASSOC); 
$_SESSION['receta']=$id_receta; 






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


         
       
          
    </div>
    <hr>
    <div class="row">
    <div class="col-4"></div>
        <div class="col-4 ">
            <img src="https://res.cloudinary.com/dlkn9mexh/image/upload/v1590681517/28e961d4bdff55d94628b69482fa9a0f_frtcwu.jpg" class="img-fluid" alt="Responsive image">
        </div>
    <div class="col-4"></div>
    </div>

    <form action="detalleRecetaCocinero.php" method="post">
            <div class="md-form mb-5">
            <input type="text" id="defaultForm-email" class="form-control validate" name="rendimiento2" >
            <label data-error="wrong" data-success="right" for="defaultForm-email">Rendimiento</label>
            </div>
            <input type="text" id="defaultForm-email" class="form-control validate" name="id_receta" hidden value="<?php echo $id_receta ?>">
            
    <div class="table-responsive">  
			<table id="articulos" class="table table-striped table-bordered">  
				<thead>  
					<tr>  
						<th>Nombre</th>
						<th>Gramaje</th>
						<th>Unidad medida</th>
                        <th>Rendimiento</th>
                        <th>Almacenado</th>

					</tr>  
				</thead>  
				 <?php foreach ($articulos as $articulo): ?> 
					
					<tr>
						<td> <?=$articulo['nombre']?>   <input type="text" id="defaultForm-email" class="form-control validate" name="id_articulo" hidden value="<?php  $articulo['id_articulo'] ?>"></td>

                        <?php if($rendimiento2==0) : ?>
                            <td> <?=$articulo['gramaje']*$articulo['rendimiento']?></td>
                        <?php else : ?>
                            <td> <?=$articulo['gramaje']*$rendimiento2?></td>
                        <?php endif; ?>

						<td> <?=$articulo['unidad_medida']?></td>
                      
                        
                        <?php if($rendimiento2==0) : ?>
                            <td> 1</td>
                        <?php else : ?>
                            <td> <?=$rendimiento2?></td>
                        <?php endif; ?>
                        <td><?=$articulo['stock_almacenado']?>  </td>
                        
					</tr>

                 

				<?php endforeach; ?> 

			</table>  
        </div>
        <br>
       
            <div class="modal-footer d-flex justify-content-center">
        <button type="submit"  class="btn btn-default">Usar</button>
      </div>
    </form>

       

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

   
    
</div>
</div>

<script>  
	$(document).ready(function(){  
		$('#articulos').DataTable();  
	}); 
</script> 