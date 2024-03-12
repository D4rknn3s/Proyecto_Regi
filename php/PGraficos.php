<?php
include "conexion2.php";

$paymentData = array(); // Array para almacenar los resultados

// Verificar si se enviaron fechas desde el formulario
if (isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin'])) {
    $fecha_inicio = $_GET['fecha_inicio'];
    $fecha_fin = $_GET['fecha_fin'];

    $sql = "SELECT 'Pagos' as tipo, 'Pagado' as estado, COUNT(idpago) as totalPagos, SUM(monto) as totalMonto 
            FROM pagos LEFT JOIN servicios ON pagos.idservicio = servicios.idservicio
            WHERE pagos.fecha_pago BETWEEN '$fecha_inicio' AND '$fecha_fin' 
              AND (servicios.nombre_servicio <> 'adelanto' OR servicios.idservicio IS NULL)
            GROUP BY estado
            UNION
            SELECT 'Deudores' as tipo, 'No Pagado' as estado, COUNT(iddeudor) as totalPagos, SUM(monto_pendiente) as totalMonto 
            FROM deudores WHERE monto_pendiente > 0 GROUP BY tipo
            UNION
            SELECT 'Adelantos' as tipo, '' as estado, COUNT(idadelanto) as totalPagos, SUM(monto_restante) as totalMonto 
            FROM adelantos WHERE fecha_adelanto BETWEEN '$fecha_inicio' AND '$fecha_fin' GROUP BY tipo";

    $result = $conexion->query($sql);

    // Resto del código...

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $paymentData[] = $row;
        }

        // Inicializar totales
        $TDeudores = $TMDeudores = $TPagos = $TMPagos = $TAdelantos = $TMAdelantos = 0;

        foreach ($paymentData as $row) {
            $tipo = $row["tipo"];
            $estado = $row["estado"];
            $count = $row["totalPagos"];
            $monto = $row["totalMonto"];

            // Actualizar totales según el tipo
            switch ($tipo) {
                case 'Deudores':
                    $TDeudores += $count;
                    $TMDeudores += $monto;
                    break;
                case 'Pagos':
                    $TPagos += $count;
                    $TMPagos += $monto;
                    break;
                case 'Adelantos':
                    $TAdelantos += $count;
                    $TMAdelantos += $monto;
                    break;
            }
        }

        // Puedes usar estos totales como necesites
        echo "Total Pagos Deudores: $TDeudores, Total Monto Deudores: $TMDeudores<br>";
        echo "Total Pagos Pagos: $TPagos, Total Monto Pagos: $TMPagos<br>";
        echo "Total Pagos Adelantos: $TAdelantos, Total Monto Adelantos:  $TMAdelantos<br>";

        echo "<script>";
        echo "var TDeudores = $TDeudores;";
        echo "var TMDeudores = $TMDeudores;";
        echo "var TPagos = $TPagos;";
        echo "var TMPagos = $TMPagos;";
        echo "var TAdelantos = $TAdelantos;";
        echo "var TMAdelantos = $TMAdelantos;";
        echo "</script>";
    } else {
        echo "<p>No se encontraron resultados para el rango de fechas seleccionado.</p>";
    }

}

// Cerrar la conexión a la base de datos
$conexion = null;
?>
