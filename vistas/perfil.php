
<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['idusuario'])) {
    $idusuario = $_SESSION['idusuario'];

    // Conexión a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "bd_regi");
    
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Consulta SQL para obtener los datos del perfil del usuario


    $sql = "SELECT usuarios.apodo_usuario, usuarios.nombre_usuario, usuarios.apellido_usuario,
    usuarios.correo_usuario, usuarios.direccion_usuario, usuarios.tele_usuario,
    roles.nombre_rol,  estados.idestado
    FROM usuarios 
    JOIN roles ON usuarios.idrol = roles.idrol
    JOIN estados ON usuarios.idestado = estados.idestado
    WHERE usuarios.idusuario = $idusuario";

    
    //$query = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";


    $result = mysqli_query($conexion, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        // Si se encuentra el usuario, mostrar los datos en la interfaz del perfil
        $row = mysqli_fetch_assoc($result);

        // Asignar los valores a las variables
        $apodoUsuario = $row["apodo_usuario"];
        $nombreRol = $row["nombre_rol"];
        $nombre = $row["nombre_usuario"];
        $apellido = $row["apellido_usuario"];
        $email = $row["correo_usuario"];
        $direccion = $row["direccion_usuario"];
        $telefono = $row["tele_usuario"];
        $estadoUsuario = $row["idestado"];       // Por ejemplo, puedes mostrar el nombre, apellido, correo electrónico y otros detalles del usuario
        $nombre_usuario = $row['nombre_usuario'];
        $apellido_usuario = $row['apellido_usuario'];
        $correo_usuario = $row['correo_usuario'];
        // Agregar más campos según sea necesario
    }

    mysqli_close($conexion);
} else {
    // Si el usuario no ha iniciado sesión.
    echo "Usuario no autenticado.";
}
?>


//$idUsuarioDeseado = 1;
/*$sql = "SELECT usuarios.apodo_usuario, usuarios.nombre_usuario, usuarios.apellido_usuario,
usuarios.correo_usuario, usuarios.direccion_usuario, usuarios.tele_usuario,
roles.nombre_rol,  estados.idestado
FROM usuarios 
JOIN roles ON usuarios.idrol = roles.idrol
JOIN estados ON usuarios.idestado = estados.idestado
WHERE usuarios.idusuario = $idUsuarioDeseado";
$result = $conexion->query($sql);
*/


// Verificar si hay resultados
/*if ($result->num_rows > 0) {
    // Iterar sobre los resultados
    while ($row = $result->fetch_assoc()) {
        // Asignar los valores a las variables
        $apodoUsuario = $row["apodo_usuario"];
        $nombreRol = $row["nombre_rol"];
        $nombre = $row["nombre_usuario"];
        $apellido = $row["apellido_usuario"];
        $email = $row["correo_usuario"];
        $direccion = $row["direccion_usuario"];
        $telefono = $row["tele_usuario"];
        $estadoUsuario = $row["idestado"];


    }
} else {
    echo "No se encontraron resultados en la base de datos.";
}*/


  
  <div class="container emp-profile">
    <form method="post">
        <div class="row">
            <div class="col-md-4">
                <div class="profile-img">
                    <img src="/4549-zelda.jpg" id="profileImageInput" alt=""/>
                    <div class="file btn btn-lg btn-primary">
                        Cambiar Foto de Perfil
                        <input type="file" name="file" id="profileImageInput" accept="image/*"/>
                    </div>
                </div>
            </div>
                <div class="col-md-6">
                    <div class="profile-head">
                                <h5>
                                    <div class="col-md-6" id="apodo_usuario">
                                        <label for="apodo_usuario"><?php echo '<h5>' . $apodoUsuario. '</h5>';?></label>
                                    </div>
                                </h5>
                                <h6>
                                    <div class="col-md-6">
                                        <label for="nombre_rol"><?php echo '<h6>' . $nombreRol. '</h6>';?></label>
                                    </div>
                                </h6>
                                
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#" role="tab" aria-controls="home" aria-selected="true">Información De Usuario</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#" role="tab" aria-controls="profile" aria-selected="false">Información De Pagos</a>
                            </li>
                        </ul>
                    </div>
                </div>
        </div>


        

        
        <div class="row">


            <div class="col-md-4">
                <div class="profile-links">
                    <p>Perfi De Usuario</p>
                    <a href="">Mensajes</a><br/>
                    <a href="">Servicios</a><br/>
                </div>
            </div>


            <div class="col-md-8">

                <div class="tab-content profile-tab" id="myTabContent">

                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="row">
                                    <div class="col-md-6">
                                    <label>Nombre de usuario</label>
                                    </div>
                                    <div class="col-md-6">
                                    <?php echo '<p>' . $apodoUsuario. '</p>';?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Nombre</label>
                                    </div>
                                    <div class="col-md-6">
                                    <?php echo '<p>' . $nombre. '</p>';?>
                                    </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                      <label>Apellido</label>
                                  </div>
                                  <div class="col-md-6">
                                  <?php echo '<p>' . $apellido. '</p>';?>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                      <label>Correo electrónico</label>
                                  </div>
                                  <div class="col-md-6">
                                  <?php echo '<p>' . $email. '</p>';?>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                      <label>Dirección</label>
                                  </div>
                                  <div class="col-md-6">
                                  <?php echo '<p>' . $direccion. '</p>';?>
                                  </div>
                                </div>

                                <div class="row">
                                 <!-- <div class="col-md-6">
                                      <label>No.Casa/Apartamento</label>
                                  </div>
                                  <div class="col-md-6">
                                      <p>01010101</p>
                                  </div>-->
                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                      <label>Telefono</label>
                                  </div>
                                  <div class="col-md-6">
                                  <?php echo '<p>' . $telefono. '</p>';?>
                                  </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <p>Estado Usuario</p>
                                    </div>
                                    <div class="col-md-6">
                                    <?php echo '<p>' . $estadoUsuario. '</p>';?>
                                    </div>
                                </div>
      
                    </div>   
                    
                </div>

            </div>


        </div>

    </form>  
    
    
</div>


<script>
    document.getElementById('profileImageInput').addEventListener('change', function (event) {
        const fileInput = event.target;
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const profileImage = document.getElementById('profileImageInput');
                profileImage.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
</script>