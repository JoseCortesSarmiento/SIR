<br>
<br>
<br>
<br>
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

          $query = $pdo->prepare("SELECT * from recetas_articulos where id_receta_articulo=?");
          $query->execute([$id]);
          $recetas=$query->fetchAll(PDO::FETCH_ASSOC);
          // print_r prints arrays recursively
          // echo is meant for scalar or individual values
          print_r($recetas);
          // $id_receta=$receta[0]['id_receta'];
          foreach($recetas as $receta){
            $id_receta=$receta['id_receta'];
          }
          echo $id_receta;
      
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
      
      header('location: updateRecetaArticulo.php?id_receta='.$id_receta);
     

}

include 'global/header.php';



    
?>
