<?php 

include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';

if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}else{
 if (isset($_GET["id_articulos_proveedores"])) {
        try {
      
          $id = $_GET["id_articulos_proveedores"];
      
          $sql = "DELETE FROM articulos_proveedores WHERE id_articulos_proveedores= :id";
      
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
      
      
	   header('location: articulos.php');

}

include 'global/header.php';



    
?>
