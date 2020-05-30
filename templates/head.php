<?php 
//Mostrar errores en linux
ini_set("display_errors", "1");
error_reporting(E_ALL);
include 'global/header.php';
?>
<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark orange lighten-1">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-555"
    aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-555">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home
          <span class="sr-only">(current)</span>
        </a>
      </li>

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
        <a class="nav-link" href="recetasCocinero.php">Recetas Cocinero</a>
      </li>


     <li>
     <a class="nav-link" href="historial.php">Historial</a>
     </li>
    </ul>

    <ul class="navbar-nav ml-auto nav-flex-icons">
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Salir</a>
        </li>
    </ul>

  </div>
</nav>
<!--/.Navbar -->

