<?php  

include 'global/config.php';
include 'global/conexion.php';
include 'global/header.php';



if (!empty($_GET['id_proveedor'])) { 
    $id_proveedor = $_REQUEST['id_proveedor']; 
     echo $id_proveedor;
} 
 
if (!empty($_POST)) { 
    // keep track validation errors 
   
    $nombre = $_POST['nombre']; 
    $correo= $_POST['correo']; 
    $telefono= $_POST['telefono']; 
    $direccion = $_POST['direccion']; 
    $id_proveedor = $_POST['id_proveedor']; 
    

    
 
 
     
    // update data 
   
        
        try{ 
            $pdo->beginTransaction(); 
            $sql2 = "UPDATE proveedores set  nombre = :nombre, correo=:correo, telefono=:telefono, direccion=:direccion  
            WHERE id_proveedor = :id_proveedor"; 
            
            $stmt = $pdo->prepare($sql2); 
            $stmt->execute(['nombre'=>$nombre, 'correo'=>$correo, 'direccion'=>$direccion,'telefono'=>$telefono, 'id_proveedor'=>$id_proveedor ]); 
            // $stmt->debugDumpParams(); 
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha actualizado el producto","success");'; 
            echo '}, 500);</script>'; 
            $pdo->commit(); 
        } 
        catch(Exception $e){ 
            $pdo->rollback(); 
            // $stmt->debugDumpParams(); 
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ERROR!","El producto no pudo ser actualizado","error");'; 
            echo '}, 500);</script>'; 
            throw $e;  
 
        } 
        // it takes me to the stock page, once I updated a product 
         header('location: proveedores.php');
    
}  
 
else { 
     
    $sql = "SELECT * FROM proveedores where id_proveedor = ?"; 
    $q = $pdo->prepare($sql); 
    $q->execute(array($id_proveedor)); 
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $id_proveedor=$data['id_proveedor'];
    $nombre = $data['nombre']; 
    $correo = $data['correo']; 
    $telefono = $data['telefono'];  
    $direccion = $data['direccion'];    
} 
 
 
?> 
 

        

 <div class="card" style="width: 50rem;">
        <div class="card-body">
            <div class="md-form mb-5">

            <div class="text-center">
                <h4 class=" w-100 font-weight-bold">Editar proveedor</h4>
            </div>

                <form action="updateProveedores.php" method="post">
                <div class="md-form mb-5">
                <input type="text"  class="form-control validate" name="nombre" value="<?php echo !empty($nombre)?$nombre:''; ?>">
                <label data-error="wrong" data-success="right">Nombre</label>
                </div>

                <div class="md-form mb-5">
                <input type="email"  class="form-control validate" name="correo" value="<?php echo !empty($correo)?$correo:''; ?>">
                <label data-error="wrong" data-success="right" >Correo</label>
                </div>

                <div class="md-form mb-5">
                <input type="text" class="form-control validate" name="telefono" value="<?php echo !empty($telefono)?$telefono:''; ?>">
                <label data-error="wrong" data-success="right" >Correo</label>
                </div>

                <div class="md-form mb-5">
                <input type="text"  class="form-control validate" name="direccion" value="<?php echo !empty($direccion)?$direccion:''; ?>" >
                <label data-error="wrong" data-success="right" >Dirección</label>
                </div>

                <div class="md-form mb-5">
                <input type="hidden"  class="form-control validate" name="id_proveedor" value="<?php echo !empty($id_proveedor)?$id_proveedor:''; ?>" >
               
                </div>

                
                <div class=" d-flex justify-content-center">
                    <button type="submit" class="btn btn-default">Editar</button>
                </div>
                </form>
            </div>
        </div>
 </div>

     
    
