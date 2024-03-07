<?php
session_start();
include 'conexion.php'; // Incluye el archivo de conexión

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["correo_usuario"];
    $pass = $_POST["contra_usuario"];

    // Consultar la base de datos para encontrar el usuario
    $sql = "SELECT * FROM usuarios WHERE correo_usuario = '$email' AND contra_usuario = '$pass'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Usuario autenticado, iniciar sesión y redirigir
        $_SESSION["loggedin"] = true;
        $_SESSION["correo"] = $email;
        header("Location: Navbar.php");
    } else {
        echo "Credenciales incorrectas";
    }
}

mysqli_close($conexion); // Cierra la conexión
?>
