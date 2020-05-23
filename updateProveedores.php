<?php  
if (!empty($_GET['id_proveedor'])) { 
   
    $id_proveedor = $_REQUEST['id_proveedor']; 
    echo $id_proveedor;
} 
 
if (!empty($_POST)) { 
    // keep track validation errors 
    $idError=null; 
    $nombreError = null; 
    $correoError = null; 
    $telefonoError = null; 
    $direccionError = null; 
    $transactionError =false; 
 
     
     
    // keep track post values 
    $id_producto=$_POST['id_proveedor']; 
    $nombre = $_POST['nombre']; 
    $descripcion = $_POST['correo']; 
    $cantidad = $_POST['telefono']; 
    $precio = $_POST['direccion']; 

    /// validate input 
    $valid = true; 
 
    if (empty($id_producto)) { 
        $idError = 'Porfavor ingresa un id de producto'; 
        $valid = false; 
    } 
     
    if (empty($nombre)) { 
        $nombreError = 'Porfavor ingresa un nombre de proveedor'; 
        $valid = false; 
    } 
 
    if (empty($correo)) { 
        $correoError = 'Porfavor ingresa un correo'; 
        $valid = false; 
    }		 
     
    if (empty($telefono)) { 
        $telefonoError = 'Porfavor ingresa un telefono'; 
        $valid = false; 
    }	 
     
    if (empty($direccion)) { 
        $direccionError = 'Porfavor ingresa una direccion'; 
        $valid = false; 
    }	 
 
 
 
     
    // update data 
    if ($valid) { 
        
        try{ 
            $pdo->beginTransaction(); 
            $sql2 = "UPDATE proveedores set  nombre = :nombre, correo=:correo, telefono=:telefono, descripcion=:descripcion  WHERE id_proveedor = :id_proveedor"; 
            $stmt = $pdo->prepare($sql2); 
            $stmt->execute(['nombre'=>$nombre, 'correo'=>$correo, 'direccion'=>$direccion,'telefono'=>$telefono, 'id_proveedor'=>$id_proveedor]); 
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
        //header('location: index.php?page=stock'); 
    } 
}  
 
else { 
     
    $sql = "SELECT * FROM proveedores where id_proveedor = ?"; 
    $q = $pdo->prepare($sql); 
    $q->execute(array($id_proveedor)); 
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $id_proveedor = $data['id_proveedor']; 
    $nombre = $data['nombre']; 
    $correo = $data['correo']; 
    $telefono = $data['telefono'];  
    $direccion = $data['direccion'];    
} 
 
 
?> 
 
 <div class="modal fade" id="modalEditProveedores" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Editar proveedor</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
       

        <div class="md-form mb-5">
          <input type="text" id="defaultForm-email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Nombre</label>
        </div>

        <div class="md-form mb-5">
          <input type="email" id="defaultForm-email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Correo</label>
        </div>

        <div class="md-form mb-5">
          <input type="text" id="defaultForm-email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Teléfono</label>
        </div>


        <div class="md-form mb-5">
          <input type="text" id="defaultForm-email" class="form-control validate">
          <label data-error="wrong" data-success="right" for="defaultForm-email">Dirección</label>
        </div>


      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-default">Editar</button>
      </div>
    </div>
  </div>
</div>