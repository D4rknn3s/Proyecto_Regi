// Función para cargar todos los datos de la tabla al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    searchAndUpdateResults('searchForm', '../php/buscadoresAdelantos.php');
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
                <td>${row.monto_total}</td>
                <td>${row.monto_restante}</td>
                <td>${row.fecha_adelanto}</td>
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
    searchAndUpdateResults('searchForm', '../php/buscadoresAdelantos.php');
});

// Evento de entrada para el campo de búsqueda por fecha
document.getElementById('fecha').addEventListener('input', function () {
    searchAndUpdateResults('searchForm', '../php/buscadoresAdelantos.php');
});
