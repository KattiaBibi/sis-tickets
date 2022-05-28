document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar')
  $('#inputAsistentes').select2()

  $('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 15,
    zindex: 9999,
  })

  var calendar = new FullCalendar.Calendar(calendarEl, {
    selectable: true,
    longPressDelay: 1,
    locale: 'es',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay',
    },
    navLinks: true,
    selectable: true,
    selectMirror: true,
    select: function (start, end) {
      action_form = 'registrar'
      confirmacionesAcordion.style.display = 'none'

      Utils.resetForm('#frmRegistrarReunion', ['#inputAsistentes'])
      document
        .querySelectorAll('.show-validation-message')
        .forEach((item) => (item.innerHTML = ''))
      inputId.value = ''

      toggleDisabledInputLinkZoom()
      toggleDisabledInputOtraOficina()

      document.querySelector('.modal-title').innerHTML = 'REGISTRAR REUNIÓN'
      action_form = 'registrar'
      btnEliminar.style.display = 'none'

      formGroupInputEstado.style.display = 'none'
      inputEstado.disabled = true

      var check = moment(start.start).format('YYYY-MM-DD')
      var hoy = moment(new Date()).format('YYYY-MM-DD')

      if (check >= hoy) {
        $('#citamodal').modal('show')
        inputFecha.value = check
        calendar.unselect()
      } else {
        Swal.fire({
          position: 'top-center',
          icon: 'info',
          title: '¡No se pueden crear eventos en el pasado!',
          showConfirmButton: false,
          timer: 1500,
        })

        calendar.unselect()
      }
    },
    eventClick: function (arg) {
      Utils.resetForm('#frmRegistrarReunion', ['#inputAsistentes'])
      document
        .querySelectorAll('.show-validation-message')
        .forEach((item) => (item.innerHTML = ''))

      axios
        .get(`cita/${arg.event.id}`)
        .then(function (response) {
          let data = response.data.data
          console.log(data)

          btnEliminar.style.display = 'inline-block'
          document.querySelector('.modal-title').innerHTML = 'EDITAR REUNION'
          action_form = 'editar'

          formGroupInputEstado.style.display = 'block'
          inputEstado.disabled = false

          inputId.value = data.id
          inputTitulo.value = data.titulo
          inputDescripcion.value = data.descripcion
          inputFecha.value = Utils.getDateForDateInput(data.fecha)
          inputHoraInicio.value = moment(data.hora_inicio, ['HH:mm']).format(
            'h:mm A'
          )
          inputHoraFin.value = moment(data.hora_fin, ['HH:mm']).format('h:mm A')

          $('#inputTipoReunion').val(data.tipo)

          toggleDisabledInputLinkZoom()

          if (data.tipo !== 'presencial') {
            inputLinkZoom.value = data.link
          }

          if (data.empresa_id != null) {
            $('#inputOficina').val(data.empresa_id)
          }

          toggleDisabledInputOtraOficina()

          if ($('#inputOficina').find(':selected').val() === '') {
            inputOtraOficina.value = data.otra_oficina
          }

          $('#inputAsistentes').find('option').remove()
          data.asistentes.forEach((item) => {
            Utils.establecerOpcionSelect2('#inputAsistentes', {
              id: item.id,
              text: `${item.nombres} ${item.apellidos}`,
            })
          })

          confirmacionesAcordion.style.display = 'block'

          renderConfirmaciones(data.asistentes)

          $('#inputEstado').val(data.estado)

          $('#citamodal').modal('show')
        })
        .catch(function (error) {
          console.log(error)
        })
        .then(function () {})
    },
    eventTimeFormat: {
      hour: 'numeric',
      minute: '2-digit',
      hour12: true,
    },
    editable: true,
    dayMaxEvents: true,
    eventSources: [
      {
        url: 'cita/getForFullCalendar',
        extraParams: function () {
          return {
            _token: token_,
            estado: $('#inputFiltroEstado').val(),
          }
        },
        failure: function () {
          alert('Ocurrio un error al conectarse con el servidor!')
        },
      },
    ],
    eventSourceSuccess: function (content, xhr) {
      return content.data.map((res) => {
        return {
          id: res.id,
          start: res.fecha_inicio,
          end: res.fecha_fin,
          title: res.titulo,
          color: res.asistentes.find((elem) => elem.id == ID_USUARIO_LOGUEADO)
            ? 'red'
            : 'lighblue',
          display: 'block',
        }
      })
    },
  })

  calendar.render()

  let action_form = 'registrar'

  function renderConfirmaciones(asistentes) {
    let ul = '<ul style="font-size: 12px; line-height: 0.9;">'

    ul += asistentes.map((asistente) => {
      let nom_ape = `${asistente.nombres} ${asistente.apellidos}`
      let rpta = null

      if (asistente.confirmation === 1) {
        rpta = 'SI'
      } else if (asistente.confirmation === 0) {
        rpta = 'NO'
      }

      let li =
        asistente.confirmation != null
          ? `<li>${nom_ape} (${rpta}) (${asistente.confirmation_at})</li>`
          : `<li>${nom_ape} (<a href='#'>reenviar</a>)</li>`

      return li;
    })

    ul += '</ul>'

    showConfirmacionAsistentes.innerHTML = ul
  }

  function toggleDisabledInputLinkZoom() {
    if ($('#inputTipoReunion').find(':selected').val() === 'presencial') {
      inputLinkZoom.disabled = true
      inputLinkZoom.value = ''
      formGroupLinkZoom.style.display = 'none'

      inputOficina.disabled = false
      formGroupOficina.style.display = 'block'

      inputOtraOficina.disabled = false
      formGroupOtraOficina.style.display = 'block'

      toggleDisabledInputOtraOficina()
    } else {
      inputOficina.disabled = true
      formGroupOficina.style.display = 'none'

      inputOtraOficina.disabled = true
      inputOtraOficina.value = ''
      formGroupOtraOficina.style.display = 'none'

      inputLinkZoom.disabled = false
      formGroupLinkZoom.style.display = 'block'
    }
  }

  function toggleDisabledInputOtraOficina() {
    if ($('#inputOficina').find(':selected').val() === '') {
      inputOtraOficina.disabled = false
      formGroupOtraOficina.style.display = 'block'
    } else {
      inputOtraOficina.disabled = true
      inputOtraOficina.value = ''
      formGroupOtraOficina.style.display = 'none'
    }
  }

  inputTipoReunion.addEventListener('change', function (e) {
    toggleDisabledInputLinkZoom()
  })

  inputOficina.addEventListener('change', function (e) {
    toggleDisabledInputOtraOficina()
  })

  frmRegistrarReunion.addEventListener('submit', function (e) {
    e.preventDefault()

    btnGuardar.disabled = true
    document.querySelector('.loader.btnGuardar').style.display = 'inline-block'

    let data = new FormData(this)
    data.append('_token', token_)

    data.append(
      'hora_inicio',
      moment(inputHoraInicio.value, ['h:mm A']).format('HH:mm')
    )
    data.append(
      'hora_fin',
      moment(inputHoraFin.value, ['h:mm A']).format('HH:mm')
    )

    let url = action_form === 'registrar' ? 'cita' : `cita/${inputId.value}`
    if (action_form === 'editar') data.append('_method', 'PUT')

    axios
      .post(url, data)
      .then(function (response) {
        calendar.refetchEvents()
        Utils.resetForm('#frmRegistrarReunion', ['#inputAsistentes'])
        $('#citamodal').modal('hide')
      })
      .catch(function (error) {
        console.log(error)
        if (error.response) {
          if (error.response.status === 422) {
            Utils.showValidationMessages(
              '#frmRegistrarReunion',
              error.response.data.errors
            )
          } else if (error.response.status === 403) {
            alertify.error(
              'No esta autorizado para registrar o editar reuniones.'
            )
          }
        }
      })
      .then(function () {
        btnGuardar.disabled = false
        document.querySelector('.loader.btnGuardar').style.display = 'none'
      })
  })

  btnEliminar.addEventListener('click', function (e) {
    e.preventDefault()
    Swal.fire({
      title: '¿Estás seguro(a)?',
      text: '¡No podrás revertir esto!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: '¡Sí!',
      cancelButtonText: 'Cancelar',
    }).then((result) => {
      if (result.isConfirmed) {
        console.log(inputId.value)

        let dataArray = {
          _token: token_,
        }

        $.ajax({
          method: 'DELETE',
          url: `cita/${inputId.value}`,
          data: dataArray,
          success: function (Response) {
            console.log(Response)
            $('#citamodal').modal('hide')
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Datos Eliminados correctamente',
              showConfirmButton: false,
              timer: 1500,
            })
            calendar.refetchEvents()
          },
          error: (response) => {
            if (response.status === 403) {
              alert('Usted no esta autorizado para eliminar reuniones.')
            }
          },
        })
      }
    })
  })

  inputFiltroEstado.addEventListener('change', (e) => {
    calendar.refetchEvents()
  })

  btnReloadConfirmaciones.addEventListener('click', function (e) {
    e.preventDefault()

    $('#confirmacionesCollapse').collapse('show')

    showConfirmacionAsistentes.innerHTML =
      '<img src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" class="loader btnGuardar" style="width: 18px;display: block;margin: 0 auto;margin-bottom: 13px;">'

    axios
      .get(`cita/${inputId.value}`)
      .then(function (response) {
        renderConfirmaciones(response.data.data.asistentes)
      })
      .catch(function (error) {
        console.log(error)
      })
  })

  search('#inputAsistentes', function () {
    return {
      role_id: $('#inputFiltroRolColaboradores').val(),
    }
  })

  function search(control, _filters = null) {
    return $(`${control}`).select2({
      width: '100%',
      placeholder: 'Buscar',
      allowClear: true,
      ajax: {
        url: `colaboradores/search`,
        dataType: 'json',
        type: 'get',
        delay: 250,
        data: function (params) {
          let query = {
            search: params.term,
            page: params.page || 1,
            filters: _filters(),
          }

          return query
        },
        processResults: function (data, params) {
          return {
            results: data.results,
            pagination: data.pagination,
          }
        },
        cache: true,
      },
    })
  }
})
