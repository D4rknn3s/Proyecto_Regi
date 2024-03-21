<?php
include "../php/conexion2.php";
include "../libreria/TCPDF-main/tcpdf.php";

// Inicializar la variable $lista_usuarios
$lista_usuarios = array();

$sql = "SELECT u.idusuario, 
            u.nombre_usuario, 
            u.apellido_usuario, 
            u.apodo_usuario, 
            u.correo_usuario, 
            u.tele_usuario, 
            u.direccion_usuario, 
            e.estado, 
            r.nombre_rol
        FROM usuarios u
        INNER JOIN estados e ON u.idestado = e.idestado
        INNER JOIN roles r ON u.idrol = r.idrol";
$resultado = $conexion->query($sql);

if ($resultado->rowCount() > 0) {
    $lista_usuarios = $resultado->fetchAll(PDO::FETCH_ASSOC);
}

// Crear un nuevo objeto TCPDF con orientación horizontal
$pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Historial de Usuarios');
$pdf->SetSubject('Historial de Usuarios');
$pdf->SetKeywords('TCPDF, PDF, historial, usuarios');

// Agregar una página
$pdf->AddPage('L'); // 'L' indica orientación horizontal

// Insertar el logo en la parte superior centrada
$imageWidth = 30; 
$imageX = ($pdf->getPageWidth() - $imageWidth) / 2; // Posición X centrada
$pdf->Image('../assets/images/r01.jpg', $imageX, 15, $imageWidth, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

$pdf->SetFont('helvetica', 'B', 14);

$pdf->SetXY($imageX, 15 + $imageWidth + 5); 
$pdf->Cell($imageWidth, 15, 'Historial de Usuarios', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);

$tableY = 15 + $imageWidth + 25; 

// Generar el contenido de la tabla
$html = '<table border="1" cellpadding="5">';
$html .= '<thead><tr><th>ID Usuario</th><th>Nombre</th><th>Apellido</th><th>Apodo</th><th>Correo</th><th>Teléfono</th><th>Dirección</th><th>Rol</th><th>Estado</th></tr></thead>';
$html .= '<tbody>';
foreach ($lista_usuarios as $usuario) {
    $html .= '<tr>';
    $html .= '<td>' . $usuario['idusuario'] . '</td>';
    $html .= '<td>' . $usuario['nombre_usuario'] . '</td>'; 
    $html .= '<td>' . $usuario['apellido_usuario'] . '</td>';
    $html .= '<td>' . $usuario['apodo_usuario'] . '</td>';
    $html .= '<td>' . $usuario['correo_usuario'] . '</td>';
    $html .= '<td>' . $usuario['tele_usuario'] . '</td>';
    $html .= '<td>' . $usuario['direccion_usuario'] . '</td>';
    $html .= '<td>' . $usuario['nombre_rol'] . '</td>';
    $html .= '<td>' . $usuario['estado'] . '</td>';
    $html .= '</tr>';
}
$html .= '</tbody></table>';

$pdf->SetXY(15, $tableY); 
$pdf->writeHTML($html, true, false, true, false, '', true, false, true, false, '');

ob_end_clean();

// Cerrar y generar el archivo PDF
$pdf->Output('historial_usuarios.pdf', 'D'); // 'D' indica descarga

exit;
?>