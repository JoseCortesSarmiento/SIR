<?php 
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);

if($_SESSION['usuario']['rol']!=1){
        
        header("location:home.php");
}
$id_session = $_SESSION['usuario']['id_usuario'];
	if ( !empty($_POST)) {
		
		// keep track post values		
		$correo = $_POST['correo'];
		$contra = $_POST['contra'];
		$nombre = $_POST['nombre'];
        $estatus = $_POST['estatus'];
        $rol = $_POST['rol'];
        $nacimiento = $_POST['nacimiento'];
        
        $sql = "INSERT INTO usuarios ( correo, contra, nombre, estatus, rol, nacimiento) values(?, crypt(?, gen_salt('md5')), ?, ?, ?, ?) RETURNING id_usuario;";
			$stmt = $conn->prepare($sql);
            $stmt->execute([$correo, $contra, $nombre, $estatus, $rol, $nacimiento]);
        print_r($nacimiento);   
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_usuario = $resultado['id_usuario'];
        

        $sql = "INSERT INTO historial (id_usuario, descripcion.primer_texto, descripcion.numero_usuario, descripcion.segundo_texto, descripcion.tercer_texto, fecha)
        VALUES (?, 'El usuario ' , ? , ' ha agregado un  nuevo usuario','', CURRENT_TIMESTAMP);";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_usuario, $id_session]);    
                
            echo '<script type="text/javascript">'; 
            echo 'setTimeout(function () { swal("¡ÉXITO!","Se ha agregado un nuevo usuario","success");'; 
            echo '}, 500);</script>'; 
	}
?>


<div class="modal fade" id="modalAddUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                        <div class="modal-header text-center">
                                            <h4 class="modal-title w-100 font-weight-bold">Agregar usuario</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                                <div class="modal-body mx-3">

                                                    <form action="usuarios.php" method="post">

                                                        <div class="md-form mb-5">
                                                            <input type="email" id="defaultForm-email" class="form-control validate" name="correo" >
                                                            <label data-error="wrong" data-success="right" for="defaultForm-email">Correo</label>
                                                        </div>

                                                        <div class="md-form mb-5">
                                                            <input type="password" id="defaultForm-password" class="form-control validate" name="contra" >
                                                            <label data-error="wrong" data-success="right" for="defaultForm-email">Contraseña</label>
                                                        </div>

                                                        <div class="md-form mb-5">
                                                            <input type="text" id="defaultForm-email" class="form-control validate" name="nombre" >
                                                            <label data-error="wrong" data-success="right" for="defaultForm-email">Nombre</label>
                                                        </div>

                                                        <div class="md-form mb-5">
                                                            <input type="text" id="defaultForm-email" class="form-control validate" name="nacimiento" >
                                                            <label data-error="wrong" data-success="right" for="defaultForm-email">Fecha de nacimiento (yyyy-mm-dd)</label>
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
                                                </div>

                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="submit"  class="btn btn-default">Agregar</button>
                                                        </div>

                                                    </form>
                            </div>
            </div>
</div>