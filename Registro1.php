<?php
session_start();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/StylesRegistro.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/StylesRegistro.css">
  <title>Registro</title>
</head>
<body>
<form action="../model/insert_registro.php" method="POST">
  <div class="wrapper">
    <div class="container main">

        <div class="row g-3 input-box">

                   
                
        
                <header>Registrarse</header>
                <div class="divisor"></Div>

                   <div class="col-md-5 input-field">
                        <input type="text" class="input" id="nombre_usuarioo" name="nombre_usuario" required="" autocomplete="off">
                        <label for="nombre_usuario">Nombre </label> 
                   </div>

                   <div class="col-md-5 input-field">
                        <input type="text" class="input" id="apellido_usuarioo" name="apellido_usuario" required="" autocomplete="off">
                        <label for="apellidio_usuario">Apellido</label> 
                   </div>

                   <div class="col-md-5 input-field">
                        <input type="text" class="input" id="identidad_usuario" name="identidad_usuario" required="">
                        <label for="identidad_usuario">No. Identidad</label>
                    </div> 

                    <div class="col-md-5 input-field">
                        <input type="text" class="input" id="direccion_usuario" name="direccion_usuario" required="" autocomplete="off">
                        <label for="direccion_usuario">Dirección</label> 
                   </div>

                   <div class="col-md-5 input-field">
                        <input type="text" class="input" id="tele_usuario" name="tele_usuario" required="">
                        <label for="tele_usuario">Teléfono</label>
                    </div>

                    <div class="col-md-5 input-field">
                        <input type="text" class="input" id="correo_usuario" name="correo_usuario" required="" autocomplete="off">
                        <label for="correo_usuario">Correo electrónico</label> 
                   </div>

                   <div class="col-md-5 input-field">
                        <input type="text" class="input" id="apodo_usuario" name="apodo_usuario" required="">
                        <label for="apodo_usuario">Nombre de usuario</label>
                    </div>

                    <div class="col-md-5 input-field">
                        <input type="password" class="input" id="contra_usuario" name="contra_usuario" required="">
                        <label for="contra_usuario">Contraseña</label>
                    </div>

                    <div class="col-md-5 input-field">
                        <input type="password" class="input" id="contra_usuario" name="contra_usuario" required="">
                        <label for="contra_usuario">Confirmar contraseña</label>
                    </div>

                    <div class="divisor"></Div>

                   <div class="col-md-6 input-field">                        
                        <input type="submit" class="submit" name="registrarse">
                   </div> 

                   <div class="input-field signin">
                    <span>¿Ya está registrado? <a href="#">Iniciar Sesión</a></span>
                   </div>  

                  
                

        </div> 

    </div>
</form>

</div>

</body>
</html>