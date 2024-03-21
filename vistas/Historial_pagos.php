<?php
include "../php/conexion2.php";
include "../libreria/TCPDF-main/tcpdf.php";

// Inicializamos las variables de búsqueda
$search_query = "";
$date_query = "";

// Verificamos si se ha enviado una consulta de búsqueda por fecha
if (isset($_GET['date'])) {
    $date_query = $_GET['date'];
}

// Verificamos si se ha enviado una consulta de búsqueda por número o término
if (isset($_GET['Buscar'])) {
    $search_query = $_GET['Buscar'];
}

// Preparamos la consulta SQL con las cláusulas WHERE opcionales para la búsqueda
$sql = "SELECT pagos.idpago, 
            pagos.idusuario, 
            usuarios.nombre_usuario, 
            usuarios.apellido_usuario, 
            pagos.idservicio, 
            Servicios.nombre_servicio, 
            pagos.monto, 
            pagos.no_registro_banco, 
            pagos.cuenta_depositar, 
            pagos.fecha_pago, 
            pagos.comprobante
        FROM pagos
        INNER JOIN usuarios ON pagos.idusuario = usuarios.idusuario
        INNER JOIN Servicios ON pagos.idservicio = Servicios.idservicio
        WHERE 1=1"; // Iniciamos con una condición siempre verdadera para simplificar la construcción de la consulta
        
        // Agregamos la condición de fecha si se ha especificado
        if (!empty($date_query)) {
        $sql .= " AND DATE(pagos.fecha_pago) = :fecha_pago";
        }

        if (!empty($search_query)) {
        // Agregamos la condición de búsqueda por término si se ha especificado
        $sql .= " AND (
            pagos.idpago = :search_query OR
            pagos.no_registro_banco = :search_query)";
        }

// Preparamos y ejecutamos la consulta
$sentencia = $conexion->prepare($sql);

// Asignamos valores a los parámetros de la consulta
if (!empty($date_query)) {
    $sentencia->bindParam(':fecha_pago', $date_query);
}

if (!empty($search_query)) {
    $sentencia->bindParam(':search_query', $search_query);
}

$sentencia->execute();
$lista_pagos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/historialPago.css">
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspdf@2.4.0/dist/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-rARs2aD/Z9si3IbZT3lnIzzfy3JrD1pNPwpzO7/QfiDRq6eFQlt65Nx4DOYw1Oy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Historial de pago</title>
 </head>
<body>
   <div class="cabecera">
     <div class="lineas"></div>
       <header>Historial de pago</header>
     <div class="lineas"></div>
   </div>
      <!-- buscadores -->
      <div class="container mt-4">
     <form class="form  ">
       <div class="form-group">
         <label for="date" class="form-label">Buscar por fecha</label>
         <input type="date" class="form-control form-control-sm" id="date" name="date">
        </div>
    <div class="form-group">
        <label for="nombre" class="form-label"></label>
        <input type="text" class="form-control form-control-sm" placeholder="Buscar" id="buscar" name="Buscar">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
        </div>
    </form> 
        <!-- botones de excel y pdf -->
        <div class="row">
    <div class="col-12">
        <header class="header-table text-start">
        <a href="../php/generar_pdf_Pagos.php" class="btn btn-excel" style="background-color: #228427; color: #fff; border: transparent;">PDF</a>
        </header>
    </div>
    </div>
    <div class="table-responsive">
    <table class="table custom-table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">ID usuario</th>
                        <th scope="col" class="text-center">Nombre Usuario</th>
                        <th scope="col" class="text-center">Apellido Usuario</th>
                        <th scope="col" class="text-center">ID servicio</th>
                        <th scope="col" class="text-center">Nombre Servicio</th>
                        <th scope="col" class="text-center">Monto</th>
                        <th scope="col" class="text-center">No registro banco</th>
                        <th scope="col" class="text-center">Cuenta que deposito</th>
                        <th scope="col" class="text-center">Fecha de pago</th>
                        <th scope="col" class="text-center">Imagen comprobante</th>
                        <th scope="col" class="text-center">Estado</th>
                        <th scope="col" class="text-center">Notificación</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_pagos as $registro) { ?>
                        <tr>
                            <td><?php echo $registro['idpago']; ?></td>
                            <td><?php echo $registro['idusuario']; ?></td>
                            <td><?php echo $registro['nombre_usuario']; ?></td>
                            <td><?php echo $registro['apellido_usuario']; ?></td>
                            <td><?php echo $registro['idservicio']; ?></td>
                            <td><?php echo $registro['nombre_servicio']; ?></td>
                            <td><?php echo $registro['monto']; ?></td>
                            <td><?php echo $registro['no_registro_banco']; ?></td>
                            <td><?php echo $registro['cuenta_depositar']; ?></td>
                            <td><?php echo $registro['fecha_pago']; ?></td>
                            <td><button type="button" class="btn btn-link" data-toggle="modal" data-target="#imagenModal">
                            <img src="<?php echo $registro['comprobante']; ?>" class="modal-img btn-ver-imagen" data-toggle="modal" data-target="#imagenModal" style="max-width: 100px; max-height: 100px;">
                            <td><button class="btn btn-sm btn-toggle btn-danger btn-no-pagado" data-toggle="Nopago" data-id="<?php echo $registro['idpago']; ?>">No pagado</button></td>
                            <td><button type="button" class="btn btn-primary btn-notificar btn-sm" data-id="<?php echo $registro['idpago']; ?>">Notificar</button></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<!-- Modal para la imagen -->
<div class="modal fade" id="imagenModal" tabindex="-1" role="dialog" aria-labelledby="imagenModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imagenModalLabel">Imagen Ampliada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-left: auto;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Aquí se mostrará la imagen -->
                <img id="imagenComprobante" src="" alt="Comprobante" style="width: 100%;">
            </div>
        </div>
    </div>
</div>
<!-- Enlace al archivo JavaScript de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-LTEq3vzOYu8GjnzOj3/Ap9DtI/AT0OVY0gm7p5WdRcgNE3tVqFQqH3eJQ5iIvxX1" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Agrega un evento de clic a todas las imágenes con la clase modal-img
    $('.modal-img').click(function() {
        // Obtiene la URL de la imagen del atributo data-img
        var imgSrc = $(this).attr('src');
        // Asigna la URL de la imagen al atributo src del elemento imagen en el modal
        $('#imagenComprobante').attr('src', imgSrc);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
       var toggleButtons = document.querySelectorAll('.btn-toggle');
         toggleButtons.forEach(function (button) {
          button.addEventListener('click', function () {
              var currentState = button.innerText.trim();
              var dataId = button.getAttribute('data-id');

              // Envía la información al servidor mediante una solicitud HTTP (puedes usar Fetch API o jQuery.ajax)
              fetch('../php/actualizar_estado.php', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                  },
                  body: JSON.stringify({
                      id: dataId,
                      estado: currentState,
                  }),
              })
              .then(response => response.json())
              .then(data => {
                  // Maneja la respuesta del servidor si es necesario
                  console.log(data);

                  // Muestra un mensaje de éxito si la solicitud se procesa correctamente
                  if (data.success) {
                      alert('¡Pago aprobado con éxito!');
                  }
              })
              .catch(error => {
                  console.error('Error al enviar la solicitud:', error);
              });

              // Cambia las clases para aplicar la transición
              button.classList.remove('btn-danger', 'btn-success');
              if (currentState === 'No pagado') {
                  button.innerText = 'Pagado';
                  button.classList.add('btn-success');
                } else {
                  button.innerText = 'No pagado';
                  button.classList.add('btn-danger');
                }
            });
        });
     });
   </script>
</body>
</html>