<?php 
   include "proveedores.php";
   
     if (isset($_GET["id_proveedor"])) {
        try {
      
          $id = $_GET["id_proveedor"];
      
          $sql = "DELETE FROM proveedores WHERE id_proveedor = :id";
      
          $statement = $pdo->prepare($sql);
          $statement->bindValue(':id', $id);
          $statement->execute();
      
          $success = "User successfully deleted";
        } catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      }
      


?>



