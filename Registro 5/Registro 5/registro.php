<?php
include("conexion_registro.php");

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $identidad_usuario = $_POST['identidad_usuario'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $pass = $_POST['pass'];
        $rol = '2';
        $token = '1';


//validaciones
        //validacion de correo
        $validar_correo ="SELECT * FROM usuarios where correo_usuario ='$correo'";
        $validacion_correo = $conexion->query($validar_correo);

        //validacion de usuario
        $validar_nombre_usuario ="SELECT * FROM usuarios WHERE nombre_usuario ='$nombre'";
        $validacion_nombre_usuario = $conexion->query($validar_nombre_usuario);


        //validacion identidad usuario
        $validar_numero_identidad = "SELECT * FROM usuarios WHERE identidad_usuario = '$identidad_usuario'";
        $validacion_numero_identidad = $conexion->query($validar_numero_identidad);

        //validacion telefono usuario
        $validar_telefono = "SELECT * FROM usuarios WHERE tele_usuario = '$telefono'";
        $validacion_telefono = $conexion->query($validar_telefono);

        //vaidacion apodo usuario
        $validar_apodo = "SELECT * FROM usuarios WHERE apodo_usuario = '$usuario'";
        $validacion_apodo = $conexion->query($validar_apodo);


if ($validacion_correo->num_rows > 0) {
        
        ?>
        <h3 class="bad"> Este correo electronico ya esta registrado </h3>
        <?php

} else {
        if ($validacion_nombre_usuario -> num_rows > 0) {

                ?>
                <h3 class="bad"> ya existe un usuario con este nombre </h3>
                <?php

        } else {
                if ($validacion_numero_identidad -> num_rows > 0) {
                        
                        ?>
                        <h3 class="bad"> Este numero de identidad ya esta registrado a otro usuario</h3>
                        <?php

                } else {
                        if ($validacion_telefono -> num_rows > 0){

                                ?>
                                <h3 class="bad"> Este numero de telefono ya esta registrado </h3>
                                <?php

                        } else {
                                if ($validacion_apodo -> num_rows > 0){

                                        ?>
                                        <h3 class="bad"> Este nombre de usuario ya exite </h3>
                                        <?php
                                } else  {
                                        $consulta = "INSERT INTO usuarios
                                        (nombre_usuario, identidad_usuario, direccion_usuario, tele_usuario , correo_usuario, apodo_usuario, token, contra_usuario, apellido_usuario, idrol, fecha_ingreso) 
                                         VALUES 
                                        ('$nombre','$identidad_usuario','$direccion','$telefono','$correo','$usuario', $token,'$pass', '$apellido', '$rol', now())";

                                         $resultado = mysqli_query($conexion,$consulta);

                                        if ($resultado) {
                                                header("location: ../Login.php");
                                                exit;
                                        } else {
                                                echo "error";
                                            }
                                }


                        }
                }
        }
         
 }       