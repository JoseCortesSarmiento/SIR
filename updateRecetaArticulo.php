<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
// tengo mi duda de si esta sesiondebe estar
// include 'global/sesion.php';


$sentencia = $pdo->prepare('SELECT ap.id_articulos_proveedores, a.id_articulo, a.nombre, ap.precio, a.unidad_medida, a.stock_minimo, a.stock_almacenado, a.stock_maximo, a.descripcion, a.estatus, p.nombre as proveedor
FROM articulos a, proveedores p, articulos_proveedores ap 
WHERE a.id_articulo = ap.id_articulo and p.id_proveedor = ap.id_proveedor');
$sentencia->execute();
$articulos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$id_receta=$_SESSION['receta'];


// $query = $pdo->prepare("CREATE VIEW my_view AS ( SELECT a.nombre,ra.gramaje, a.unidad_medida, ap.precio, ra.costo_total, r.rendimiento, a.id_articulo, a.stock_almacenado
// FROM articulos a, recetas_articulos ra, recetas r, articulos_proveedores ap
// WHERE r.id_receta=$id_receta AND ra.id_receta=r.id_receta AND ra.id_articulos_proveedores=ap.id_articulos_proveedores AND ap.id_articulo=a.id_articulo)");
// $query->execute();
// $listas=$query->fetchAll(PDO::FETCH_ASSOC);








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
$query = $pdo->prepare(" SELECT a.nombre,ra.gramaje, a.unidad_medida, ap.precio, ra.costo_total, r.rendimiento, a.id_articulo, a.stock_almacenado, ra.id_receta_articulo
FROM articulos a, recetas_articulos ra, recetas r, articulos_proveedores ap
WHERE r.id_receta=$id_receta AND ra.id_receta=r.id_receta AND ra.id_articulos_proveedores=ap.id_articulos_proveedores AND ap.id_articulo=a.id_articulo");
$query->execute();
$listas=$query->fetchAll(PDO::FETCH_ASSOC);


?>

<div class="view full-page-intro" style="background-image: url('https://www.losdanzantes.com/assets/img/oaxaca/los-danzantes-oaxaca.jpg'); background-repeat: no-repeat; background-size: cover;">



<div class="container" style="margin-top:10vh;margin-bottom:50vh; ">

    
<div class="card">

<div class="card-body">
<h3 align="center">Agrega nuevos articulos a tu receta </h3>  

<form action="updateRecetaArticulo.php" method="post">

<div class="table-responsive">  
			<table id="articulos" class="table table-striped table-bordered">  
				<thead>  
					<tr>  
                        <th>Seleccionar</th>
						<th>Nombre</th>
						<th>Proveedor</th>
                        <th>Precio</th>
                       
					</tr>  
				</thead>  
				<?php foreach ($articulos as $articulo): ?>
					<tr>
                    <td>
                        <div class="custom-control custom-radio">
                            <!-- <input type="radio" class="custom-control-input"  name="id_articulo" > -->
                            <input type="radio" name="id_articulos_proveedores" value="<?=$articulo['id_articulos_proveedores']?>">
                            <!-- <label class="custom-control-label" for="defaultUnchecked">Default unchecked</label> -->
                        </div>
                        </td>
						<td> <?=$articulo['nombre']?></td>
						<td> <?=$articulo['proveedor']?></td>
						<td>$ <?=$articulo['precio']?></td>
                       
					</tr>
				<?php endforeach; ?>
			</table>  
        </div>

        <div class="md-form mb-5">
            <input type="text"  class="form-control validate" name="gramaje" >
            <label data-error="wrong" data-success="right" >Gramaje del producto seleccionado</label>
        </div>

         


        <div class="modal-footer d-flex justify-content-center">
        <button type="submit"  class="btn  btn-default">Agregar</button>


        
    </div>
    <h3 align="center">Articulos que ya contiene la receta</h3>  
    <div class="table-responsive">  
			<table id="articulos" class="table table-striped table-bordered">  
				<thead>  
					<tr>  
						<th>Nombre</th>
						<th>Gramaje</th>
                        <th>Precio</th>
                        <th>Eliminar articulo</th>
                       
					</tr>  
				</thead>  
				<?php foreach ($listas as $lista): ?>
					<tr>
                    
                        
						<td> <?=$lista['nombre']?></td>
						<td> <?=$lista['gramaje']?></td>
						<td> $<?=$lista['precio']?></td>
                        <td>
                        <span style="font-size: 32px; color: tomato;">
                            <a href="deleteArticuloReceta.php?id_receta_articulo=<?=$lista['id_receta_articulo']?>" 
                            class="btn btn-red btn-rounded mb-4" > 
                            
                            <i class="fas fa-trash-alt"></i></a>
                        </span>  
                        </td>
                       
					</tr>
				<?php endforeach; ?>
			</table>  

    <div class="text-right">
   
   <span style="font-size: 32px; color: tomato;">
                <a href="detalleReceta.php?id_receta=<?=$id_receta?>" 
                class="btn btn-secondary-color btn-rounded mb-4" > 
                <i class="fas fa-eye"></i></a>
    </span> 
   </div>
</form>



</div>

</div>

</div>

</div>
<script>  
$(document).ready(function(){  
		$('#articulos').DataTable();  
	}); 
</script> 

    