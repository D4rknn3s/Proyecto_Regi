<?php
include "../php/conexion2.php";
include '../modul/Navbar.php';

// Fetch data from the 'deudores' table with additional information
$sql = "SELECT d.iddeudor, u.nombre_usuario, u.apodo_usuario,
               CASE WHEN s.nombre_servicio = 'adelanto' THEN 'Adelanto' ELSE s.nombre_servicio END AS nombre_servicio,
               s.desc_servicio, d.monto_pendiente
        FROM deudores d
        JOIN usuarios u ON d.idusuario = u.idusuario
        LEFT JOIN servicios s ON d.idservicio = s.idservicio";

try {
    $result = $conexion->query($sql);
} catch (PDOException $e) {
    // Manejar el error de consulta
    echo "Error de consulta: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/deudoressty.css">
    <title>Deudores</title>
</head>

<body>
    <div class="cabecera">
        <div class="lineas"></div>
        <header>Deudores</header>
        <div class="lineas"></div>
    </div>

    <!-- buscadores -->
    <div class="container mt-4">
        <form class="form  ">
            <div class="form-group">
                <label for="date" class="form-label">Buscar por fecha</label>
                <input type="date" class="form-control form-control-sm" id="date" name="date" />
            </div>

            <div class="form-group">
                <label for="nombre" class="form-label"></label>
                <input type="text" class="form-control form-control-sm" placeholder="Buscar" id="buscar"
                    name="Buscar" />
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>

        <!-- botones de excel y pdf -->
        <div class="row">
            <div class="col-12">
                <header class="header-table text-start">
                    <a href="" class="btn btn-excel"
                        style="background-color: #228427; color: #fff; border: transparent;">Excel</a>
                    <a href="" class="btn btn-pdf"
                        style="background-color: #5f1017; color: #fff; border: transparent;">PDF</a>
                </header>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table custom-table table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Usuario</th>
                        <th scope="col" class="text-center">Tipo de servicio</th>
                        <th scope="col" class="text-center">Descripcion servicio</th>
                        <th scope="col" class="text-center">Monto pendiente</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    // Display data in the HTML table
                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td class='fila-especial'>" . $row["iddeudor"] . "</td>";
                            echo "<td>" . $row["nombre_usuario"] . "</td>";
                            echo "<td>" . $row["apodo_usuario"] . "</td>";
                            echo "<td>" . $row["nombre_servicio"] . "</td>";
                            echo "<td>" . $row["desc_servicio"] . "</td>";
                            echo "<td>" . $row["monto_pendiente"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No hay registros</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>

<?php
// Cierra la conexión a la base de datos
$conexion = null;
?>
