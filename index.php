<?php 
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);

include 'global/config.php';
include 'global/conexion.php';
include 'global/header.php';
?>

<?php
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);

//Control usuarios
if(isset($_POST["btnLogin"])){
    $txtEmail = ($_POST['txtEmail']);
    $txtPassword = ($_POST['txtPassword']);
}
$sentencia = $conn->prepare('SELECT * FROM usuarios WHERE correo = :correo AND contra = :contra'); //query

$sentencia->bindParam("correo", $txtEmail, PDO::PARAM_STR); //enviamos informacion a traves del correo y password
$sentencia->bindParam("contra", $txtPassword, PDO::PARAM_STR); //PDO::PARAM_STR enviamos informacion en formato string
$sentencia->execute();

$registro = $sentencia->fetch(PDO::FETCH_ASSOC); //Fetch Rcolecta toda la informacion de la query guardada en sentencia
                                //PDO::FETACH_ASSOC recolecta la informacion a la seleccion de usuarios especificada

print_r($registro);

$numeroRegistros = $sentencia->rowCount();

if($numeroRegistros>=1){
    session_start(); //
    $_SESSION['usuario']=$registro; //usuario, variable de sesion que guardara el contenido que obtuvimos de la BD

    echo "Bienvenido...";
    //redireccionamos a home
    header('Location: home.php');
}else{
    echo "No se encontraron registros...";
}


?>
<br />
<br />  
<br />
<br />  
<br />
<br />  
<br />
<br />  
<!-- Default form login -->
<form class="text-center border border-light p-5" action="index.php" method="post">

    <p class="h4 mb-4">Sign in</p>

    <!-- Email -->
    <input type="email" name="txtEmail" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail">

    <!-- Password -->
    <input type="password" name="txtPassword" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password">

    <!-- Sign in button -->
    <button class="btn btn-info btn-block my-4" type="submit" name="btnLogin">Sign in</button>

</form>
<!-- Default form login -->