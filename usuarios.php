<?php 
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);

include 'global/config.php';
include 'global/conexion.php';
include 'global/header.php';
include 'addUsuario.php';


     if (isset($_GET["id_usuario"])) {
        try {
      
          $id = $_GET["id_usuario"];
      
          $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
      
          $statement = $conn->prepare($sql);
          $statement->bindValue(':id', $id);
          $statement->execute();
      
          echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha borrado el usuario","success");'; 
            echo '}, 500);</script>'; 

           
        } 
        catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      }
      
      

?>

<?php
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);

$sentencia = $conn->prepare('SELECT * FROM usuarios');
$sentencia->execute();
$usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<br />
<br />  
	<div class="container">  
		<h3 align="center">Usuarios</h3>  
		<br />  
		<div class="table-responsive">  

<table id="usuarios" class="display" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Contrseña</th>
            <th>Nombre</th>
            <th>Estatus</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <?php foreach ($usuarios as $usuario): ?>
        <tr>
            <td> <?=$usuario['correo']?></td>
            <td> <?=$usuario['contra']?></td>
            <td> <?=$usuario['nombre']?></td>
            <td> <?php 				
                if ($usuario['estatus']==0) 
                    echo "Inactivo"; 
                else 
                    echo "Activo"; 
            ?></td>
            <td> <?php 				
                if ($usuario['rol']==0) 
                    echo "Cocinero"; 
                else 
                    echo "Administrador"; 
            ?></td>
            <td>
            
            

            <span style="font-size: 32px; color: darkturquoise;">
                <a href="updateUsuarios.php?id_usuario=<?=$usuario['id_usuario']?>" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalEditUsuarios"> <i class="fas fa-edit"></i></a>
            </span>

            <span style="font-size: 32px; color: tomato;">
                <a href="deleteUsuario.php?id_usuario=<?=$usuario['id_usuario']?>" class="btn btn-red btn-rounded mb-4" > <i class="fas fa-trash-alt"></i></a>
            </span>  
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="text-center">
  <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#modalAddUsuario">Agregar usuario</a>
</div>
</div>  
	</div> 
<script>  
	$(document).ready(function(){  
		$('#usuarios').DataTable();  
	}); 
</script>  