<?php
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';

if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}

?>



<?php
    $sentencia = $pdo->prepare('SELECT * FROM recetas');
    $sentencia->execute();
    $recetas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    echo "hola";
    $arr = $sentencia->errorInfo();
    print_r($arr);
?>

<div class="view full-page-intro" style="background-image: url('https://www.losdanzantes.com/assets/img/oaxaca/los-danzantes-oaxaca.jpg'); background-repeat: no-repeat; background-size: cover;">

    
    
    <div class="container" style="margin-top:10vh;margin-bottom:50vh; ">  
<div class="card">


<div class="card-body">



<h3 align="center">Recetas</h3>  
		<br />  
		<div class="table-responsive">  

<table id="recetas" class="display" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Importe total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <?php foreach ($recetas as $receta): ?>
        <tr>
            <td> <?=$receta['codigo']?></td>
            <td> <?=$receta['nombre_platillo']?></td>
            <td> <?=$receta['categoria']?></td>
            <td>$ <?=$receta['importe_total']?></td>
            <td>

            <span style="font-size: 32px; color: darkturquoise;">
                <a href="updateReceta.php?id_receta=
                <?=$receta['id_receta']?>"
                class="btn btn-default btn-rounded mb-4"  > 
                <i class="fas fa-edit"></i></a>
            </span>

            <span style="font-size: 32px; color: tomato;">
                <a href="deleteReceta.php?id_receta=<?=$receta['id_receta']?>" 
                class="btn btn-red btn-rounded mb-4" > 
                <i class="fas fa-trash-alt"></i></a>
            </span>  

            <span style="font-size: 32px; color: tomato;">
                <a href="detalleReceta.php?id_receta=<?=$receta['id_receta']?>" 
                class="btn btn-secondary-color btn-rounded mb-4" > 
                <i class="fas fa-eye"></i></a>
            </span> 
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="text-center">
  <a href="addReceta.php" class="btn btn-default btn-rounded mb-4" >Agregar receta</a>
</div>
</div>  


</div>



</div>
	</div> 
    
    
    
    </div>
<script>  
	$(document).ready(function(){  
		$('#recetas').DataTable();  
	}); 
</script>  


