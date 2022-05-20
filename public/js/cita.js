document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar')
  $('#inputAsistentes').select2()

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

      Utils.resetearFormulario(frmRegistrarReunion, ['#inputAsistentes'])
      document
        .querySelectorAll('.show-validation-message')
        .forEach((item) => (item.innerHTML = ''))

      toggleDisabledInputLinkZoom()
      toggleDisabledInputOtraOficina()

      document.querySelector('.modal-title').innerHTML = 'REGISTRAR REUNION'
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
      Utils.resetearFormulario(frmRegistrarReunion, ['#inputAsistentes'])
      document
        .querySelectorAll('.show-validation-message')
        .forEach((item) => (item.innerHTML = ''))

      console.log(arg.event.extendedProps)

      btnEliminar.style.display = 'inline-block'
      document.querySelector('.modal-title').innerHTML = 'EDITAR REUNION'
      action_form = 'editar'

      formGroupInputEstado.style.display = 'block'
      inputEstado.disabled = false

      inputId.value = arg.event.extendedProps.id
      inputTitulo.value = arg.event.extendedProps.titulo
      inputDescripcion.value = arg.event.extendedProps.descripcion
      inputFecha.value = Utils.getDateForDateInput(
        arg.event.extendedProps.fecha
      )
      inputHoraInicio.value =
        arg.event.extendedProps.hora_inicio.split(':')[0] +
        ':' +
        arg.event.extendedProps.hora_inicio.split(':')[1]
      inputHoraFin.value =
        arg.event.extendedProps.hora_fin.split(':')[0] +
        ':' +
        arg.event.extendedProps.hora_fin.split(':')[1]

      $('#inputTipoReunion').val(arg.event.extendedProps.tipo)

      toggleDisabledInputLinkZoom()

      if (arg.event.extendedProps.tipo !== 'presencial') {
        inputLinkZoom.value = arg.event.extendedProps.link
      }

      if (arg.event.extendedProps.empresa_id != null) {
        $('#inputOficina').val(arg.event.extendedProps.empresa_id)
      }

      toggleDisabledInputOtraOficina()

      if ($('#inputOficina').find(':selected').val() === '') {
        inputOtraOficina.value = arg.event.extendedProps.otra_oficina
      }

      $('#inputAsistentes').find('option').remove()
      arg.event.extendedProps.asistentes.forEach((item) => {
        Utils.establecerOpcionSelect2('#inputAsistentes', {
          id: item.id,
          text: `${item.nombres} ${item.apellidos}`,
        })
      })

      $('#inputEstado').val(arg.event.extendedProps.estado)

      $('#citamodal').modal('show')
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
      console.log(content)
      return content.data.map((res) => {
        return {
          id: res.id,
          start: res.fecha_inicio,
          end: res.fecha_fin,
          title: res.titulo,
          color:
            res.asistentes.find((elem) => elem.id == ID_USUARIO_LOGUEADO) ||
            res.id_registrado_por == ID_USUARIO_LOGUEADO
              ? 'red'
              : 'lighblue',
          display: 'block',
          extendedProps: {
            id: res.id,
            titulo: res.titulo,
            descripcion: res.descripcion,
            fecha: res.fecha,
            fecha_inicio: res.fecha_inicio,
            fecha_fin: res.fecha_fin,
            hora_inicio: res.hora_inicio,
            hora_fin: res.hora_fin,
            tipo: res.tipo,
            link: res.link,
            empresa_id: res.empresa_id,
            descripcion_empresa: res.descripcion_empresa,
            otra_oficina: res.otra_oficina,
            estado: res.estado,
            asistentes: res.asistentes,
          },
        }
      })
    },
  })

  calendar.render()

  let action_form = 'registrar'

  function toggleDisabledInputLinkZoom() {
    if ($('#inputTipoReunion').find(':selected').val() === 'presencial') {
      inputLinkZoom.disabled = true
      inputLinkZoom.value = ''
      formGroupLinkZoom.style.display = 'none'
    } else {
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

    let dataArray = $('#frmRegistrarReunion').serializeArray()
    dataArray.push({
      name: '_token',
      value: token_,
    })

    if (action_form === 'registrar') {
      $.ajax({
        method: 'POST',
        url: 'cita',
        data: dataArray,
        success: function (Response) {
          console.log(Response)
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Datos guardados correctamente',
            showConfirmButton: false,
            timer: 1500,
          })
          calendar.refetchEvents()
          Utils.resetearFormulario(frmRegistrarReunion, ['#inputAsistentes'])
          $('#citamodal').modal('hide')
        },
        error: (response) => {
          console.log(response)
          if (response.status === 403) {
            alert('Usted no esta autorizado para registrar reuniones.')
          } else {
            console.log(response.responseJSON.errors)
            Utils.showValidationMessages(response.responseJSON.errors)
          }
        },
      })
    } else {
      $.ajax({
        method: 'PUT',
        url: `cita/${inputId.value}`,
        data: dataArray,
        success: function (Response) {
          console.log(Response)
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Datos actualizados correctamente',
            showConfirmButton: false,
            timer: 1500,
          })
          calendar.refetchEvents()
          Utils.resetearFormulario(frmRegistrarReunion, ['#inputAsistentes'])
          $('#inputAsistentes').val(null).trigger('change')
          $('#citamodal').modal('hide')
        },
        error: (response) => {
          if (response.status === 403) {
            alert('Usted no esta autorizado para editar reuniones.')
          } else {
            console.log(response.responseJSON.errors)
            Utils.showValidationMessages(response.responseJSON.errors)
          }
        },
      })
    }
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
