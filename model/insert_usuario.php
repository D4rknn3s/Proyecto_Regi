<?php
// Incluir el archivo de conexión a la base de datos
include "../php/conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $nombre_usuario = mysqli_real_escape_string($conexion, $_POST["nombre_usuario"]);
    $apellido_usuario = mysqli_real_escape_string($conexion, $_POST["apellido_usuario"]);
    $identidad_usuario = mysqli_real_escape_string($conexion, $_POST["identidad_usuario"]);
    $direccion_usuario = mysqli_real_escape_string($conexion, $_POST["direccion_usuario"]);
    $tele_usuario = mysqli_real_escape_string($conexion, $_POST["tele_usuario"]);
    $correo_usuario = mysqli_real_escape_string($conexion, $_POST["correo_usuario"]);
    $apodo_usuario = mysqli_real_escape_string($conexion, $_POST["apodo_usuario"]);
    $contra_usuario = mysqli_real_escape_string($conexion, $_POST["contra_usuario"]);

    // Prepara la consulta SQL para insertar un nuevo usuario
    $sql = "INSERT INTO usuarios (nombre_usuario, contra_usuario, correo_usuario, tele_usuario, direccion_usuario, idestado, apellido_usuario, identidad_usuario, apodo_usuario, registro_fecha)
    VALUES ('$nombre_usuario', '$contra_usuario', '$correo_usuario', '$tele_usuario', '$direccion_usuario', 1, '$apellido_usuario', '$identidad_usuario', '$apodo_usuario', NOW())";

    // Ejecuta la consulta SQL
    if (mysqli_query($conexion, $sql)) {
        header("Location: ../vistas/usuarios.php?success=true");
        exit();
    } else {
        if (mysqli_errno($conexion) == 1062) {
            echo '<div class="alert alert-danger text-center">Error: El usuario ya existe.</div>';
        } else {
            echo '<div class="alert alert-warning text-center">Error al agregar el usuario.</div>';
        }
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}
?>
