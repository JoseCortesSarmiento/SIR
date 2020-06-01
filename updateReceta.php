<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}


if ( !empty($_POST)) {
    
		
    // keep track post values		
    $nombre_platillo = $_POST['nombre_platillo'];
     $foto_receta=$_POST['foto_receta'];
    $foto_receta=$_POST['foto_receta'];
    $categoria = $_POST['categoria'];
    $presentacion=$_POST['presentacion'];
    $mise_en_place=$_POST['mise_en_place'];
    $preparacion=$_POST['preparacion'];
    $rendimiento=$_POST['rendimiento'];

    echo $foto_receta;
    echo $categoria;
    echo $presentacion;

   
    

    try{
        $id_receta=$_SESSION['receta'];
        $pdo->beginTransaction(); 
        $sql = "UPDATE recetas SET nombre_platillo=:nombre_platillo, foto_receta=:foto_receta, categoria=:categoria,  presentacion=:presentacion, mise_en_place=:mise_en_place, preparacion=:preparacion, rendimiento=:rendimiento where id_receta=:id_receta";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['nombre_platillo'=>$nombre_platillo, 'foto_receta'=>$foto_receta, 'categoria'=>$categoria,'presentacion'=> $presentacion, 'mise_en_place'=>$mise_en_place, 'preparacion'=>$preparacion, 'rendimiento'=>$rendimiento, 'id_receta'=>$id_receta]);
        echo $id_receta;
        $pdo->commit(); 

        echo '<script type="text/javascript">'; 
        echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha actualizado la receta '.$nombre_platillo.'","success");'; 
        echo '}, 500);</script>'; 
        // $arr = $stmt->errorInfo();
        // print_r($arr);

        //de articulos
        header('location: updateRecetaArticulo.php');

        

    }

    catch(Exception $e){ 
        $pdo->rollback(); 
        throw $e;  
    } 


   
   
}


?>

<div class="view full-page-intro" style="background-image: url('https://www.losdanzantes.com/assets/img/oaxaca/los-danzantes-oaxaca.jpg'); background-repeat: no-repeat; background-size: cover;">

<div class="container" style="margin-top:10vh; margin-bottom:10vh;">
<div class="jumbotron">
<h2 class="h1-responsive text-center" >Actualizar receta</h2>
    <br>
    <form action="updateReceta.php" method="post">
    <div class="md-form mb-5">
        <input type="text"  class="form-control validate" name="nombre_platillo" value="<?php echo !empty($nombre_platillo)?$nombre_platillo:''; ?>">
        <label data-error="wrong" data-success="right" >Nombre platillo</label>
    </div>

    <!-- <div class="md-form mb-5">
            <input type="text"  class="form-control validate" value=10 name="codigo" hidden>
    </div> -->
    <div class="text-left">       
          <div class="md-form mb-5">
            <select class="browser-default custom-select" name="categoria" >
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
            <input type="text"  class="form-control validate" name="foto_receta" value="<?php echo !empty($foto_receta)?$foto_receta:''; ?>" >
            <label data-error="wrong" data-success="right">Foto platillo</label>
    </div>
   
    <hr class="my-2">


   
        
    <div class="md-form mb-4 pink-textarea active-pink-textarea-2">
        <i class="fas fa-angle-double-right prefix"></i>
        <textarea  class="md-textarea form-control" rows="7" name="presentacion" value="<?php echo !empty($presentacion)?$presentacion:''; ?>"></textarea>
        <label for="form23">Presentación</label>
    </div>

    <hr class="my-2">
    <div class="md-form mb-4 pink-textarea active-pink-textarea-2">
        <i class="fas fa-angle-double-right prefix"></i>
        <textarea  class="md-textarea form-control" rows="7" name="mise_en_place" value="<?php echo !empty($mise_en_place)?$mise_en_place:''; ?>"></textarea>
        <label for="form23">Mise en place</label>
    </div>


    <hr class="my-2">
    <div class="md-form mb-4 pink-textarea active-pink-textarea-2">
        <i class="fas fa-angle-double-right prefix"></i>
        <textarea id="form23" class="md-textarea form-control" rows="7" name="preparacion" value="<?php echo !empty($preparacion)?$preparacion:''; ?>"></textarea>
        <label for="form23">Preparación</label>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <button type="submit"  class="btn btn-default ">Actualizar</button>
    </div>

</form>

    
</div>
</div>

</div>

    
 
    

