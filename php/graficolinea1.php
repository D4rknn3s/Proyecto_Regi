<?php
$host = 'localhost';
$dbname = 'bd_regi';
$username = 'root';
$password = '';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Establecer el modo de error PDO a excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Manejar el error de conexión, si es necesario
    echo "Error de conexión: " . $e->getMessage();
}

// Rango de fechas por defecto (ajusta según sea necesario)
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : '2022-01-01';
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

// Consulta SQL para obtener datos dentro del rango de fechas especificado
$sql = "SELECT YEAR(fecha_pago) AS year, SUM(monto) AS total_pago 
        FROM pagos p
        LEFT JOIN servicios s ON p.idservicio = s.idservicio
        WHERE (s.nombre_servicio <> 'adelanto' OR s.idservicio IS NULL)
          AND fecha_pago BETWEEN '$startDate' AND '$endDate' 
        GROUP BY YEAR(fecha_pago)";
$result = $conexion->query($sql);

$data = array();

// Obtener datos y almacenarlos en un array asociativo
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

// Cerrar conexión
$conexion = null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/StyleGraficos.css">
    <title></title>
    <!-- Agregar la librería Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

        <!-- Formulario para seleccionar el rango de fechas -->
        <form method="GET" action="">
            <label for="start_date">Fecha de inicio:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo $startDate; ?>">

            <label for="end_date">Fecha de fin:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo $endDate; ?>">

            <input type="submit" value="Actualizar">
        </form>

        <!-- Canvas para el gráfico -->
        <canvas id="myChart"></canvas>


    <script>
        // Datos obtenidos de PHP
        var dataFromPHP = <?php echo json_encode($data); ?>;

        // Llamar a la función para dibujar el gráfico
        drawChart(dataFromPHP);

        // Función para dibujar el gráfico
        function drawChart(data) {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(item => item.year.toString()), // Convertir los años a cadenas
                    datasets: [{
                        label: 'Total de Pagos',
                        data: data.map(item => item.total_pago),
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2
                    }]
                },
            });
        }
    </script>
</body>

</html>
