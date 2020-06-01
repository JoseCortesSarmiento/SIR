<?php 

include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';

if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}else{
 if (isset($_GET["id_receta_articulo"])) {
        try {
      
          $id = $_GET["id_receta_articulo"];
      
          $sql = "DELETE FROM recetas_articulos WHERE id_receta_articulo= :id";
      
          $statement = $pdo->prepare($sql);
          $statement->bindValue(':id', $id);
          $statement->execute();
      
         	echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha borrado el articulo","success");'; 
            echo '}, 500);</script>'; 

           
        } 
        catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      }
      
      
	   header('location: updateRecetaArticulo.php');

}

include 'global/header.php';



    
?>
