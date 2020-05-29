<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';
include 'global/header.php';


// $sentencia = $pdo->prepare('SELECT ap.id_articulos_proveedores, a.id_articulo, a.nombre, ap.precio, a.unidad_medida, a.stock_minimo, a.stock_almacenado, a.stock_maximo, a.descripcion, a.estatus, p.nombre as proveedor
// FROM articulos a, proveedores p, articulos_proveedores ap 
// WHERE a.id_articulo = ap.id_articulo and p.id_proveedor = ap.id_proveedor');
// $sentencia->execute();
// $articulos = $sentencia->fetchAll(PDO::FETCH_ASSOC);


if ( !empty($_POST)) {
		
    // keep track post values		
    $nombre = $_POST['nombre'];
    $foto_receta=$_POST['foto_receta'];
    $categoria = $_POST['categoria'];
    $presentacion=$_POST['presentacion'];
    $mise_en_place=$_POST['mise_en_place'];
    $preparacion=$_POST['preparacion'];

    echo $nombre;
    echo $foto_receta;
    echo $categoria;
    echo $presentacion;

    try{
        $pdo->beginTransaction(); 
        $sql = "INSERT INTO recetas (nombre_platillo, foto_receta, categoria,  presentacion, mise_en_place, preparacion) values(?, ?, ?, ?,?,?)";
        $stmt = $conn->prepare($sql);
        
        $stmt->execute([$nombre, $foto_receta, $categoria,  $presentacion, $mise_en_place, $preparacion]);
        $pdo->commit(); 

        echo '<script type="text/javascript">'; 
        echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha agregado una nueva receta '.$nombre.'","success");'; 
        echo '}, 500);</script>'; 

    }

    catch(Exception $e){ 
        $pdo->rollback(); 
        throw $e;  
    } 

   
}
?>

<div class="container">
<div class="jumbotron">
<h2 class="h1-responsive text-center" >Agregar nueva receta</h2>
    <br>
    <form action="addReceta.php" method="post">
    <div class="md-form mb-5">
        <input type="text"  class="form-control validate" name="nombre" >
        <label data-error="wrong" data-success="right" >Nombre platillo</label>
    </div>

    <div class="md-form mb-5">
            <input type="text"  class="form-control validate" disabled value=10>
            <label data-error="wrong" data-success="right">Codigo</label>
    </div>
    <div class="text-left">       
          <div class="md-form mb-5">
            <select class="browser-default custom-select" name="categoria">
                <option selected value="cocktail">Cocktail</option>
                <option value="entrada">Entrada</option>
                <option value="plato fuerte">Plato fuerte</option>
                <option value="postre">Postre</option>
                <option value="para compartir">Para compartir</option>
                <option value="bebida">Bebida</option>
            </select>
          </div>


          <div class="md-form mb-5">
            <input type="text" class="form-control validate"  disabled value=1>
            <label data-error="wrong" data-success="right">Rendimiento</label>
          </div>
          

         
    </div>
    <div class="md-form mb-5">
            <input type="text"  class="form-control validate" name="foto_receta"  >
            <label data-error="wrong" data-success="right">Foto platillo</label>
    </div>
   
    <hr class="my-2">


   
        
    <div class="md-form mb-4 pink-textarea active-pink-textarea-2">
        <i class="fas fa-angle-double-right prefix"></i>
        <textarea  class="md-textarea form-control" rows="7" name="presentacion"></textarea>
        <label for="form23">Presentación</label>
    </div>

    <hr class="my-2">
    <div class="md-form mb-4 pink-textarea active-pink-textarea-2">
        <i class="fas fa-angle-double-right prefix"></i>
        <textarea  class="md-textarea form-control" rows="7" name="mise_en_place"></textarea>
        <label for="form23">Mise en place</label>
    </div>


    <hr class="my-2">
    <div class="md-form mb-4 pink-textarea active-pink-textarea-2">
        <i class="fas fa-angle-double-right prefix"></i>
        <textarea id="form23" class="md-textarea form-control" rows="7" name="preparacion"></textarea>
        <label for="form23">Preparación</label>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <button type="submit"  class="btn btn-default">Agregar</button>
    </div>

</form>
    
</div>
</div>

    
    
 
    

