@extends('adminlte::page')

<!-- @section('title', 'Calendario') -->

@section('content_header')
    <h1>Reuniones</h1>
@stop


@section('css')

<link rel="stylesheet" href="{{ asset('fullcalendar/main.css') }}">

<style>

.select2-container--default .select2-selection--multiple .select2-selection__choice{

    color: rgb(27, 25, 25) !important;

}

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

{{-- modal  --}}

<div class="modal" id="citamodal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
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
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Hora inicio</label>
                  <input type="time" class="form-control" id="" value="08:30:00"  min="08:30:00" max="18:00:00" step="1" name="titulo">
                </div>

                <div class="form-group col-md-4">
                    <label for="inputEmail4">Duración</label>

                    <select id="inputState" class="form-control">
                        <option selected>Elegir...</option>
                        <option>...</option>
                      </select>
                  </div>

                  <div class="form-group col-md-4">
                    <label for="inputState">Tipo reunión</label>
                    <select id="inputState" class="form-control">
                      <option selected>Elegir...</option>
                      @foreach ($tipos as $t)
                      <option value="{{ $t->id }}">{{$t->nombre}}</option>
                    @endforeach
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

<script>


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
        select: function(arg) {

          console.log(arg);

          jQuery.noConflict();
          $('#citamodal').modal('show');

          calendar.unselect()
        },
        eventClick: function(arg) {
          if (confirm('Are you sure you want to delete this event?')) {
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























