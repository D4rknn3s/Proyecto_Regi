<?php
include "../php/conexion2.php";

$servicio = $_GET['servicio'] ?? '';
$monto = $_GET['monto'] ?? '';
$idservicio=$_GET['idservicio'] ?? '';

if ($_POST) {
    // Verificar si se ha cargado una imagen
    if(empty($_FILES['inputImagen']['name'])) {
        echo '<div class="alert alert-danger" role="alert">Error al pagar, se necesita la imagen del comprobante</div>';
    } else {
        // Almacenar otros datos o recepción de datos del formulario
        $idusu = (isset($_POST['idusuario'])) ? $_POST['idusuario'] : "";
        $idserv = (isset($_POST['idservicio'])) ? $_POST['idservicio'] : "";
        $mont = (isset($_POST['monto'])) ? $_POST['monto'] : "";
        $ref = (isset($_POST['no_registro_banco'])) ? $_POST['no_registro_banco'] : "";
        $c_depositar = (isset($_POST['cuenta_depositar'])) ? $_POST['cuenta_depositar'] : "";
        $fechapago = (isset($_POST['fecha_pago'])) ? $_POST['fecha_pago'] : "";

        // Validar si el usuario existe en la base de datos
        $consulta_usuario = $conexion->prepare("SELECT * FROM usuarios WHERE idusuario = :idusuario");
        $consulta_usuario->bindParam(":idusuario", $idusu);
        $consulta_usuario->execute();
        $usuario_existente = $consulta_usuario->fetch(PDO::FETCH_ASSOC);

        // Si el usuario no existe, mostrar un mensaje de error y detener la ejecución
        if (!$usuario_existente) {
            echo '<div class="alert alert-danger" role="alert">El usuario no es correcto</div>';
        } else {
            // Manejar la carga de la imagen del comprobante
            $nombreArchivo = $_FILES['inputImagen']['name'];
            $rutaTemporal = $_FILES['inputImagen']['tmp_name'];
            $rutaDestino = "../images" . $nombreArchivo;

            // Mover la imagen cargada al directorio deseado
            move_uploaded_file($rutaTemporal, $rutaDestino);

            // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla de pagos
            $sentencia = $conexion->prepare("INSERT INTO `pagos` (`idpago`, `idusuario`, `idservicio`, `monto`, `no_registro_banco`, `cuenta_depositar`, `fecha_pago`, `comprobante`) 
                VALUES (NULL, :idusuario, :idservicio, :monto, :no_registro_banco , :cuenta_depositar, :fecha_pago, :comprobante)");

            $sentencia->bindParam(":idusuario", $idusu);
            $sentencia->bindParam(":idservicio", $idserv);
            $sentencia->bindParam(":monto", $mont);
            $sentencia->bindParam(":no_registro_banco", $ref);
            $sentencia->bindParam(":cuenta_depositar", $c_depositar);
            $sentencia->bindParam(":fecha_pago", $fechapago);
            $sentencia->bindParam(":comprobante", $rutaDestino); // Aquí guardamos la ruta del archivo en la base de datos

            $sentencia->execute();

            // Mostrar el mensaje de éxito
            echo '<div class="alert alert-success" role="alert">Pago agregado con éxito</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Enlaces a estilos -->
  <link rel="stylesheet" href="StylesRegistro1.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
  rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
  crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/agregarpago.css">
  <title>Agregar pago</title>
</head>
<body>
  <form action="" enctype="multipart/form-data" method="post">
    <div class="wrapper">
      <div class="container main">
        <div class="row g-3 input-box">  
          <header>Agregar pago</header>
          <div class="divisor"></div> 

          <div class="col-md-4 input-field">
            <input type="text" class="input" id="idusuario" name="idusuario" required="">
            <label for="idusuario">Id Usuario</label> 
          </div>

          <!-- Agregar campos ocultos para almacenar el nombre del servicio y el monto -->
          <input type="hidden" name="servicio" value="<?php echo htmlspecialchars($servicio); ?>">
          <input type="hidden" name="monto" value="<?php echo htmlspecialchars($monto); ?>">
          <input type="hidden" name="idservicio" value="<?php echo htmlspecialchars($idservicio); ?>">

          <div class="col-md-4 input-field">
            <!-- Mostrar el nombre del servicio y el monto en campos de solo lectura -->
            <input type="text" class="input" id="servicio" name="servicio" value="<?php echo htmlspecialchars($servicio); ?>" readonly>
            <label for="servicio" style="position: absolute; top: -20px;">Nombre del Servicio</label> 
          </div>

          <div class="col-md-4 input-field">
            <input type="text" class="input" id="monto" name="monto" value="<?php echo htmlspecialchars($monto); ?>" readonly>
            <label for="monto" style="position: absolute; top: -20px;">Monto</label> 
          </div>
            
          <div class="col-md-4 input-field">
            <input type="text" class="input" id="no_registro_banco" name="no_registro_banco" required="">
            <label for="no_registro_banco">No. Registro banco</label>
          </div>

          <div class="col-md-4 input-field">
            <input type="number" class="input" id="cuenta_depositar" name="cuenta_depositar" required="" autocomplete="off">
            <label for="cuenta_depositar">No. cuenta a depositar</label> 
          </div>

          <div class="col-md-4 input-field">
            <input type="date" class="input" id="fecha_pago" name="fecha_pago" required>
            <label for="fecha_pago" style="position: absolute; top: -20px;">Seleccionar fecha</label>
            <style>
              #fecha_pago::-webkit-datetime-edit, #fecha_pago::-webkit-inner-spin-button, #fecha_pago::-webkit-clear-button {
                display: none;
                margin: 0;
                padding: 0;
                background: none;
                border: none;
                color: transparent;
                appearance: none;
              }
            </style>
          </div>
        <div class="custom-button">
          <label for="inputImagen">
          <img src="../assets/images/foto.png" alt="Subir Imagen">
          <span>Subir Comprobante</span>
        </label>
          <input type="file" id="inputImagen" name="inputImagen" accept="image/*" style="display: none;">
        </div>
          <div class="col-md-4 input-field"><input type="submit" class="submit" value="Agregar pago"></div> 
          <div class="divisor"></div>
        </div>
      </div>
    </div>
  </form>
  <!-- Script de JavaScript -->
  <script>
    document.getElementById('idservicio').addEventListener('change', function() {
      // Obtener el monto asociado al servicio seleccionado
      var montoSeleccionado = parseFloat(this.options[this.selectedIndex].getAttribute('data-monto'));
      // Actualizar el valor del campo de monto a pagar
      document.getElementById('monto').value = montoSeleccionado.toFixed(2); // Mostrar el monto con dos decimales
    });
  </script>
</body>
</html>