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


$id_receta=$_SESSION['receta'];





if ( !empty($_POST['id_articulos_proveedores'])||!empty($_POST['gramaje'] )) {	
    $gramaje = $_POST['gramaje'];
    $id_articulos_proveedores =$_POST['id_articulos_proveedores'];

    
    echo "El gramaje es".$gramaje;

   
    

    try{
        $pdo->beginTransaction(); 
        $sql = "INSERT INTO recetas_articulos (id_articulos_proveedores,id_receta,gramaje) values(?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_articulos_proveedores, $id_receta, $gramaje]);
        $id_receta_articulo=$pdo->lastInsertId();

        echo $gramaje;
             
        $precio="SELECT precio FROM articulos_proveedores where id_articulos_proveedores=:id_articulos_proveedores";
        $stmt2=$pdo->prepare($precio);
        $stmt2->execute(['id_articulos_proveedores'=>$id_articulos_proveedores]);
        $elPrecio = $stmt2->fetch(PDO::FETCH_ASSOC);
        echo "El precio es".$elPrecio['precio'];

        $precioXgramaje=$elPrecio['precio']*$gramaje;


        echo "El precio x gramaje es". $precioXgramaje;

        $insertaPrecio="UPDATE recetas_articulos SET costo_total=:costo_total WHERE id_receta_articulo=:id_receta_articulo";
        $stmt3 = $pdo->prepare($insertaPrecio);
        $stmt3->execute(['costo_total'=>$precioXgramaje,'id_receta_articulo'=>$id_receta_articulo ]);

        $pdo->commit(); 



        echo '<script type="text/javascript">'; 
        echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha agregado un nuevo articulo a la receta","success");'; 
        echo '}, 500);</script>'; 

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
                        <th>ID articulos_proveedores</th>
                        <th>Seleccionar</th>
					</tr>  
				</thead>  
				<?php foreach ($articulos as $articulo): ?>
					<tr>
						<td> <?=$articulo['nombre']?></td>
						<td> <?=$articulo['proveedor']?></td>
						<td> <?=$articulo['precio']?></td>
                        <td><?=$articulo['id_articulos_proveedores']?></td>
                        <td>
                        <div class="custom-control custom-radio">
                            <!-- <input type="radio" class="custom-control-input"  name="id_articulo" > -->
                            <input type="radio" name="id_articulos_proveedores" value="<?=$articulo['id_articulos_proveedores']?>">
                            <!-- <label class="custom-control-label" for="defaultUnchecked">Default unchecked</label> -->
                        </div>
                        </td>
					</tr>
				<?php endforeach; ?>
			</table>  
        </div>

        <div class="md-form mb-5">
            <input type="text"  class="form-control validate" name="gramaje" >
            <label data-error="wrong" data-success="right" >Gramaje del producto seleccionado</label>
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

    