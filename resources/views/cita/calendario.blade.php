@extends('adminlte::page')

<!-- @section('title', 'Calendario') -->

@section('content_header')
<h1>Reuniones</h1>
@stop


@section('css')

<link rel="stylesheet" href="{{ asset('fullcalendar/main.css') }}">

<style>
  .select2-container--default .select2-selection--multiple .select2-selection__choice {

    color: rgb(172, 30, 30) !important;

  }

  .fc-day-past {
    background-color: #e7e7e7;
  }

  .fc-day-today {
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

              <form id="frmRegistrarReunion" name="formulario">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputTitulo">Título</label>
                    <input type="text" class="form-control" id="inputTitulo" name="titulo" placeholder="Escriba el título de su reunión">
                  </div>

                </div>

                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label for="inputDescripcion">Descripción (Opcional)</label>
                    <textarea class="form-control" name="descripcion" id="inputDescripcion" rows="3"></textarea>
                  </div>

                </div>

                <div class="form-row">

                  <div class="form-group col-md-6">
                    <label for="inputFecha">Fecha</label>
                    <input type="date" name="fecha" id="inputFecha" class="form-control" readonly>
                  </div>

                  <div class="form-group col-md-3">
                    <label for="inputHoraInicio">Hora Inicio</label>
                    <input type="time" name="hora_inicio" id="inputHoraInicio" class="form-control">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="inputHoraFin">Hora Fin</label>
                    <input type="time" name="hora_fin" id="inputHoraFin" class="form-control">
                  </div>

                </div>

                <div class="form-row">
                  <div class="form-group col-12">
                    <label for="inputTipoReunion">Tipo reunión</label>
                    <select id="inputTipoReunion" class="form-control" name="tipocita">
                      <option value="presencial" selected>PRESENCIAL</option>
                      <option value="virtual">VIRTUAL</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputLinkZoom">Link Zoom (Opcional)</label>
                  <input type="text" class="form-control" id="inputLinkZoom" placeholder="Inserte el link de la reunión" name="link_reu">
                </div>

                <div class="form-row">
                  <div class="form-group col-12">
                    <label for="inputOficina">Oficina</label>
                    <select id="inputOficina" class="form-control" name="empresa_id">
                      <option value="" selected>Elegir...</option>

                      @foreach ($empresas as $e)
                      <option value="{{ $e->id }}">{{ $e->nombre }}
                        ({{ $e->direccion }})
                      </option>
                      @endforeach

                    </select>
                  </div>

                  <div class="form-group col-12">
                    <label for="inputOtraOficina">Otra Oficina (Opcional)</label>
                    <input type="text" name="lugarreu" id="inputOtraOficina" class="form-control">
                  </div>


                  <div class="form-group col-12">
                    <label for="inputAsistentes">Colaboradores que asistirán:</label>

                    <select style="width:100%" id="inputAsistentes" name="asistentes[]" multiple="multiple" lang="es">
                      @foreach ($colaboradores as $c)
                      <option value="{{ $c->id }}">{{ $c->nombres }}
                        {{ $c->apellidos }}
                      </option>
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
  var a = moment([11, 00, 00], "HH:mm:ss")

  var valor = 30;

  for (let i = valor; i <= 570; i += valor) {

    let valor2 = moment(a).add(i, 'm');
    let valor3 = valor2.format("HH:mm");


    if (valor3 == '13:00' || valor3 == '13:30') {

      $("#inputHoraInicio").append(`<option style="display: none;" value="${valor3}">almuerzo</option>`);

    } else {

      $("#inputHoraInicio").append(`<option value="${valor3}">${valor3}</option>`);
    }

  }


  $("#inputHoraInicio").change(function(e) {

    let valor = e.target.value;
    console.log(valor);

    var a = moment([08, 00, 00], "HH:mm:ss")

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


  $('#inputAsistentes').select2();

  function toggleDisabledInputLinkZoom() {
    if ($('#inputTipoReunion').find(":selected").val() === 'presencial') {
      inputLinkZoom.disabled = true;
    } else {
      inputLinkZoom.disabled = false;
    }
  }

  function toggleDisabledInputOtraOficina() {
    if ($('#inputOficina').find(":selected").val() === '') {
      inputOtraOficina.disabled = false;
    } else {
      inputOtraOficina.disabled = true;
    }
  }

  toggleDisabledInputLinkZoom();
  inputTipoReunion.addEventListener('change', function(e) {
    toggleDisabledInputLinkZoom();
  });

  toggleDisabledInputOtraOficina();
  inputOficina.addEventListener('change', function(e) {
    toggleDisabledInputOtraOficina();
  });

  frmRegistrarReunion.addEventListener('submit', function(e) {
    e.preventDefault();

    let dataArray = $('#frmRegistrarReunion').serializeArray()
    dataArray.push({
      name: '_token',
      value: token_
    })

    $.ajax({
      "method": 'POST',
      "url": 'cita',
      "data": dataArray,
      "success": function(Response) {
        console.log(Response);
      },
      'error': (response) => {
        console.log(response.responseJSON.messages);
      }
    })
  });

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

        // si el inicio de evento ocurre hoy o en el futuro mostramos el modal
        if (check >= hoy) {

          jQuery.noConflict();
          $('#citamodal').modal('show');

          inputFecha.value = check;
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
        //if (confirm('¿Está seguro(a) que desea eliminar esta reunión?')) {
        // arg.event.remove()
        //}
        console.log(arg);
        alert('a event has been clicked!');
      },
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      eventSources: [{
        url: 'cita/getForFullCalendar', // use the `url` property
        extraParams: {
          _token: token_
        },
        failure: function() {
          alert('there was an error while fetching events!');
        }
      }],
      eventSourceSuccess: function(content, xhr) {
        console.log(content);
        return content.data;
      }
    });

    calendar.render();
  });
</script>
@stop