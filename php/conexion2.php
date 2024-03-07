
<?php
  $host = 'localhost';
  $dbname = 'bd_regi';
  $username = 'root';
  $password = '';
  
  try {
      $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      // Establecer el modo de error PDO a excepción
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
  }
  ?>
