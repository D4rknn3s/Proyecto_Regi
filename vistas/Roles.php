<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
  rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
  crossorigin="anonymous">
  <link rel="stylesheet" href="../assets/css/Roles.css">
  <title>Roles</title>
</head>
<body>
  
  <div class="container mt-4">

    <div class="cabecera">
      <div class="lineas"></div>
        <header>Roles en REGI</header>
      <div class="lineas"></div>
    </div>
    
    <div class="container mt-4 botones">

      <div></div>
      <!-- Botón para abrir el formulario emergente -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Crear nuevo rol
      </button>
      <button type="button" class="btn btn-secondary">
        Eliminar rol
      </button>

      

    
      <!-- Formulario emergente (modal) -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
          <form action="../model/insert_roles.php" method="POST">
            <!-- Encabezado del modal -->
            <div class="modal-header">
              <h4 class="modal-title text-center">Creando un nuevo rol</h4>
              
            </div>
    
            <!-- Contenido del modal (formulario) -->
            <div class="modal-body input-box">

                    <div class="col-md-4 input-field">
                          <input type="text" class="input" id="nombre_rol" name="nombre_rol" required="" autocomplete="off">
                          <label for="nombrerol">Nombre del rol</label> 
                    </div>

                    <div class="col-md-4 input-field">
                          <input type="text" class="input" id="des_rol" name="desc_rol" required="">
                          <label for="tiporol">Descripción del rol</label>
                    </div> 

                    <div class="col-md-4 input-field">
                          <input type="date" class="input" id="fecha_rol" name="fecha_rol" required="" autocomplete="off">
                          <label for="creadopor">Fecha de Creación</label> 
                    </div>

                    <!--div class="col-md-4 input-field">
                          <input type="text" class="input" id="creado_por" name="creado_por" required="">
                          <label for="asignadoha">Creado por</label>
                    </div>-->

            </div>
    
            <!-- Pie del modal -->  
            <div class="modal-footer">
              <div class="col-md-4 input-field">                        
                <input type="submit" class="submit" value="Crear rol">
              </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
    
          </div>
        </from>
        </div>
      </div>

    </div>


    <table class="table custom-table table-hover">
      <thead>
        <tr>
          <th scope="col" class="text-center">#</th>
          <th scope="col" class="text-center">Nombre de rol</th>
          <th scope="col" class="text-center">Descripción de rol</th>
          <th scope="col" class="text-center">Fecha creación</th>
          <th scope="col" class="text-center">Creado por</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <?php
          // Incluir el archivo de conexión a la base de datos
          include '../php/conexion.php';
          
          // Consulta SQL para obtener los roles
          $sql = "SELECT * FROM roles";
          $result = $conexion->query($sql);
          
          // Verificar si se encontraron resultados
          if ($result->num_rows > 0) {
              // Mostrar los roles en una tabla, por ejemplo
              while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<th ><input class='form-check-input' type='checkbox' id='checkboxNoLabel' value='" . $row["idrol"] . "' aria-label='...'> " . $row["idrol"] . "</th>";
                  echo "<th>" . $row["nombre_rol"] . "</th>";
                  echo "<th>" . $row["desc_rol"] . "</th>";
                  echo "<th>" . $row["fecha_rol"] . "</th>";
                  echo "<th>" . $row["creado_por"] . "</th>";
                  echo "</tr>";
              }
              echo "</table>";
          } else {
              echo "No se encontraron roles.";
          }
          
          // Cerrar la conexión
          $conexion->close();
          ?>
          
        </tr>
      </tbody> 
    </table>


    

  </div>

  
  


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
