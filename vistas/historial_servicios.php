<?php
 include "../php/conexion2.php";
 $sentencia=$conexion->prepare("SELECT * FROM `servicios`" );
 $sentencia->execute();
 $lista_servicios=$sentencia-> fetchAll(PDO::FETCH_ASSOC);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="card">
    <div class="card-header">
    <h3>Servicios</h3>
    <h5> Fecha Limite alcanzada</h5>
    </div>
    <div class="card-body">
   <div class="table-responsive-sm">
    <table
        class="table table">
        <thead>
            <tr>
                <th scope="col">Nombre servicio</th>
                <th scope="col">Descripción</th>
                <th scope="col">Costo</th>
                <th scope="col">Fecha Inicial</th>
                <th scope="col">Fecha Final</th>
                <th scope="col">Habilitar/Deshabilitar</th>
                </th>
            </tr>
        </thead>
        <tbody>
        
        <?php foreach ($lista_servicios as $registro) {?>
            <tr class="">
                <td><?php echo $registro['nombre_servicio'];   ?> </td>
                <td><?php echo $registro['desc_servicio'];   ?> </td>
                <td><?php echo $registro['cost_servicio'];   ?> </td>
                <td><?php echo $registro['fech_inicio'];   ?> </td>
                <td><?php echo $registro['fech_final'];   ?> </td>
                <td><?php echo $registro['hab_des'];   ?> </td>
            </tr>
            <?php } ?>
            </tr>
            </tr>
            </tr>
            </tr>
        </tbody>
    </table>
   </div>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


