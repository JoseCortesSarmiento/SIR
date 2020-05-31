<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}


        // $sql8 ="SELECT COUNT(*) FROM recetas_articulos";
        // $stmt8 = $pdo->prepare($sql8);
        // $stmt8->execute();

        // $codigo=$stmt8+1;

if ( !empty($_POST)) {
    
		
    // keep track post values		
    $nombre = $_POST['nombre'];
    $foto_receta=$_POST['foto_receta'];
    $categoria = $_POST['categoria'];
    $presentacion=$_POST['presentacion'];
    $mise_en_place=$_POST['mise_en_place'];
    $preparacion=$_POST['preparacion'];
    $rendimiento=$_POST['rendimiento'];
    $codigo=$_POST['codigo'];

    echo $nombre;
    echo $foto_receta;
    echo $categoria;
    echo $presentacion;

   
    

    try{
        $pdo->beginTransaction(); 
        $sql = "INSERT INTO recetas (nombre_platillo, foto_receta, categoria,  presentacion, mise_en_place, preparacion, rendimiento, codigo) values(?, ?, ?, ?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $foto_receta, $categoria,  $presentacion, $mise_en_place, $preparacion, $rendimiento, $codigo]);
        $id_receta=$pdo->lastInsertId();
        $_SESSION['receta']=$id_receta; 
        echo $id_receta;
        $pdo->commit(); 

        echo '<script type="text/javascript">'; 
        echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha agregado una nueva receta '.$nombre.'","success");'; 
        echo '}, 500);</script>'; 
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
<div class="jumbotron">
<h2 class="h1-responsive text-center" >Agregar nueva receta</h2>
    <br>
    <form action="addReceta.php" method="post">
    <div class="md-form mb-5">
        <input type="text"  class="form-control validate" name="nombre" >
        <label data-error="wrong" data-success="right" >Nombre platillo</label>
    </div>

    <div class="md-form mb-5">
            <input type="text"  class="form-control validate" value=10 name="codigo" hidden>
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
            <input type="text" class="form-control validate" value=1 name="rendimiento" hidden>
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
        <button type="submit"  class="btn ">Agregar</button>
    </div>

</form>

    
</div>
</div>


    
 
    

