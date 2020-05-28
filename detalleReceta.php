<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';
include 'global/header.php';







if (!empty($_GET['id_receta'])) { 
    $id_receta = $_REQUEST['id_receta']; 
    //  echo $id_proveedor;
} 



$sql = "SELECT * FROM recetas where  id_receta = ?";
$q=$pdo->prepare($sql);
$q->execute(array($id_receta));
$receta = $q->fetch(PDO::FETCH_ASSOC); 


?>

<div class="container">

    
<div class="jumbotron">
    <h2 class="h1-responsive"><?=$receta['nombre_platillo']?></h2>
    <div class="text-left">
          <i class="far fa-file-alt fa-4x mb-3 animated rotateIn"></i>
          <p>
            <strong>Código:</strong> <?=$receta['codigo']?>
          </p>

          <p>
            <strong>Categoria:</strong> <?=$receta['categoria']?>
          </p>


          <p>
            <strong>Rendimiento:</strong> <?=$receta['rendimiento']?>
          </p>
          
    </div>
    <hr class="my-2">
    <p>
        <strong>Presentación:</strong>
    </p>
    <p class="lead">  <?=$receta['presentacion']?></p>

    <hr class="my-2">
    <p>
        <strong>Mise en place:</strong>
    </p>
    <p class="lead">  <?=$receta['mise_en_place']?></p>
    <hr class="my-2">

    <p>
        <strong>Preparación:</strong>
    </p>
    <p class="lead">  <?=$receta['preparacion']?></p>
   
    <a class="btn btn-primary btn-lg" role="button" href="recetas.php">Ver todas</a>
</div>
</div>