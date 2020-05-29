<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';
include 'global/header.php';


if ( !empty($_POST)) {
		
    // keep track post values		
    $nombre = $_POST['nombre_platillo'];
    $categoria = $_POST['categoria'];
    $rendimiento=$_POST['rendimiento'];
    $mise_en_place=$_POST['mise_en_place'];
    $preparacion=$_POST['preparacion'];
    
    $sql = "INSERT INTO usuarios ( correo, contra, nombre, estatus, rol) values(?, crypt(?, gen_salt('md5')), ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$correo, $contra, $nombre, $estatus, $rol]);	
        
        echo '<script type="text/javascript">'; 
        echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha agregado un nuevo usuario","success");'; 
        echo '}, 500);</script>'; 
}
?>


?>

<div class="container">

    
<div class="jumbotron">
    <form action="">
    <div class="md-form mb-5">
        <input type="text" id="defaultForm-email" class="form-control validate" name="nombre" >
        <label data-error="wrong" data-success="right" >Nombre platillo</label>
    </div>
    <br>
    <br>
    <div class="row">
    <div class="col-sm">
        <img src="<?= $receta['foto_empresa']?>" class="img-fluid" alt="Responsive image">
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

          <div class="md-form mb-5">
             <input type="text" id="defaultForm-email" class="form-control validate" name="categoria" >
             <label data-error="wrong" data-success="right" >Categoria</label>
          </div>


          <p>
            <strong>Rendimiento:</strong> <?=$receta['rendimiento']?>
          </p>
          
    </div>
    <hr>
    <div class="row">
    <div class="col-4"></div>
        <div class="col-4 ">
            <img src="<?=$receta['foto_logo']?>" class="img-fluid" alt="Responsive image">
        </div>
    <div class="col-4"></div>
    </div>
    <hr class="my-2">


    <div class="table-responsive">  
			<table id="articulos" class="table table-striped table-bordered">  
				<thead>  
					<tr>  
						<th>Nombre</th>
						<!-- <th>Precio</th> -->
						<th>Unidad medida</th>
					</tr>  
				</thead>  
				<?php foreach ($articulos as $articulo): ?>
					
					<tr>
						<td> <?=$articulo['nombre']?></td>
						<!-- <td> <?=$articulo['precio']?></td> -->
						<td> <?=$articulo['unidad_medida']?></td>
					</tr>

				<?php endforeach; ?>
			</table>  
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
</div>
</div>
    
    </form>
    

<script>  
	$(document).ready(function(){  
		$('#articulos').DataTable();  
	}); 
</script> 