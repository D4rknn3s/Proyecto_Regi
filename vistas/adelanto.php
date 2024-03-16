<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adelantos</title>
    <link rel="stylesheet" href="../assets/css/deudoressty.css">
</head>
<body>
    <div class="cabecera">
        <div class="lineas"></div>
        <header>Adelantos</header>
        <div class="lineas"></div>
    </div>

    <!-- buscadores -->
    <div class="container mt-4">
        <form class="form" id="searchForm">
            <div class="form-group">
                <label for="buscar" class="form-label">Usuario</label>
                <input type="text" class="form-control form-control-sm" placeholder="Buscar usuario" id="buscar" name="buscar" />
            </div>
            <div class="form-group">
                <label for="fecha">Fecha de Adelanto</label>
                <input type="date" class="form-control form-control-sm" id="fecha" name="fecha" />
            </div>
        </form>

        <!-- botones de excel y pdf -->
        <div class="row">
            <div class="col-12">
                <header class="header-table text-start">
                    <a href="" class="btn btn-excel" style="background-color: #228427; color: #fff; border: transparent;">Excel</a>
                    <a href="" class="btn btn-pdf" style="background-color: #5f1017; color: #fff; border: transparent;">PDF</a>
                </header>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table custom-table table-hover" id="resultsTable">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Nombre</th>
                        <th scope="col" class="text-center">Usuario</th>
                        <th scope="col" class="text-center">Monto Total</th>
                        <th scope="col" class="text-center">Monto Restante</th>
                        <th scope="col" class="text-center">Fecha Adelanto</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se llenarán los datos -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/js/buscadoresAdelanto.js"></script>
</body>
</html>
