<?php 
include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
include 'global/sesion.php';



     if (isset($_GET["id_receta"])) {
        try {
      
          $id = $_GET["id_receta"];
          echo $id;
      
          $sql = "DELETE FROM recetas WHERE id_receta= :id";
      
          $statement = $pdo->prepare($sql);
          $statement->bindValue(':id', $id);
          $statement->execute();
      
         	echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha borrado la receta","success");'; 
            echo '}, 500);</script>'; 
            echo "hola";
           
        } 
        catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      }
      
      
	   header('location: recetas.php');
?>
