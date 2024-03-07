
<?php
// Incluir el archivo de conexión a la base de datos
include "../php/conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del formulario
    $nombre_usuario = $_POST["nombre_usuario"];
    $apellido_usuario = $_POST["apellido_usuario"];
    $identidad_usuario = $_POST["identidad_usuario"];
    $direccion_usuario = $_POST["direccion_usuario"];
    $tele_usuario = $_POST["tele_usuario"];
    $correo_usuario = $_POST["correo_usuario"];
    $apodo_usuario = $_POST["apodo_usuario"];
    $contra_usuario = $_POST["contra_usuario"];
    //$creado_por = $_SESSION["usuario"]["usuario"]; // Ajusta según tu estructura de sesión

    // Prepara la consulta SQL para insertar un nuevo usuario
    
    $sql = "INSERT INTO usuarios (nombre_usuario, contra_usuario, correo_usuario, tele_usuario, direccion_usuario, Habilitar_desahabilitar, idestado, apellido_usuario, identidad_usuario, apodo_usuario, registro_fecha)
    VALUES ('$nombre_usuario', '$contra_usuario', '$correo_usuario', '$tele_usuario', '$direccion_usuario', 'Enabled', 1, '$apellido_usuario', '$identidad_usuario', '$apodo_usuario', NOW())";

    // Ejecuta la consulta SQL
    if (mysqli_query($conexion, $sql)) {
        header("Location: ../vistas/usuarios.php?success=true");
        exit();
    } else {
        if (mysqli_errno($conexion) == 1062) {
            echo '<div class="alert alert-danger text-center">Error ID Ya Existente</div>';
        } else {
            echo '<div class="alert alert-warning text-center">Algunos Campos Estan Vacios</div>';
        }
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}
?>










