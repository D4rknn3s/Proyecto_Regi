
<?php 

include "../php/conexion2.php";

if($_POST){
   //Almacenacion de datos o recepcion
   $nombre=(isset($_POST['nombreservicio'])) ? $_POST['nombreservicio'] :"";
   $descripcion=(isset($_POST['descripcion'])) ? $_POST['descripcion'] :"";
   $costoservicio=(isset($_POST['costoservicio'])) ? $_POST['costoservicio'] :"";
   $iniciar=(isset($_POST['iniciar'])) ? $_POST['iniciar'] :"";
   $final=(isset($_POST['final'])) ? $_POST['final'] :"";
   $creacion=(isset($_POST['creacion'])) ? $_POST['creacion'] :"";
     
   $sentencia=$conexion->prepare("INSERT INTO `servicios` (`idservicio`, `nombre_servicio`, `desc_servicio`, `cost_servicio`, `fech_inicio`, `fech_final`, `actualizado_por`) 
   VALUES (NULL, :nombreservicio, :descripcion, :costoservicio , :iniciar, :final, :creacion);");
   

  $sentencia->bindParam(  ":nombreservicio",$nombre  );
  $sentencia->bindParam(":descripcion",$descripcion );
  $sentencia->bindParam(":costoservicio",$costoservicio );
  $sentencia->bindParam(":iniciar",$iniciar);
$sentencia->bindParam(":final",$final);
$sentencia->bindParam(":creacion",$creacion);
   $sentencia->execute();
   $mensaje="Registro Agregado Exitosamente";
   header("location:index.php?mensaje= ".$mensaje);
    
  
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="card">
    <div class="card-header">
       <h3> Crear Servicio </h3>
    </div>
    <div class="card-body">
      <form action="" enctype="multipart/form-data" method="post">
       
      <div class="mb-3">
            <label for="nombreservicio" class="form-label">Nombre del servicio</label>
            <input
                type="text"
                class="form-control"
                name="nombreservicio"
                id="nombreservicio"
                aria-describedby="helpId"
                placeholder=" Escriba el nombre del servicio "  />
        </div>
        
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input
                type="text"
                class="form-control"
                name="descripcion"
                id="descripcion"
                aria-describedby="helpId"
                placeholder=" Escriba una breve descripción "  />
        </div>
        
        <div class="mb-3">
            <label for="costoservicio" class="form-label">Costo</label>
            <input
                type="numeric"
                class="form-control"
                name="costoservicio"
                id="costoservicio"
                aria-describedby="helpId"
                placeholder=" Escriba el precio a pagar "  />
        </div>
      
        <div class="mb-3">
            <label for="iniciar" class="form-label">Iniciar Pago</label>
            <input
                type="date"
                class="form-control"
                name="iniciar"
                id="iniciar"
                aria-describedby="helpId"  />
        </div>





        <div class="mb-3">
            <label for="final" class="form-label">Fecha final</label>
            <input
                type="date"
                class="form-control"
                name="final"
                id="final"
                aria-describedby="helpId"  />
        </div>
   
        <div class="mb-3">
            <label for="creacion" class="form-label">Creado por:</label>
            <input
                type="text"
                class="form-control"
                name="  creacion"
                id="creacion"
                aria-describedby="helpId"
                placeholder="Escriba su nombre de usuario "  />
        </div>
       <button
        type="submit"
        class="btn btn-success"
       >
        Agregar
       </button>
       
      <a
        name=""
        id=""
        class="btn btn-primary"
        href="index.php"
        role="button"
        >Cancelar</a
      >

      </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



