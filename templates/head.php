<?php 
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);
session_start();

if(!isset($_SESSION['usuario'])){
    echo "redirigir al login .... no hay usuario";
    header('Location: index.php');
}{
    print_r($_SESSION['usuario']);
}
include 'global/header.php';
?>
<!--Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar" style="background-color: #1C2331;">
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="home.php">Home
          <span class="sr-only">(current)</span>
        </a>
      </li> -->

    <?php if($_SESSION['usuario']['rol'] == 1 ) {?>
       <li class="nav-item">
        <a class="nav-link" href="usuarios.php">Usuarios</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="proveedores.php">Proveedores</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="articulos.php">Articulos</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="recetas.php">Recetas</a>
      </li>

     <li class="nav-item">
     <a class="nav-link" href="historial.php">Historial</a>
     </li>

     <li class="nav-item">
     <a class="nav-link" href="lista_articulos.php">Lista de Compras</a>
     </li>
      
    <?php } ?>

      <li class="nav-item">
        <a class="nav-link" href="recetasCocinero.php">Recetas Cocinero</a>
      </li>

    </ul>

    <ul class="navbar-nav ml-auto nav-flex-icons">
        <li class="nav-item">
            <a class="nav-link" href="backup_precios.php">Backup Precios</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="logout.php">Salir</a>
        </li>
    </ul>

  </div>
</nav>
<!--/.Navbar -->



