@extends('adminlte::page')

<!-- @section('title', 'Calendario') -->

@section('content_header')
    <h1>Reuniones</h1>
@stop


@section('css')

<link rel="stylesheet" href="{{ asset('fullcalendar/main.css') }}">

<style>

.select2-container--default .select2-selection--multiple .select2-selection__choice{

    color: rgb(172, 30, 30) !important;

}

    .fc-day-past {
        background-color: #e7e7e7;
    }

    .fc-day-today{
      background-color: #cbf8f4 !important;
    }

    /* .fc-day-future{
        background-color: #ccfafd;
    }
     */

    body {
      margin: 40px 10px;
      padding: 0;
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }

    #calendar {
      max-width: 1100px;
      margin: 0 auto;
    }

  </style>

@stop


@section('content')


<div class="card">
  <div class="card-header">
  <h1 class="card-title">Calendario</h1>
  </div>
  <div class="card-body">
    {{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}


<div class="container">

{{-- modal   modal-lg --}}

<div class="modal" id="citamodal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">AGENDAR REUNIÓN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <form action="" name="formulario">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail4">Título</label>
                <input type="text" class="form-control" id="" name="titulo" placeholder="Escriba el título de su reunión">
              </div>

            </div>

             <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputEmail4">Descripción (Opcional)</label>

                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Hora inicio</label>

                  <select id="horainicio" class="form-control">
                  </select>

                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4">Duración</label>

                    <select id="duracion" class="form-control">
                        <option selected>Elegir...</option>
                      </select>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="inputState">Tipo reunión</label>
                    <select id="inputState" class="form-control">
                      <option selected>Elegir...</option>

                    <option value=""></option>
                    <option value=""></option>
                    <option value=""></option>
                    </select>
                  </div>

              </div>


            <div class="form-group">
              <label for="inputAddress">Link zoom</label>
              <input type="text" class="form-control" id="inputAddress" placeholder="Inserte el link de la reunión">
            </div>

            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="inputState">Oficina</label>
                <select id="inputState" class="form-control">
                  <option selected>Elegir...</option>

                @foreach ($empresas as $e)
                <option value="{{ $e->id }}">{{$e->nombre}} - {{$e->direccion}}</option>
              @endforeach

                </select>
              </div>


              <div class="form-group col-md-9">

                <label for="inputState">Colaboradores que asistirán:</label>


                <select style="width:100%" class="js-example-basic-multiple" name="states[]"multiple="multiple" lang="es">
                  @foreach ($colaboradores as $c)
                  <option value="{{ $e->id }}">{{$c->nombres}} {{$c->apellidos}}</option>
                @endforeach
              </select>


              </div>



            </div>



            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
              </div>

          </form>

      </div>

    </div>
  </div>
</div>

{{-- modal cerrar --}}

    <div class="response">

   <div id='calendar'></div>


    </div>

    </div>


  </div>
</div>


@stop

@section('js')

<script src="{{ asset('fullcalendar/main.js') }}"></script>
<script src="{{ asset('fullcalendar/locales/es.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha512-rmZcZsyhe0/MAjquhTgiUcb4d9knaFc7b5xAfju483gbEXTkeJRUMIPk6s3ySZMYUHEcjKbjLjyddGWMrNEvZg==" crossorigin="anonymous"></script>


<script>

var a = moment([11,00,00], "HH:mm:ss")

var valor=30;

 for (let i = valor; i <= 570; i += valor) {

  let valor2=moment(a).add(i, 'm');
  let valor3=valor2.format("HH:mm");


 if(valor3=='13:00' || valor3=='13:30'){

      $("#horainicio").append(`<option style="display: none;" value="${valor3}">almuerzo</option>`);

}

else{

   $("#horainicio").append(`<option value="${valor3}">${valor3}</option>`);
}

}


 $("#horainicio").change(function(e){

  let valor=e.target.value;
    console.log(valor);

    var a = moment([08,00,00], "HH:mm:ss")

    $("#duracion").append(`<option value="${valor}">${valor}</option>`);

});


// for (let i = 1; i < 9; i += 1) {

//   if(i==1){
//      $("#duracion").append(`<option value="${i}">${i} hora</option>`);
//   }

//   if(i==8){
//      $("#duracion").append(`<option value="${i}">Toda la jornada</option>`);
//   }

//   else{
//     $("#duracion").append(`<option value="${i}">${i} horas</option>`);
//   }
// }


  $('.js-example-basic-multiple').select2();


    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,


        select: function(start, end) {

      // leemos las fechas de inicio de evento y hoy
      var check = moment(start.start).format('YYYY-MM-DD');
      var hoy = moment(new Date()).format('YYYY-MM-DD');

      console.log(check);
      console.log(hoy);

      // si el inicio de evento ocurre hoy o en el futuro mostramos el modal
      if (check >= hoy) {

        jQuery.noConflict();
          $('#citamodal').modal('show');

          calendar.unselect()

      }
      // si no, mostramos una alerta de error
      else {

        Swal.fire({
          position: 'top-center',
          icon: 'info',
          title: '¡No se pueden crear eventos en el pasado!',
          showConfirmButton: false,
          timer: 1500
        })


          calendar.unselect()

      }
      },

        eventClick: function(arg) {
          if (confirm('¿Está seguro(a) que desea eliminar esta reunión?')) {
            arg.event.remove()
          }
        },
        editable: true,
        dayMaxEvents: true, // allow "more" link when too many events
        events: [

          {
            title: 'Conference',
            start: '2020-09-11',
            end: '2020-09-13'
          },

        ]
      });

      calendar.render();
    });

  </script>
@stop























