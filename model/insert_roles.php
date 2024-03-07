<?php
// Incluir el archivo de conexión a la base de datos
include "../php/conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $nombre_rol = $_POST['nombre_rol'];
    $desc_rol = $_POST['desc_rol'];
    $fecha_rol = $_POST['fecha_rol'];
  
    
    // Obtener el usuario actual de la sesión
    //$creado_por = $_SESSION['apodo_usuario']['apodo_usuario']; // Aquí debes reemplazar 'usuario' con el nombre de la variable de sesión que contiene el nombre de usuario
    
    // Preparar la consulta SQL
    $sql = "INSERT INTO roles (nombre_rol, desc_rol, fecha_rol) 
            VALUES ('$nombre_rol', '$desc_rol', '$fecha_rol')";

    // Ejecutar la consulta
        
    if (mysqli_query($conexion, $sql)) {
        header("Location: ../vistas/roles.php?success=true");
        exit();
    }
    if (mysqli_query($conexion, $sql)) {
        echo "Rol agregado correctamente";
    } else {
        echo "Error al agregar el rol: " . mysqli_error($conexion);
    }
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);
?>










