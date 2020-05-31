<?php
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';


if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}

include 'global/header.php';
include 'addProveedor.php';
?>

<?php
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);

$sentencia = $pdo->prepare('SELECT * FROM proveedores');
$sentencia->execute();
$proveedores = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<br />
<br />  
	<div class="container">  
		<h3 align="center">Proveedores</h3>  
		<br />  
		<div class="table-responsive">  

<table id="proveedores" class="display" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <?php foreach ($proveedores as $proveedor): ?>
        <tr>
            <td> <?=$proveedor['nombre']?></td>
            <td> <?=$proveedor['correo']?></td>
            <td> <?=$proveedor['telefono']?></td>
            <td> <?=$proveedor['direccion']?></td>
            <td>

            <span style="font-size: 32px; color: darkturquoise;">
                <a href="updateProveedores.php?id_proveedor=
                <?=$proveedor['id_proveedor']?>"
                class="btn btn-default btn-rounded mb-4"  > 
                <i class="fas fa-edit"></i></a>
            </span>

            <span style="font-size: 32px; color: tomato;">
                <a href="deleteProveedor.php?id_proveedor=<?=$proveedor['id_proveedor']?>" 
                class="btn btn-red btn-rounded mb-4" > 
                <i class="fas fa-trash-alt"></i></a>
            </span>  
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" 
  data-target="#modalAddProveedor">Agregar proveedor</a>
</div>
<div class="text-center">
  <a class="btn btn-default btn-rounded mb-4" href="backupProveedores.php">Backup</a>
</div>
</div>  
	</div> 
<script>  
	$(document).ready(function(){  
		$('#proveedores').DataTable();  
	}); 
</script>  


