<?php  
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);

include 'global/config.php';
include 'global/conexion.php';
include 'global/header.php';



if (!empty($_GET['id_usuario'])) { 
    $id_usuario = $_REQUEST['id_usuario']; 
} 
 
if (!empty($_POST)) { 
    // keep track validation errors 
    
    $correo = $_POST['correo']; 
    $contra = $_POST['contra']; 
    $nombre = $_POST['nombre']; 
    $estatus = $_POST['estatus']; 
    $rol = $_POST['rol']; 
    $id_usuario = $_POST['id_usuario']; 
    

    
 
 
     
    // update data 
   
        
        try{ 
            $conn->beginTransaction(); 

            $sql2 = 'UPDATE usuarios '
                . 'SET correo = :correo, '
                . 'contra = :contra, '
                . 'nombre = :nombre, '
                . 'estatus = :estatus, '
                . 'rol = :rol '
                . 'WHERE id_usuario = :id_usuario';

            $stmt = $conn->prepare($sql2); 
            $stmt->execute(['correo'=>$correo, 'contra'=>$contra, 'nombre'=>$nombre,'estatus'=>$estatus, 'rol'=>$rol,'id_usuario'=>$id_usuario]); 
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha actualizado el usuario","success");'; 
            echo '}, 500);</script>'; 
            $conn->commit(); 
        } 
        catch(Exception $e){ 
            $conn->rollback(); 
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ERROR!","El usuario no pudo ser actualizado","error");'; 
            echo '}, 500);</script>'; 
            throw $e;  
 
        } 
        // it takes me to the stock page, once I updated a product 
         header('location: usuarios.php');
    
}  
 
else { 
     
    $sql = "SELECT * FROM usuarios where id_usuario = ?"; 
    $q = $conn->prepare($sql); 
    $q->execute(array($id_usuario)); 
    $data = $q->fetch(PDO::FETCH_ASSOC); 
    $id_usuario = $data['id_usuario'];
    $correo = $data['correo']; 
    $contra = $data['contra']; 
    $nombre = $data['nombre']; 
    $estatus = $data['estatus']; 
    $rol = $data['rol'];    
} 
 
 
?> 
 

        

 <div class="card" style="width: 50rem;">
        <div class="card-body">
            <div class="md-form mb-5">

            <div class="text-center">
                <h4 class=" w-100 font-weight-bold">Editar usuario</h4>
            </div>

                <form action="updateUsuarios.php" method="post">
                    <div class="md-form mb-5">
                    <input type="email"  class="form-control validate" name="correo" value="<?php echo !empty($correo)?$correo:''; ?>">
                    <label data-error="wrong" data-success="right" >Correo</label>
                    </div>

                    <div class="md-form mb-5">
                    <input type="password"  class="form-control validate" name="contra" value="<?php echo !empty($contra)?$contra:''; ?>">
                    <label data-error="wrong" data-success="right" >Contraseña</label>
                    </div>


                    <div class="md-form mb-5">
                    <input type="text"  class="form-control validate" name="nombre" value="<?php echo !empty($nombre)?$nombre:''; ?>">
                    <label data-error="wrong" data-success="right">Nombre</label>
                    </div>

                    <div class="md-form mb-5">
                        <select class="browser-default custom-select" name="estatus">
                            <option selected value = "1">Activo</option>
                        </select>
                    </div>

                    <div class="md-form mb-5">
                        <select class="browser-default custom-select" name="rol">
                            <option selected value="0">Cocinero</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>

                    <div class="md-form mb-5">
                    <input type="hidden"  class="form-control validate" name="id_usuario" value="<?php echo !empty($id_usuario)?$id_usuario:''; ?>" >
                
                    </div>

                
                <div class=" d-flex justify-content-center">
                    <button type="submit" class="btn btn-default">Editar</button>
                </div>

                </form>
            </div>
        </div>
 </div>

     
    
