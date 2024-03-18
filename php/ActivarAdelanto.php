<?php
include "conexion2.php";

try {
    // Obtener todos los IDs de usuario de la tabla deudores
    $sql_ids_usuarios = "SELECT DISTINCT idusuario FROM deudores";
    $result_ids_usuarios = $conexion->query($sql_ids_usuarios);

    if ($result_ids_usuarios->rowCount() > 0) {
        // Iterar sobre cada ID de usuario
        while ($row_ids_usuarios = $result_ids_usuarios->fetch(PDO::FETCH_ASSOC)) {
            $id_usuario = $row_ids_usuarios["idusuario"];

            // Obtener monto restante de adelantos para el usuario actual
            $sql_adelantos = "SELECT idadelanto, monto_restante, idpagos FROM adelantos WHERE idusuario = :id_usuario";
            $stmt_adelantos = $conexion->prepare($sql_adelantos);
            $stmt_adelantos->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt_adelantos->execute();
            $adelantos_por_usuario = $stmt_adelantos->fetchAll(PDO::FETCH_ASSOC);

            // Obtener todos los estados de cuenta que cumplen con la condición "pagado"
            $sql_estados_cuenta = "SELECT idpago FROM estadoscuenta WHERE desc_estado = 'pagado'";
            $stmt_estados_cuenta = $conexion->query($sql_estados_cuenta);
            $estados_cuenta_activos = $stmt_estados_cuenta->fetchAll(PDO::FETCH_COLUMN);

            // Iterar sobre cada adelanto del usuario
            foreach ($adelantos_por_usuario as $adelanto) {
                $adelanto_id = $adelanto['idadelanto'];
                $adelanto_restante = $adelanto['monto_restante'];
                $adelanto_pago_id = $adelanto['idpagos'];

                // Verificar si el pago asociado al adelanto está en estadoscuenta como "pagado"
                if (in_array($adelanto_pago_id, $estados_cuenta_activos)) {
                    // Obtener monto pendiente de la tabla deudores para el usuario actual
                    $sql_deudores = "SELECT iddeudor, monto_pendiente FROM deudores WHERE idusuario = :id_usuario AND monto_pendiente > 0";
                    $stmt_deudores = $conexion->prepare($sql_deudores);
                    $stmt_deudores->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $stmt_deudores->execute();

                    // Iterar sobre cada fila de la tabla deudores para el usuario actual
                    while ($row_deudores = $stmt_deudores->fetch(PDO::FETCH_ASSOC)) {
                        $id_deudor = $row_deudores["iddeudor"];
                        $monto_pendiente_deudor = $row_deudores["monto_pendiente"];

                        // Calcular el monto a pagar para este deudor
                        $monto_a_pagar = min($adelanto_restante, $monto_pendiente_deudor);

                        // Actualizar monto pendiente y monto restante
                        $monto_pendiente_nuevo = $monto_pendiente_deudor - $monto_a_pagar;
                        $monto_restante_nuevo = $adelanto_restante - $monto_a_pagar;

                        // Actualizar la tabla deudores
                        $sql_update_deudores = "UPDATE deudores SET monto_pendiente = :monto_pendiente_nuevo WHERE iddeudor = :id_deudor";
                        $stmt_update_deudores = $conexion->prepare($sql_update_deudores);
                        $stmt_update_deudores->bindParam(':monto_pendiente_nuevo', $monto_pendiente_nuevo, PDO::PARAM_INT);
                        $stmt_update_deudores->bindParam(':id_deudor', $id_deudor, PDO::PARAM_INT);
                        $stmt_update_deudores->execute();

                        // Actualizar la tabla adelantos
                        $sql_update_adelantos = "UPDATE adelantos SET monto_restante = :monto_restante_nuevo WHERE idadelanto = :adelanto_id";
                        $stmt_update_adelantos = $conexion->prepare($sql_update_adelantos);
                        $stmt_update_adelantos->bindParam(':monto_restante_nuevo', $monto_restante_nuevo, PDO::PARAM_INT);
                        $stmt_update_adelantos->bindParam(':adelanto_id', $adelanto_id, PDO::PARAM_INT);
                        $stmt_update_adelantos->execute();

                        // Actualizar el monto restante del adelanto
                        $adelanto_restante = $monto_restante_nuevo;

                        // Si el monto restante en adelantos llega a 0, salir del bucle
                        if ($monto_restante_nuevo <= 0) {
                            break;
                        }
                    }
                }
            }
        }
    } else {
        echo "No se encontraron IDs de usuario en la tabla deudores.<br>";
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
