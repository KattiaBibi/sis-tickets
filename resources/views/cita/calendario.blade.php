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
        initialDate: '2020-09-12',
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        selectMirror: true,
        select: function(arg) {
          var title = prompt('Event Title:');
          if (title) {
            calendar.addEvent({
              title: title,
              start: arg.start,
              end: arg.end,
              allDay: arg.allDay
            })
          }
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
            title: 'All Day Event',
            start: '2020-09-01'
          },
          {
            title: 'Long Event',
            start: '2020-09-07',
            end: '2020-09-10'
          },
          {
            groupId: 999,
            title: 'Repeating Event',
            start: '2020-09-09T16:00:00'
          },
          {
            groupId: 999,
            title: 'Repeating Event',
            start: '2020-09-16T16:00:00'
          },
          {
            title: 'Conference',
            start: '2020-09-11',
            end: '2020-09-13'
          },
          {
            title: 'Meeting',
            start: '2020-09-12T10:30:00',
            end: '2020-09-12T12:30:00'
          },
          {
            title: 'Lunch',
            start: '2020-09-12T12:00:00'
          },
          {
            title: 'Meeting',
            start: '2020-09-12T14:30:00'
          },
          {
            title: 'Happy Hour',
            start: '2020-09-12T17:30:00'
          },
          {
            title: 'Dinner',
            start: '2020-09-12T20:00:00'
          },
          {
            title: 'Birthday Party',
            start: '2020-09-13T07:00:00'
          },
          {
            title: 'Click for Google',
            url: 'http://google.com/',
            start: '2020-09-28'
          }
        ]
      });

      calendar.render();
    });

  </script>
@stop























