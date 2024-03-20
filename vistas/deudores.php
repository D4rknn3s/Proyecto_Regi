<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/deudoressty.css">
    <title>Deudores</title>
</head>
<body>
    <div class="cabecera">
        <div class="lineas"></div>
        <header>Deudores</header>
        <div class="lineas"></div>
    </div>

    <!-- buscadores -->
    <div class="container mt-4">
        <form class="form" id="searchForm">
            <div class="form-group">
                <label for="buscar" class="form-label">usuario</label>
                <input type="text" class="form-control form-control-sm" placeholder="Buscar" id="buscar"
                       name="buscar" />
            </div>
        </form>

        <form class="form" id="dateSearchForm">
            <div class="form-group">
                <label for="fecha_deuda" class="form-label">fecha</label>
                <input type="date" class="form-control form-control-sm" id="fecha_deuda" name="fecha_deuda" />
            </div>
        </form>

        <form class="form" id="serviceSearchForm">
            <div class="form-group">
                <label for="buscar_servicio" class="form-label">servicio</label>
                <input type="text" class="form-control form-control-sm" placeholder="Buscar servicio" id="buscar_servicio"
                       name="buscar_servicio" />
            </div>
        </form>

        <!-- botones de excel y pdf -->
        <div class="row">
            <div class="col-12">
                <header class="header-table text-start">
                    <a href="" class="btn btn-excel"
                       style="background-color: #228427; color: #fff; border: transparent;">Excel</a>
                    <a href="" class="btn btn-pdf"
                       style="background-color: #5f1017; color: #fff; border: transparent;">PDF</a>
                </header>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table custom-table table-hover" id="resultsTable">
                <thead>
                <tr>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Usuario</th>
                    <th scope="col" class="text-center">Tipo de servicio</th>
                    <th scope="col" class="text-center">Descripcion servicio</th>
                    <th scope="col" class="text-center">Monto pendiente</th>
                    <th scope="col" class="text-center">Fecha de la deuda</th>
                </tr>
                </thead>
                <tbody>
                <!-- Aquí se llenarán los datos -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="../assets/js/buscadoresdeuda.js"></script>

</body>
</html>

