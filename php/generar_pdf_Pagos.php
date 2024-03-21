<?php
include "../php/conexion2.php";
include "../libreria/TCPDF-main/tcpdf.php";

// Inicializar la variable $lista_pagos
$lista_pagos = array();

$sql = "SELECT pagos.idpago, 
            pagos.idusuario, 
            usuarios.nombre_usuario, 
            usuarios.apellido_usuario, 
            pagos.idservicio, 
            Servicios.nombre_servicio, 
            pagos.monto, 
            pagos.no_registro_banco, 
            pagos.cuenta_depositar, 
            pagos.fecha_pago, 
            pagos.comprobante
        FROM pagos
        INNER JOIN usuarios ON pagos.idusuario = usuarios.idusuario
        INNER JOIN Servicios ON pagos.idservicio = Servicios.idservicio";
$resultado = $conexion->query($sql);

if ($resultado->rowCount() > 0) {
    $lista_pagos = $resultado->fetchAll(PDO::FETCH_ASSOC);
}

// Crear un nuevo objeto TCPDF con orientación horizontal
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Historial de pagos');
$pdf->SetSubject('Historial de pagos');
$pdf->SetKeywords('TCPDF, PDF, historial, pagos');

// Agregar una página
$pdf->AddPage('L'); // 'L' indica orientación horizontal

// Insertar el logo en la parte superior centrada
$imageWidth = 30; 
$imageX = ($pdf->getPageWidth() - $imageWidth) / 2; // Posición X centrada
$pdf->Image('../assets/images/r01.jpg', $imageX, 15, $imageWidth, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->SetFont('helvetica', 'B', 14);

$pdf->SetXY($imageX, 15 + $imageWidth + 5); 
$pdf->Cell($imageWidth, 15, 'Historial de Pagos', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);

$tableY = 15 + $imageWidth + 25; 

// Generar el contenido de la tabla
$html = '<table border="1" cellpadding="5">';
$html .= '<thead><tr><th>ID Pago</th><th>ID Usuario</th><th>Nombre Usuario</th><th>Apellido Usuario</th><th>ID Servicio</th><th>Nombre Servicio</th><th>Monto</th><th>No. Registro Banco</th><th>Cuenta a Depositar</th><th>Fecha de Pago</th><th>Comprobante</th></tr></thead>';
$html .= '<tbody>';
foreach ($lista_pagos as $registro) {
    $html .= '<tr>';
    $html .= '<td>' . $registro['idpago'] . '</td>';
    $html .= '<td>' . $registro['idusuario'] . '</td>';
    $html .= '<td>' . $registro['nombre_usuario'] . '</td>'; 
    $html .= '<td>' . $registro['apellido_usuario'] . '</td>'; 
    $html .= '<td>' . $registro['idservicio'] . '</td>';
    $html .= '<td>' . $registro['nombre_servicio'] . '</td>'; 
    $html .= '<td>' . $registro['monto'] . '</td>';
    $html .= '<td>' . $registro['no_registro_banco'] . '</td>';
    $html .= '<td>' . $registro['cuenta_depositar'] . '</td>';
    $html .= '<td>' . $registro['fecha_pago'] . '</td>';
    $html .= '<td>' . $registro['comprobante'] . '</td>';
    $html .= '</tr>';
}
$html .= '</tbody></table>';

$pdf->SetXY(15, $tableY); 
$pdf->writeHTML($html, true, false, true, false, '', true, false, true, false, '');

ob_end_clean();

// Cerrar y generar el archivo PDF
$pdf->Output('historial_pagos.pdf', 'D'); // 'D' indica descarga

exit;
?>