    <?php
    include '../modul/Navbar.php';
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="../assets/css/StyleGraficos.css">
    <title>Gráfica de Pastel</title>

    </head>
    <body>

    <h1>Graficos</h1>
    <hr>
    <section class="cols-2">
        <figure>
        <h2>Grafico de pie</h2>

        <form method="get" action="" id="formulario">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo isset($_GET['fecha_inicio']) ? htmlspecialchars($_GET['fecha_inicio']) :'2020-01-01'; date('Y-m-d'); ?>" required>

        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo isset($_GET['fecha_fin']) ? htmlspecialchars($_GET['fecha_fin']) :'2024-01-01'; date('Y-m-d'); ?>" required>

        <input type="submit" value="Mostrar Resultados">
        </form>

        <canvas id="paymentChart"></canvas> 
        </figure>
        <figure>
        <h2>Grafico de linea</h2>
        <iframe src="../php/graficolinea1.php" width="100%" height="54%" frameborder="0"></iframe>
        <iframe src="../php/graficolinea2.php" width="100%" height="100%" frameborder="0" ></iframe>
        </figure>
    </section>

    <?php include "../php/PGraficos.php"?>
    <script src="../assets/js/graficos.js"></script>

    

    </body>
    </html>
