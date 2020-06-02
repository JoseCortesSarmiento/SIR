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
$sentencia = $conn->prepare('SELECT * FROM usuarios WHERE correo = :correo AND contra = crypt(:contra, contra)');

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
    header('Location: recetasCocinero.php');
}else{
    // echo "No se encontraron registros...";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Material Design Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.min.css" rel="stylesheet">
  <style type="text/css">
    html,
    body,
    header,
    .view {
      height: 100%;
    }

    @media (max-width: 740px) {
      html,
      body,
      header,
      .view {
        height: 1000px;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      html,
      body,
      header,
      .view {
        height: 650px;
      }
    }
    @media (min-width: 800px) and (max-width: 850px) {
              .navbar:not(.top-nav-collapse) {
                  background: #1C2331!important;
              }
          }
  </style>
</head>

<body>

  <!-- Navbar -->
 
  <!-- Navbar -->

  <!-- Full Page Intro -->
  <div class="view full-page-intro" style="background-image: url('https://www.losdanzantes.com/assets/img/oaxaca/los-danzantes-oaxaca.jpg'); background-repeat: no-repeat; background-size: cover;">

    <!-- Mask & flexbox options-->
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

      <!-- Content -->
      <div class="container" >

        <!--Grid row-->
        <div class="row wow fadeIn">

          <!--Grid column-->
          <div class="col-md-6 mb-4 white-text text-center text-md-left">

            <h1 class="display-4 font-weight-bold">Bienvenido al sistema de recetas</h1>

            <hr class="hr-light">

            <p>
              <strong>El mejor manejador de recetas en línea</strong>
            </p>

            <p class="mb-4 d-none d-md-block">
              <strong>En este sistema usted podrá administrar todos sus productos y las recetas de su resturante.</strong>
            </p>

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 col-xl-5 mb-4">

            <!--Card-->
            <div class="card">

              <!--Card content-->
              <div class="card-body">

                <!-- Form -->
                <form action="index.php" method="post">
                  <!-- Heading -->
                  <h3 class="dark-grey-text text-center">
                    <strong>Inicia sesión:</strong>
                  </h3>
                  <hr>


                  <div class="md-form">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="email" name="txtEmail" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="Correo">
                    <label for="form2">Correo</label>
                  </div>
                  <br>

                  <div class="md-form">
                    <i class="fas fa-key prefix grey-text"></i>
                    <input type="password" name="txtPassword" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Contraseña">
                    <label for="form3">Contraseña</label>
                  </div>
                 
                  <br>
                  <br>

                  <div class="text-center">
                    <button class="btn btn-indigo" type="submit"  name="btnLogin" >Enviar</button>
                    <hr>
                  </div>

                </form>
                <!-- Form -->

              </div>

            </div>
            <!--/.Card-->

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </div>
      <!-- Content -->

    </div>
    <!-- Mask & flexbox options-->

  </div>
  <!-- Full Page Intro -->


  <!--Main layout-->

  <!--Footer-->
  <footer class="page-footer text-center font-small mt-4 wow fadeIn" style='margin-top: 0;'>


    <hr class="my-4">

    <!-- Social icons -->
    <div class="pb-4">
      <a href="https://www.facebook.com/mdbootstrap" target="_blank">
        <i class="fab fa-facebook-f mr-3"></i>
      </a>

      <a href="https://twitter.com/MDBootstrap" target="_blank">
        <i class="fab fa-twitter mr-3"></i>
      </a>

      <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
        <i class="fab fa-youtube mr-3"></i>
      </a>

      <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
        <i class="fab fa-google-plus-g mr-3"></i>
      </a>

      <a href="https://dribbble.com/mdbootstrap" target="_blank">
        <i class="fab fa-dribbble mr-3"></i>
      </a>

      <a href="https://pinterest.com/mdbootstrap" target="_blank">
        <i class="fab fa-pinterest mr-3"></i>
      </a>

      <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
        <i class="fab fa-github mr-3"></i>
      </a>

      <a href="http://codepen.io/mdbootstrap/" target="_blank">
        <i class="fab fa-codepen mr-3"></i>
      </a>
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2020 Copyright:
      <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> LosChenchos.com </a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>
</body>

</html>

<!-- Default form login -->

<!-- Default form login -->
<!-- Default form login -->