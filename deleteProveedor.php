<?php 

include 'global/config.php';
include 'global/conexion.php';

if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}

include 'global/header.php';




     if (isset($_GET["id_proveedor"])) {
        try {
      
          $id = $_GET["id_proveedor"];
      
          $sql = "DELETE FROM proveedores WHERE id_proveedor = :id";
            echo $sql;
          $statement = $pdo->prepare($sql);
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
      
      header('location: proveedores.php');

?>




