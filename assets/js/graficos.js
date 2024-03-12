//creacion del grafico pie
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById('paymentChart').getContext('2d');
    var paymentChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Deudores', 'Pagado', 'Adelanto'],
            datasets: [{
                label: 'Total',
                data: [TDeudores, TPagos, TAdelantos],
                cutout: '20%', //gargen interno del grafico
                backgroundColor: getDataColors(0.3, '#fff'), // 80% de opacidad y fondo blanco
                borderColor: getDataColors(1), //Borde del grafico sin opacidad, mismo color que el original
                borderWidth: 5, // Ancho del borde
            },
            //grafico interno del pie
            {
                label: 'Total Monto',
                data: [TMDeudores, TMPagos, TMAdelantos],
                backgroundColor: getDataColors(0.3, '#fff'), // 80% de opacidad y fondo blanco
                borderColor: getDataColors(1), //Borde del grafico sin opacidad, mismo color que el original
                borderWidth: 5, // Ancho del borde
            }]
        },
    });
    
    //colores del grafico pie
    function getDataColors(opacity, backgroundColor) {
    const colors = ['#82E0AA','#ECF0F1', '#21c0d7', '#d99e2b', '#cd3a81', '#9c99cc', '#e14eca', '#ffffff', '#ff0000', '#d6ff00', '#0038ff'];
    return colors.map(color => `rgba(${parseInt(color.slice(1, 3), 16)}, ${parseInt(color.slice(3, 5), 16)}, ${parseInt(color.slice(5, 7), 16)}, ${opacity})`);
    }
});