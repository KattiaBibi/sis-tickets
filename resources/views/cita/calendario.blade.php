@extends('adminlte::page')

<!-- @section('title', 'Calendario') -->

@section('content_header')
    <h1>Reuniones</h1>
@stop


@section('css')

<link rel="stylesheet" href="{{ asset('fullcalendar/main.css') }}">


<style>

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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">AGENDAR REUNIÓN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Registre su reunión</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm">Guardar</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
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























