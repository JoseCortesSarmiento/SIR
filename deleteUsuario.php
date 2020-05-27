<?php 

include 'global/config.php';
include 'global/conexion.php';
include 'global/header.php';



     if (isset($_GET["id_usuario"])) {
        try {
      
          $id = $_GET["id_usuario"];
      
          $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
            echo $sql;
          $statement = $conn->prepare($sql);
          $statement->bindValue(':id', $id);
          $statement->execute();
      
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha borrado el proveedor","success");'; 
            echo '}, 500);</script>'; 

           
        } 
        catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      }
      
      header('location: usuarios.php');

?>