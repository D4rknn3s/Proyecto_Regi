<?php
// Incluir el archivo de conexión a la base de datos
include "../php/conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $nombre_rol = $_POST['nombre_rol'];
    $desc_rol = $_POST['desc_rol'];
    $fecha_rol = $_POST['fecha_rol'];
    
    // Obtener el ID del usuario actual de la sesión
    //$id_usuario = $_SESSION['idusuario']; // Suponiendo que el ID de usuario se guarda en 'id_usuario'

    // Preparar la consulta SQL para obtener el nombre de usuario
    //$sql_usuario = "SELECT nombre_usuario FROM usuarios WHERE idusuario = '$idusuario'";
    //$result_usuario = mysqli_query($conexion, $sql_usuario);

    // Verificar si se encontró el usuario
    //if ($result_usuario) {
      //  $row_usuario = mysqli_fetch_assoc($result_usuario);
        //$creado_por = $row_usuario['nombre_usuario'];

        // Preparar la consulta SQL para insertar el rol
        $sql = "INSERT INTO roles (nombre_rol, desc_rol, fecha_rol,) 
                VALUES ('$nombre_rol', '$desc_rol', '$fecha_rol')";

        // Ejecutar la consulta
        if (mysqli_query($conexion, $sql)) {
            header("Location: ../vistas/roles.php?success=true");
            exit();
        } else {
            echo "Error al agregar el rol: " . mysqli_error($conexion);
        }
    } else {
        echo "Error al obtener el nombre de usuario";
    }


// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>
