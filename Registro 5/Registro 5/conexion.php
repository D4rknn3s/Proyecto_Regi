<?php
$server ="localhost";
$user = "root";
$password = "";
$dbname = "bd_regi";

$conexion = new mysqli($server, $user, $password, $dbname);  

if ($conexion->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}


?>