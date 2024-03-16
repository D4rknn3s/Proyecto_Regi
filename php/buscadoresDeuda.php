<?php
//este include llama a la base de datos
include "../php/conexion2.php";

// Definir una variable para almacenar la consulta SQL inicial
$sql = "SELECT d.iddeudor, u.nombre_usuario, u.apodo_usuario,
               CASE WHEN s.nombre_servicio = 'adelanto' THEN 'Adelanto' ELSE s.nombre_servicio END AS nombre_servicio,
               s.desc_servicio, d.monto_pendiente, d.fecha_deuda
        FROM deudores d
        JOIN usuarios u ON d.idusuario = u.idusuario
        LEFT JOIN servicios s ON d.idservicio = s.idservicio";

// Definir arreglos para almacenar las condiciones de búsqueda y los valores de los parámetros
$condiciones = array();
$valores = array();

// Verificar si se especificó una búsqueda por nombre de usuario
if (!empty($_POST['buscar'])) {
    $condiciones[] = "u.nombre_usuario LIKE ?";
    $valores[] = "%" . $_POST['buscar'] . "%";
}

// Verificar si se especificó una búsqueda por fecha de deuda
if (!empty($_POST['fecha_deuda'])) {
    $condiciones[] = "d.fecha_deuda = ?";
    $valores[] = $_POST['fecha_deuda'];
}

// Verificar si se especificó una búsqueda por nombre de servicio
if (!empty($_POST['buscar_servicio'])) {
    $condiciones[] = "s.nombre_servicio LIKE ?";
    $valores[] = "%" . $_POST['buscar_servicio'] . "%";
}

// Si hay al menos una condición de búsqueda, agregar un WHERE a la consulta SQL y unir todas las condiciones con AND
if (!empty($condiciones)) {
    $sql .= " WHERE " . implode(" AND ", $condiciones);
}

try {
    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    // Si hay valores para los parámetros de la consulta, bindear los valores
    if (!empty($valores)) {
        // Bindear los valores uno por uno
        foreach ($valores as $key => $valor) {
            $stmt->bindValue($key + 1, $valor);
        }
    }

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados como un array asociativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los resultados como JSON
    echo json_encode($resultados);
} catch (PDOException $e) {
    // Manejar el error de consulta
    echo "Error de consulta: " . $e->getMessage();
}
?>

