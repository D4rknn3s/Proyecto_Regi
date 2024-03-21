
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='utf-8' />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.11/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.11/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.11/index.global.min.js"></script>  
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/calendario.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale:'es',
          editable: true,
         selectable: true,
         alldaySlot: false,
          events: 'php/calendario_servicio.php',

          dateClick: function(info) {
          var a = info.dateStr;
          const fecha =a;
          var numeroDia =new Date(fecha).getDay();
          var dias =['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
          $('#modal_reservar').modal("show");
          $('#Diasemana').html(dias[numeroDia] + " " + a) ;
  },

        });
        
        calendar.render();
      });
    </script>

  </head>
  <br>
  <body class="justify-content-center align-item-center" >
    <div class="container">
   <div class="row">
    <div class="col"></div>
    <div class="col-7"><div id='calendar'></div></div>
    <div class="col"></div>
   </div>
</div>

<script>
    $(document).ready(fuction() {
        $('calendar').FullCalendar();
    });

</script>

<!-- Modal -->
<div class="modal fade" id="modal_reservar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> Servicios </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <p> Desea Agregar Un servicios El Dia <spna id="Diasemana" >  </spna> ? </p>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button id="btn_acep" type="button" class="btn btn-primary" data-bs-dismiss="modal" >Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script>
$('#btn_acep').click(function () {
  $('#modal_formulario').modal("show");
});
</script>

<!-- Modal Formulario-->
<div class="modal fade" id="modal_formulario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Servicio <spna id="Diasemana" ></spna> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
         <form action="">
         <div class="row">
         <div class="col-md-6">
          <label for="">Nombre del Servicio</label>
          <input type="text" class="form-control"  >
         </div>
         <div class="col-md-6"></div>
         <label for="">Descripción</label>
          <input type="text" class="form-control">
         </div>
         </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>









<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>