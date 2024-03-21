// Función para cargar todos los datos de la tabla al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    searchAndUpdateResults('searchForm', '../php/buscadoresDeuda.php');
});

// Función para hacer la solicitud AJAX al servidor y actualizar la tabla de resultados
function searchAndUpdateResults(formId, targetUrl) {
    // Obtener los datos del formulario
    const formData = new FormData(document.getElementById(formId));

    // Realizar la solicitud AJAX al servidor
    fetch(targetUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Limpiar la tabla de resultados
        const tbody = document.querySelector('#resultsTable tbody');
        tbody.innerHTML = '';

        // Agregar los resultados a la tabla
        data.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.nombre_usuario}</td>
                <td>${row.apodo_usuario}</td>
                <td>${row.nombre_servicio}</td>
                <td>${row.desc_servicio}</td>
                <td>${row.monto_pendiente}</td>
                <td>${row.fecha_deuda}</td>
                <td>
                <button class="btnEnviar" 
                data-iddeudor="${row.iddeudor}" 
                data-idusuario="${row.idusuario}" 
                data-montopendiente="${row.monto_pendiente}">
                Enviar
                </button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Evento de entrada para el campo de búsqueda por nombre de usuario
document.getElementById('buscar').addEventListener('input', function () {
    searchAndUpdateResults('searchForm', '../php/buscadoresDeuda.php');
});

// Evento de cambio para el campo de búsqueda por fecha de deuda
document.getElementById('fecha_deuda').addEventListener('change', function () {
    searchAndUpdateResults('dateSearchForm', '../php/buscadoresDeuda.php');
}); 

// Evento de entrada para el campo de búsqueda por nombre de servicio
document.getElementById('buscar_servicio').addEventListener('input', function () {
    searchAndUpdateResults('serviceSearchForm', '../php/buscadoresDeuda.php');
});

// Evento de clic para los botones de enviar
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('btnEnviar')) {
        const idDeudor = event.target.getAttribute('data-iddeudor');
        const idUsuario = event.target.getAttribute('data-idusuario');
        const montoPendiente = event.target.getAttribute('data-montopendiente');
        
        // Redireccionar a otra página con los parámetros en la URL
        window.location.href = `../model/agregar_pago.php?id_deudor=${idDeudor}&id_usuario=${idUsuario}&monto_pendiente=${montoPendiente}`;
    }
});