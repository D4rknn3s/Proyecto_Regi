<?php
include '../php/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idusuario'])) {
    // Obtener los datos del formulario
    $idusuario = $_POST['idusuario'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $apellido_usuario = $_POST['apellido_usuario'];
    $identidad_usuario = $_POST['identidad_usuario'];
    $direccion_usuario = $_POST['direccion_usuario'];
    $tele_usuario = $_POST['tele_usuario'];
    $correo_usuario = $_POST['correo_usuario'];
    $apodo_usuario = $_POST['apodo_usuario'];
 
    // Actualizar los campos del usuario en la base de datos
    $sql = "UPDATE usuarios SET nombre_usuario = '$nombre_usuario', 
    apellido_usuario = '$apellido_usuario', 
    identidad_usuario = '$identidad_usuario', 
    direccion_usuario = '$direccion_usuario', 
    tele_usuario = '$tele_usuario', 
    correo_usuario = '$correo_usuario', 
    apodo_usuario = '$apodo_usuario' 
    WHERE idusuario = $idusuario";


    if ($conexion->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error al actualizar el usuario: " . $conexion->error;
    }
}
?>
