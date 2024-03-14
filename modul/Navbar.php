<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/stilo.css">
    <title>Regi</title>
</head>

<body>
<header>
<img src="../assets/images/r02.png" alt=""  width="80px" height="80px"            >
</header>


<nav class="navbar navbar-expand-lg ">
  <!-- Logo -->
 <!---- <a class="navbar-brand" href="#">
    <img src="./assets/images/r2.png" alt="Logo" height="60">
  </a> -->

  <!-- Botón de hamburguesa para dispositivos móviles -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Contenedor de los elementos del navbar -->
  <div class="collapse navbar-collapse" id="navbarNav">
    <!-- Dropdowns a la izquierda -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link  bi bi-house" href="inicio.html" target="interfaces"> Inicio </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bi bi-cash" href="#" id="dropdownLeft1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Servicios
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownLeft1">
          <a class="dropdown-item" href="../vistas/index.php" target="interfaces">Agregar Servicios</a>
          <a class="dropdown-item" href="../vistas/apagar.php" target="interfaces">Agregar pagos</a>
          <a class="dropdown-item" href="../vistas/historial_servicios.php" target="interfaces">Historial de Servicios</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bi bi-clipboard2-data" href="#" id="dropdownLeft2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Estadisticas
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownLeft2">
          <a class="dropdown-item" href="../vistas/Historial_pagos.php" target="interfaces">Historial de pago</a>
          <a class="dropdown-item" href="../vistas/deudores.php" target="interfaces">Deudores</a>
          <a class="dropdown-item" href="../vistas/graficos.php" target="interfaces">Graficos</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bi bi-sliders" href="#" id="dropdownLeft3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Seguridad
        </a>
        <div class="dropdown-menu" aria-labelledby="dropdownLeft3">
          <a class="dropdown-item" href="../vistas/usuarios.php" target="interfaces">Usuarios</a>
          <a class="dropdown-item" href="../vistas/Roles.php" target="interfaces">Roles</a>
          <a class="dropdown-item" href="#">Permisos</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link bi bi-calendar-event" href="#"> Calendario </a>
      </li>
    </ul>

    <!-- Enlaces y dropdown a la derecha -->
    <ul class="navbar-nav ml-auto"  style="padding: 8px; margin: 4px;">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle bi bi-person-circle" href="#" id="dropdownRight" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Mi perfil </a>
        <div class="dropdown-menu" aria-labelledby="dropdownRight">
          <a class="dropdown-item" href="#">Mi perfil</a>
          <a class="dropdown-item" href="#">Notificaciones</a>
          <a class="dropdown-item" href="#">Salir</a>
        </div>
      </li>
    </ul>
  </div>
</nav>


<main>

<iframe name="interfaces" src="" framebororder =  ""></iframe>

</main>

<!-- Agregar los scripts de Bootstrap (jQuery y Popper.js) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>