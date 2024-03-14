<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo_usuario'];
    $contrasena = $_POST['contra_usuario'];

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "bd_regi");
    
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Consulta SQL para verificar las credenciales
    $query = "SELECT * FROM usuarios WHERE correo_usuario = '$correo' AND contra_usuario = '$contrasena'";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['usuarios'] = $correo;
        header("location:index.html");
        exit;
    } else {
        $error = "Correo electrónico o contraseña incorrectos";
    }

    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/StylesLogin.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
    crossorigin="anonymous">
  <title>Login</title>
</head>
<body>

<form class="mx-auto" method="POST" action="">

  <div class="wrapper">
    <div class="container main">
        <div class="row">
            <div class="col-md-6 side-image">

                <img src="assets/images/r02.png" alt=>

                <div class="text">
                    <p>Bienvenido<i></i></p>
                </div>
                <br>
                <div class="text-t">
                    <p>Inicia sesión con tu cuenta<i></i></p>
                </div>
                
            </div>
            <div class="col-md-6 right">
                <div class="input-box">
                   
                   <header>Iniciar Sesión</header>
                   <?php if (isset($error)) { ?>
                   <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                    <?php } ?>
                   <div class="input-field">
                        <input type="text" class="input" id="correo_usuario" name="correo_usuario" required="" autocomplete="off" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="El correo debe contener @">
                        <label for="email">Correo electrónico</label> 
                    </div> 
                   <div class="input-field">
                        <input type="password" class="input" id="contra_usuario" name="contra_usuario" pattern=".{8,32}" title="Debe contener al menos 8 caracteres, una mayúscula, un número y un carácter especial"  required>
                        <label for="pass">Contraseña</label>
                    </div> 
                   <div class="input-field">                        
                   <input type="submit" class="submit" value="Acceder">
                   </div> 
                   <div class="signin">
                    <span><a href="#">Ha olvidado su contraseña? </a></span>
                   </div>
                   <div class="signin">
                    <span>Aún no tienes Cuenta? <a href="http://localhost/Proyecto_Regi-main/Registro%205/Registro%205/registro_html.php">Registrarse!!</a> </span>
                   </div>
                </div>  
            </div
        </div>
    </div>
</div>

</body>
</html>
