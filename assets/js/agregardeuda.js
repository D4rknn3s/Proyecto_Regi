//funcion del boton crear deudas
function crearDeuda(idServicio) {
    $.ajax({
        type: 'POST',
        url: '../php/llamarprodeuda.php',
        data: { idServicio: idServicio },
        success: function(response) {
            alert('deudas agregadas');
            location.reload(); // Actualizar la página después de llamar al procedimiento almacenado
        },
        error: function(xhr, status, error) {
            alert('Error al llamar al procedimiento almacenado');
            console.error(xhr.responseText);
        }
    });
}