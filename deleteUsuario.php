<?php 

include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';

if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}else{

     if (isset($_GET["id_usuario"])) {
        try {
          $id_session = $_SESSION['usuario']['id_usuario'];
          $id = $_GET["id_usuario"];
      
          $sql = "DELETE FROM usuarios WHERE id_usuario = :id";
            echo $sql;
          $statement = $conn->prepare($sql);
          $statement->bindValue(':id', $id);
          $statement->execute();
          
          $sql = "INSERT INTO historial (id_usuario, descripcion.primer_texto, descripcion.numero_usuario, descripcion.segundo_texto, descripcion.tercer_texto, fecha)
           VALUES (?, 'El usuario ' , ? , ' ha eliminado un usuario','', CURRENT_TIMESTAMP);";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id, $id_session]);



            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha borrado el usuario","success");'; 
            echo '}, 500);</script>'; 

           
        } 
        catch(PDOException $error) {
          echo $sql . "<br>" . $error->getMessage();
        }
      }
      
      header('location: usuarios.php');


}

include 'global/header.php';





?>