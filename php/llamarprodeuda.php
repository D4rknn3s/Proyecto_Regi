<?php
include "../php/conexion2.php";

// Verificar si se recibió el ID del servicio
if (isset($_POST['idServicio'])) {
    $idServicio = $_POST['idServicio'];
    llamarCrearDeuda($idServicio, $conexion);
} else {
    echo "Error: No se recibió el ID del servicio";
}

// Función para llamar al procedimiento almacenado 'CrearDeuda'
function llamarCrearDeuda($idServicio, $conexion) {
    try {
        // Llamar al procedimiento almacenado 'CrearDeuda' con el ID del servicio
        $sql = "CALL CrearDeuda(:idServicio)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':idServicio', $idServicio, PDO::PARAM_INT);
        $stmt->execute();
        echo "Procedimiento almacenado llamado con éxito";
    } catch (PDOException $e) {
        echo "Error al llamar al procedimiento almacenado: " . $e->getMessage();
    }
}
?>
