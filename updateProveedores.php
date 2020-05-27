<?php  
include 'global/config.php';
include 'global/conexion.php';
include 'global/header.php';


$id_proveedor=0;

if (isset($_GET["id_proveedor"])) { 
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
    $nombre = $_POST['nombre']; 
    $descripcion = $_POST['correo']; 
    $cantidad = $_POST['telefono']; 
    $precio = $_POST['direccion']; 

  
 
 
 
     
   
        
        try{ 
            $pdo->beginTransaction(); 
            $sql2 = "UPDATE proveedores set  nombre = :nombre, correo=:correo, direccion=:direccion, telefono=:telefono  WHERE id_proveedor = :id_proveedor"; 
            $stmt = $pdo->prepare($sql2); 
            $stmt->execute(['nombre'=>$nombre, 'correo'=>$correo, 'direccion'=>$direccion,'telefono'=>$telefono, 'id_proveedor'=>$id_proveedor]); 
            // $stmt->debugDumpParams(); 
            // echo '<script type="text/javascript">'; 
            // echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha actualizado el producto","success");'; 
            // echo '}, 500);</script>'; 
            $pdo->commit(); 
        } 
        catch(Exception $e){ 
            $pdo->rollback(); 
            // $stmt->debugDumpParams(); 
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ERROR!","El proveedor no pudo ser actualizado","error");'; 
            echo '}, 500);</script>'; 
            throw $e;  
 
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
 
