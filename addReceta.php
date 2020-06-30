<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}

// $miCodigo;



function getCodigo(){

    $host= "localhost";
    $dbname= "sistemarest";
    $username="root";
    $password="";
   
 
 
     try{
         $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 
         $obtenerCodigo= "CALL obtenerCodigoReceta2(@codigo)";
         $codigo= $pdo->prepare($obtenerCodigo);
         $codigo->execute();
         $codigo->closeCursor();
         
         
         $row2 = $pdo->query("SELECT @codigo AS codigo")->fetch(PDO::FETCH_ASSOC);
                 if ($row2) {
                     return $row2 !== false ? $row2['codigo'] : null;
                 }
                
         
         echo $row2['codigo'];
     }
         catch (PDOException $e) {
             die("Error occurred:" . $e->getMessage());
         }
         return null;
     
         
 }

 $miCodigo=getCodigo();
 echo "Mi codigo es".$miCodigo;


if ( !empty($_POST)) {
    	
    $nombre = $_POST['nombre'];
    $foto_receta=$_POST['foto_receta'];
    $categoria = $_POST['categoria'];
    $presentacion=$_POST['presentacion'];
    $mise_en_place=$_POST['mise_en_place'];
    $preparacion=$_POST['preparacion'];
    $rendimiento=$_POST['rendimiento'];
    $codigo= $_POST['codigo'];

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
        //header('location: articuloReceta.php');
        echo '<script>location.replace("articuloReceta.php")</script>';
        

    }

    catch(Exception $e){ 
        $pdo->rollback(); 
        throw $e;  
    } 


   
   
}






?>

<div class="view full-page-intro" style="background-image: url('https://www.losdanzantes.com/assets/img/oaxaca/los-danzantes-oaxaca.jpg'); background-repeat: no-repeat; background-size: cover;">



<div class="container"  style="margin-top:10vh; margin-bottom:10vh;">
<div class="jumbotron">
<h2 class="h1-responsive text-center" >Agregar nueva receta</h2>
    <br>
    <form action="addReceta.php" method="post">
    <div class="md-form mb-5">
        <input type="text"  class="form-control validate" name="nombre" >
        <label data-error="wrong" data-success="right" >Nombre platillo</label>
    </div>

    <div class="md-form mb-5">
            <input type="text"  class="form-control validate" value="<?php echo  $miCodigo=getCodigo();?>" name="codigo" hidden>
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
   
    <!-- <hr class="my-2"> -->


   
        
    <div class="md-form mb-4 pink-textarea active-pink-textarea-2">
        <i class="fas fa-angle-double-right prefix"></i>
        <textarea  class="md-textarea form-control" rows="7" name="presentacion"></textarea>
        <label for="form23">Presentación</label>
    </div>

    <!-- <hr class="my-2"> -->
    <div class="md-form mb-4 pink-textarea active-pink-textarea-2">
        <i class="fas fa-angle-double-right prefix"></i>
        <textarea  class="md-textarea form-control" rows="7" name="mise_en_place"></textarea>
        <label for="form23">Mise en place</label>
    </div>


    <!-- <hr class="my-2"> -->
    <div class="md-form mb-4 pink-textarea active-pink-textarea-2">
        <i class="fas fa-angle-double-right prefix"></i>
        <textarea id="form23" class="md-textarea form-control" rows="7" name="preparacion"></textarea>
        <label for="form23">Preparación</label>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <button type="submit"  class="btn btn-default ">Agregar</button>
    </div>

    

</form>

    
</div>
</div>





</div>

    
 
    

