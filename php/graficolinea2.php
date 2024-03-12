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

// Rango de fechas por defecto (un año atrás desde la fecha actual)
$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d', strtotime('-1 year'));
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

// Consulta SQL para obtener datos dentro del rango de fechas especificado
$sql = "SELECT DATE_FORMAT(p.fecha_pago, '%Y-%m') AS month, SUM(p.monto) AS total_pago 
        FROM pagos p
        LEFT JOIN servicios s ON p.idservicio = s.idservicio
        WHERE (s.nombre_servicio <> 'adelanto' OR s.idservicio IS NULL)
          AND p.fecha_pago BETWEEN '$startDate' AND '$endDate' 
        GROUP BY month";
$result = $conexion->query($sql);

$data = array();

// Obtener datos y almacenarlos en un array asociativo
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[$row['month']] = $row['total_pago'];
}

// Crear un array con todos los meses dentro del rango de fechas
$allMonths = array();
$currentDate = new DateTime($startDate);
$endDateObj = new DateTime($endDate);
while ($currentDate <= $endDateObj) {
    $allMonths[] = $currentDate->format('Y-m');
    $currentDate->modify('+1 month');
}

// Llenar con ceros los meses sin pagos
foreach ($allMonths as $month) {
    if (!isset($data[$month])) {
        $data[$month] = 0;
    }
}

// Ordenar el array por mes
ksort($data);

// Cerrar conexión
$conexion = null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/StyleGraficos.css">
    <title>Gráfico de Línea con Chart.js</title>
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

    <!-- Canvas para el gráfico -->
    <canvas id="myChart"></canvas>
</figure>

<script>
    // Datos obtenidos de PHP
    var dataFromPHP = <?php echo json_encode(array_values($data)); ?>;
    var labelsFromPHP = <?php echo json_encode(array_map(function($month) {
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        return $meses[date('n', strtotime($month)) - 1];
    }, array_keys($data))); ?>;

    // Llamar a la función para dibujar el gráfico
    drawChart(dataFromPHP, labelsFromPHP);

    // Función para dibujar el gráfico
    function drawChart(data, labels) {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total de Pagos',
                    data: data,
                    fill: false,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'category', // Cambiar a tipo de categoría
                        labels: labels,
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }
</script>
</body>

</html>
