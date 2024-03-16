<?php
// Incluir el archivo de conexión a la base de datos
include "../php/conexion2.php";

// Definir una variable para almacenar la consulta SQL base
$sql = "SELECT u.nombre_usuario, u.apodo_usuario, a.monto_total, a.monto_restante, a.fecha_adelanto
        FROM adelantos a
        JOIN usuarios u ON a.idusuario = u.idusuario";

// Definir arreglos para almacenar las condiciones de búsqueda y los valores de los parámetros
$condiciones = array();
$valores = array();

// Verificar si se especificó una búsqueda por nombre de usuario
if (!empty($_POST['buscar'])) {
    $condiciones[] = "u.nombre_usuario LIKE ?";
    $valores[] = "%" . $_POST['buscar'] . "%";
}

// Verificar si se especificó una búsqueda por fecha de adelanto
if (!empty($_POST['fecha'])) {
    $condiciones[] = "a.fecha_adelanto = ?";
    $valores[] = $_POST['fecha'];
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
