<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';


$sentencia = $pdo->prepare('SELECT ap.id_articulos_proveedores, a.id_articulo, a.nombre, ap.precio, a.unidad_medida, a.stock_minimo, a.stock_almacenado, a.stock_maximo, a.descripcion, a.estatus, p.nombre as proveedor
FROM articulos a, proveedores p, articulos_proveedores ap 
WHERE a.id_articulo = ap.id_articulo and p.id_proveedor = ap.id_proveedor');
$sentencia->execute();
$articulos = $sentencia->fetchAll(PDO::FETCH_ASSOC);







// print_r($_SESSION['receta']);

$id_receta=$_SESSION['receta'];
// echo $id_receta;




// $sql2 = "INSERT INTO recetas_articulos (id_receta, id_articulo, gramaje) VALUES(?,?,?)";
// $stmt2 = $pdo->prepare($sql2);


// $stmt->execute([$nombre, $unidad_medida, $stock_minimo, $stock_almacenado,$stock_maximo, $descripcion, $estatus]);	
// $articuloId=$pdo->lastInsertId();
// echo $id_proveedor;
// $stmt2->execute([$articuloId, $id_proveedor, $precio]);
//       echo '<script type="text/javascript">'; 
//       echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha agregado un nuevo articulo","success");'; 
//       echo '}, 500);</script>'; 




if ( !empty($_POST['id_articulos_proveedores'])||!empty($_POST['gramaje'] )) {
    
		
    // keep track post values		
    $gramaje = $_POST['gramaje'];
    $id_articulos_proveedores =$_POST['id_articulos_proveedores'];

    
    echo "El gramaje es".$gramaje;
    // echo "El id del articulo es".$id_articulo;


   
    

    try{
        $pdo->beginTransaction(); 
        $sql = "INSERT INTO recetas_articulos (id_articulos_proveedores,id_receta,gramaje) values(?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_articulos_proveedores, $id_receta, $gramaje]);
        // echo $id_receta;
        echo $gramaje;
        $pdo->commit(); 

        // echo '<script type="text/javascript">'; 
        // echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha agregado una nueva receta '.$nombre.'","success");'; 
        // echo '}, 500);</script>'; 
        // $arr = $stmt->errorInfo();
        // print_r($arr);

        //de articulos
        header('location: articuloReceta.php');

        

    }

    catch(Exception $e){ 
        $pdo->rollback(); 
        throw $e;  
    } 


   
   
}


?>

<div class="container">

    
<form action="articuloReceta.php" method="post">

<div class="table-responsive">  
			<table id="articulos" class="table table-striped table-bordered">  
				<thead>  
					<tr>  
						<th>Nombre</th>
						<th>Proveedor</th>
                        <th>Precio</th>
                        <th>Gramaje</th>
                        <th>ID articulos_proveedores</th>
                        <th>Seleccionar</th>
					</tr>  
				</thead>  
				<?php foreach ($articulos as $articulo): ?>
					<tr>
						<td> <?=$articulo['nombre']?></td>
						<td> <?=$articulo['proveedor']?></td>
						<td> <?=$articulo['precio']?></td>
                        <td> <input type="text" name="gramaje" ></td>
                        <td><?=$articulo['id_articulos_proveedores']?></td>
                        <td>
                        <div class="custom-control custom-radio">
                            <!-- <input type="radio" class="custom-control-input"  name="id_articulo" > -->
                            <input type="radio" name="id_articulos_proveedores" value="<?=$articulo['id_articulos_proveedores']?>">Seleccionar
                            <!-- <label class="custom-control-label" for="defaultUnchecked">Default unchecked</label> -->
                        </div>
                        </td>
					</tr>
				<?php endforeach; ?>
			</table>  
        </div>

        <div class="modal-footer d-flex justify-content-center">
        <button type="submit"  class="btn ">Agregar</button>
    </div>
</form>


</div>
<script>  
$(document).ready(function(){  
		$('#articulos').DataTable();  
	}); 
</script> 

    