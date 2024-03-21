<?php
include "../php/conexion2.php";

// Verifica si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos del cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents("php://input"));

    // Obtiene el ID del pago y el nuevo estado del objeto JSON
    $idPago = $data->id;
    $nuevoEstado = ($data->estado == 'No pagado') ? 'Pagado' : 'No pagado';

    // Actualiza el estado en la tabla pagos
    $sql = "UPDATE estadoscuenta SET desc_estado = :nuevoEstado WHERE idpago = :idPago";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':nuevoEstado', $nuevoEstado);
    $stmt->bindParam(':idPago', $idPago);

    if ($stmt->execute()) {
        // Retorna un mensaje de éxito como respuesta JSON
        echo json_encode(["success" => true, "message" => "Estado actualizado correctamente"]);
    } else {
        // Si hay un error, retorna un mensaje de error como respuesta JSON
        echo json_encode(["success" => false, "message" => "Error al actualizar el estado"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Método de solicitud no permitido"]);
}
?>