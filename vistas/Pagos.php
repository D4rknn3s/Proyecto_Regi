<?php
include "../php/conexion2.php";
include '../modul/Navbar.php';


if (isset($_GET['txtid'])) {
    //echo $_GET['txtid'];
    
    $txtid=(isset($_GET['txtid']))?$_GET['txtid']:"";
    
    $sentencia=$conexion->prepare("DELETE FROM pagos 
    where idpago=:idpago");
    
      $sentencia->bindParam( "idpago",$txtid  );
      $sentencia->execute();
    
    }

// Inicializamos la variable de búsqueda
$search_query = "";

// Verificamos si se ha enviado una consulta de búsqueda
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

// Preparamos la consulta SQL con una cláusula WHERE opcional para la búsqueda
$sql = "SELECT pagos.idpago, usuarios.idusuario, usuarios.nombre_usuario, apellido_usuario,Servicios.idservicio, Servicios.nombre_servicio, pagos.monto, pagos.referencia, pagos.cuenta_depositar, pagos.fecha_pago, pagos.comprobante
        FROM pagos
        INNER JOIN usuarios ON pagos.idusuario = usuarios.idusuario
        INNER JOIN Servicios ON pagos.idservicio = servicios.idservicio";

// Si hay un término de búsqueda, agregamos la cláusula WHERE
if (!empty($search_query)) {
    $sql .= " WHERE 
            pagos.idpago LIKE '%$search_query%' OR
            usuarios.nombre_usuario LIKE '%$search_query%' OR
            apellido_usuario LIKE '%$search_query%' OR
            Servicios.nombre_servicio LIKE '%$search_query%' OR
            pagos.monto LIKE '%$search_query%' OR
            pagos.referencia LIKE '%$search_query%' OR
            pagos.cuenta_depositar LIKE '%$search_query%' OR
            pagos.fecha_pago LIKE '%$search_query%'";
}

// Preparamos y ejecutamos la consulta
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$lista_pagos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de pagos</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-DJ0y/X+TtK0OrnE4QMSs1npPpkCtaX7z3l4d+g1fwiEzI5P07l/RVXhRpv5R8Q5e" crossorigin="anonymous">
</head>
<body>
<div class="card">
    <div class="card-header">
        <a class="btn btn-primary" href="../model/agregar_pago.php" role="button">Agregar Pago</a>
        <div class="float-end">
            <form method="get">
                <div class="mb-3">
                    <label for="searchInput" class="form-label">Buscar</label>
                    <input type="text" class="form-control" id="searchInput" name="search" placeholder="Buscar...">
                </div>
                <div class="mb-3">
                    <label for="dateInput" class="form-label">Fecha de Pago</label>
                    <input type="date" class="form-control" id="dateInput" name="date" placeholder="Fecha de pago">
                </div>
                <button type="submit" class="btn btn-secondary">Buscar</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID usuario</th>
                        <th scope="col">Nombre Usuario</th>
                        <th scope="col">Apellido Usuario</th>
                        <th scope="col">ID servicio</th>
                        <th scope="col">Nombre Servicio</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Referencia</th>
                        <th scope="col">Cuenta a depositar</th>
                        <th scope="col">Fecha de pago</th>
                        <th scope="col">imagen comprobante</th>
                        <th scope="col">Acciones</th>
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
                            <td><?php echo $registro['referencia']; ?></td>
                            <td><?php echo $registro['cuenta_depositar']; ?></td>
                            <td><?php echo $registro['fecha_pago']; ?></td>
                            <td>
                                <?php
                                if (!empty($registro['comprobante'])) {
                                    echo '<a href="' . $registro['comprobante'] . '" target="_blank"><img src="' . $registro['comprobante'] . '" alt="Comprobante" style="max-width: 100px; max-height: 100px;"></a>';
                                } else {
                                    echo 'No disponible';
                                }
                                ?>
                            </td>
                            <td>
                                <button id="estadoBtn_<?php echo $registro['idpago']; ?>" class="btn bi bi-cash" onclick="cambiarEstado(<?php echo $registro['idpago']; ?>)">Pagado</button>
                            </td>
                            <td>
                                <a class="btn btn-danger bi bi-trash3" href="Pagos.php?txtid=<?php echo $registro['idpago']; ?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Enlace al archivo JavaScript de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-LTEq3vzOYu8GjnzOj3/Ap9DtI/AT0OVY0gm7p5WdRcgNE3tVqFQqH3eJQ5iIvxX1" crossorigin="anonymous"></script>
<script>
function cambiarEstado(idPago) {
    var boton = document.getElementById("estadoBtn_" + idPago);
    if (boton.textContent === "Pagado") {
        boton.textContent = "No pagado";
        boton.classList.remove("btn-success"); // Quitamos la clase de color verde
        boton.classList.add("btn-danger"); // Añadimos la clase de color rojo
        // Aquí puedes agregar el código para cambiar el estado a no pagado en la base de datos
        console.log("Cambiar estado a no pagado para el ID de pago: " + idPago);
    } else {
        boton.textContent = "Pagado";
        boton.classList.remove("btn-danger"); // Quitamos la clase de color rojo
        boton.classList.add("btn-success"); // Añadimos la clase de color verde
        // Aquí puedes agregar el código para cambiar el estado a pagado en la base de datos
        console.log("Cambiar estado a pagado para el ID de pago: " + idPago);
    }
}
</script>
</body>
</html>