<?php 

include 'global/config.php';
include 'global/conexion.php';
include 'templates/head.php';
if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}


if ( !empty($_POST)) {
  
		// keep track post values		
  
    $id_articulo  = $_POST['articulo'];
    $id_proveedor  = $_POST['proveedor'];
    $precio  = $_POST['precio'];

    $sql2 = "INSERT INTO articulos_proveedores (id_articulo, id_proveedor, precio) VALUES(?,?,?)";
    $stmt2 = $pdo->prepare($sql2);


    
    $stmt2->execute([$id_articulo, $id_proveedor, $precio]);
    echo '<script type="text/javascript">'; 
    echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha agregado un nuevo articulo","success");'; 
    echo '}, 500);</script>';
    
    header('location: articulos.php');
}

?>


<div class="view full-page-intro" style="background-image: url('https://www.losdanzantes.com/assets/img/oaxaca/los-danzantes-oaxaca.jpg'); background-repeat: no-repeat; background-size: cover;">

<div class="container"  style="margin-top:10vh; margin-bottom:10vh;">

<div class="card">
    <div class="card-body">
        <div class="md-form mb-5">

            <div class="text-center">
                <h4 class=" w-100 font-weight-bold">Agregar articulo ya existente</h4>
            </div>

            <form action="articuloExistente.php" method="post">

                <form action="articulos.php" method="post">

                    <div class="md-form mb-5">

                       <select class="browser-default custom-select" name="articulo">
                           <option selected>Elija un articulo</option>
                           <?php 
                           
                           $query = 'SELECT * FROM articulos'; 
                           foreach ($pdo->query($query) as $row) { 
                              
                            echo "<option selected value='" . $row['id_articulo'] . "'>" . $row['nombre'] . "</option>"; 
                            
                        } 
                        
                        ?> 
                    </select>
                    
                </div>

                <div class="md-form mb-5">
                  
                   <select class="browser-default custom-select" name="proveedor">
                       <option selected>Elija un proveedor</option>
                       <?php 
                       
                       $query = 'SELECT * FROM proveedores'; 
                       foreach ($pdo->query($query) as $row) { 
                          
                        echo "<option selected value='" . $row['id_proveedor'] . "'>" . $row['nombre'] . "</option>"; 
                        
                    } 
                    
                    ?> 
                </select>
                
            </div>

            <div class="md-form mb-5">
             <input type="text"  class="form-control validate" name="precio" >
             <label data-error="wrong" data-success="right" >Precio</label>
         </div>


         <div class="modal-footer d-flex justify-content-center">
           <button type="submit"  class="btn btn-default">Agregar</button>
       </div>
       
   </form>
</div>
</div>
</div>







</div>




</div>