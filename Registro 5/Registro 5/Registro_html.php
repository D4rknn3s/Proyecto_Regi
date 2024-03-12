//sistemas

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <link rel="stylesheet" href="StylesRegistro1.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
    <link rel="stylesheet" href="StylesRegistro.css">
  <title>Registro</title>
</head>
<body>
  <form action="registro.php" method="post">
  <div class="wrapper">
    <div class="container main">

        <div class="row g-3 input-box">

                   
                <header>Registrarse</header>
                <div class="divisor"></Div>


                   <div class="col-md-5 input-field">
                        <input type="text" class="input" name="nombre" required="" autocomplete="off">
                        <label for="nombre">Nombre y apellido</label> 
                   </div>

                   <div class="col-md-5 input-field">
                        <input type="text" class="input" name="identidad_usuario" required="">
                        <label for="identidad_usuario">No. Identidad</label>
                    </div> 

                    <div class="col-md-5 input-field">
                        <input type="text" class="input" name="direccion" required="" autocomplete="off">
                        <label for="direccion">Dirección</label> 
                   </div>

                   <div class="col-md-5 input-field">
                        <input type="text" class="input" name="telefono" required="">
                        <label for="telefono">Teléfono</label>
                    </div>

                    <div class="col-md-5 input-field">
                        <input type="text" class="input" name="casa" required="" autocomplete="off">
                        <label for="casa">No. de casa</label> 
                   </div>

                   <div class="col-md-5 input-field">
                        <input type="text" class="input" name="cuadra" required="">
                        <label for="cuadra">No. de cuadra</label>
                    </div>

                    <div class="col-md-5 input-field">
                        <input type="text" class="input" name="correo" required="" autocomplete="off">
                        <label for="correo">Correo electrónico</label> 
                   </div>

                   <div class="col-md-5 input-field">
                        <input type="text" class="input" name="usuario" required="">
                        <label for="usuario">Nombre de usuario</label>
                    </div>

                    <div class="col-md-5 input-field">
                        <input type="password" class="input" name="pass" required="">
                        <label for="pass">Contraseña</label>
                    </div>

                    <div class="col-md-5 input-field">
                        <input type="password" class="input" name="pass" required="">
                        <label for="pass">Confirmar contraseña</label>
                    </div>


                   <div class="col-md-6 input-field">                        
                        <input type="submit" class="submit" name="registrarse">
                        <a href="http://localhost:8080/proyecto/Navbar\Navbar\Navbar.php"></a>
                   </div> 

                   <div class="input-field signin">
                    <span>¿Ya está registrado? <a href="http://localhost:8080/proyecto/Login/Login/Login.php">Iniciar Sesión</a></span>
                   </div>  

                   <div class="divisor"></Div>

        </div>

    </div>
</form>

</div>

</body>
</html>
