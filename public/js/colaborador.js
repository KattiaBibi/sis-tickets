/* ACA LA USO PARA HACER EL POST Y TRAER LA DATA AHORA SI ME ENTIUENDES ? */
var datatable
function listar() {
  datatable = $('#colaboradores').DataTable({
    pageLength: 25,
    destroy: true,
    async: false,
    responsive: true,
    autoWidth: false,
    dom: 'Bfrtip',
    lengthChange: false,

    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json',
    },

    buttons: [
      {
        extend: 'copy',
        text: 'Copiar',
      },

      {
        extend: 'colvis',
        text: 'Visibilidad',
      },

      'excel',
      'pdf',
    ],

    columnDefs: [
      {
        searchable: false,
        orderable: false,
        targets: 0,
      },
    ],

    ajax: {
      url: '/datatable/colaboradores',
      method: 'get',
    },

    columns: [
      {
        data: 'estado',
        render: function (data) {
          if (data == '1') {
            return "<button type='button'  id='ButtonDesactivar' class='desactivar text-truncate edit-modal btn btn-sm btn-danger botonDesactivar'><span class='fa fa-edit'></span><span class='hidden-xs'>Desactivar</span></button>"
          }

          if (data == '0') {
            return "<button type='button'  id='ButtonActivar' class='desactivar text-truncate edit-modal btn-sm btn btn-info botonActivar'><span class='fa fa-edit'></span><span class='hidden-xs'>Activar</span></button>"
          }
        },
      },

      {
        data: null,
        render: function (data) {
          return "<button type='button'  id='ButtonEditar'  class='editar btn-sm text-truncate edit-modal btn btn-warning botonEditar'><span class='fa fa-edit'></span><span class='hidden-xs'> Editar</span></button>"
        },
      },
      { data: 'nrodocumento' },
      { data: 'nombres' },
      { data: 'apellidos' },
      { data: 'fechanacimiento' },
      { data: 'direccion' },
      { data: 'telefono' },
      {
        data: 'empresas',
        render: function (data, type, row, meta) {
          return data.reduce(
            (acumulador, valorActual) =>
              acumulador + valorActual.nombre_empresa_area + ', ',
            ''
          )
        },
      },
    ],
  })
}

// MULTIEMPRESA
const DATATABLE_MULTIEMPRESA = $('#tablaMultiempresa').DataTable({
  ordering: false,
  paging: false,
  searching: false,
  info: false,
  language: {
    url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json',
  },
  columns: [
    {
      data: 'id',
      visible: false,
    },
    {
      data: 'empresa_area',
    },
    {
      data: 'correo',
    },
    {
      defaultContent: `
      <td style="text-align: center;" class="text-truncate">
        <button class="btn btn-sm btn-editar-item" style="color: #007BE8;">
          <i class="fas fa-edit"></i>
        </button>
        <button class="btn btn-sm btn-eliminar-item" style="color: #9E0F20;">
          <i class="fas fa-trash-alt"></i>
        </button>
      </td>`,
    },
  ],
})

$('#colaboradores').on('click', '.editar', function () {
  COLABORADOR_FORM_ACTION = 'UPDATE'
  modalColaboradorLabel.textContent = 'EDITAR'

  var data = datatable.row($(this).parents('tr')).data()
  if (datatable.row(this).child.isShown()) {
    var data = datatable.row(this).data()
  }

  $('#inputIdColaborador').val(data['id'])
  $('#inputNrodoc').val(data['nrodocumento'])
  $('#inputNombre').val(data['nombres'])
  $('#inputApellido').val(data['apellidos'])
  $('#inputFechanac').val(data['fechanacimiento'])
  $('#inputDireccion').val(data['direccion'])
  $('#inputTelefono').val(data['telefono'])

  data.empresas.forEach((element) => {
    DATATABLE_MULTIEMPRESA.row
      .add({
        id: element.id,
        empresa_area: element.nombre_empresa_area,
        correo: element.correo_corporativo,
        id_empresa_area: element.id_empresa_area,
      })
      .draw()
  })

  $('#modalColaborador').modal('show')
})

let MULTIEMPRESA_FORM_ACTION = 'STORE'
let COLABORADOR_FORM_ACTION = 'STORE'
let DATATABLE_MULTIEMPRESA_ROW_EDIT = null

btnNuevoMultiempresa.addEventListener('click', function (e) {
  e.preventDefault()
  MULTIEMPRESA_FORM_ACTION = 'STORE'
  collapseMultiempresaLabel.textContent = 'AÑADIR'
  btnSendFrmMultiempresaText.textContent = 'Añadir'
  $('#collapseFrmMultiempresa').collapse('show')
})

$('#tablaMultiempresa tbody').on('click', '.btn-editar-item', function (e) {
  e.preventDefault()
  let data = Utils.obtenerFilaSeleccionada(DATATABLE_MULTIEMPRESA, this)
  console.log(data)

  DATATABLE_MULTIEMPRESA_ROW_EDIT = $(this).closest('tr')
  MULTIEMPRESA_FORM_ACTION = 'UPDATE'
  collapseMultiempresaLabel.textContent = 'EDITAR'
  btnSendFrmMultiempresaText.textContent = 'Editar'

  $('#inputIdMultiEmpresa').val(data.id)
  $('#inputEmpresaAreaMultiempresa').val(data.id_empresa_area)
  $('#inputCorreoMultiempresa').val(data.correo)

  $('#collapseFrmMultiempresa').collapse('show')
})

$('#tablaMultiempresa tbody').on('click', '.btn-eliminar-item', function (e) {
  e.preventDefault()
  let data = Utils.obtenerFilaSeleccionada(DATATABLE_MULTIEMPRESA, this)
  console.log(data)
  DATATABLE_MULTIEMPRESA.row($(this).parents('tr')).remove().draw()
})

function validateFrmMultiempresa() {
  let messages = {}
  let isValid = true

  if ($('#inputEmpresaAreaMultiempresa option:selected').val() == '') {
    messages.empresa_area = 'El campo Empresa/Area es requerido.'
    isValid = false
  }

  if ($('#inputCorreoMultiempresa').val() == '') {
    messages.correo = 'El campo Correo es requerido.'
    isValid = false
  }

  if (!isValid) {
    return {
      isOk: false,
      messages: messages,
    }
  }

  return {
    isOk: true,
    messages: messages,
  }
}

function checkEmpresaAreaExists(id_empresa_area) {
  if (
    DATATABLE_MULTIEMPRESA.rows()
      .data()
      .filter((item) => item.id_empresa_area == id_empresa_area).length > 0
  ) {
    return true
  }

  return false
}

function checkCorreoExists(correo) {
  if (
    DATATABLE_MULTIEMPRESA.rows()
      .data()
      .filter((item) => item.correo == correo).length > 0
  ) {
    return true
  }

  return false
}

frmMultiempresa.addEventListener('submit', function (e) {
  e.preventDefault()

  let empresaArea = $('#inputEmpresaAreaMultiempresa option:selected').val()
  let correo = $('#inputCorreoMultiempresa').val()

  let validation = validateFrmMultiempresa();

  if (!validation.isOk) {
    Utils.showValidationMessages(
      '#frmMultiempresaContainer',
      validation.messages
    )
  } else if (
    checkEmpresaAreaExists(empresaArea) &&
    MULTIEMPRESA_FORM_ACTION === 'STORE'
  ) {
    alertify.warning('La Empresa/Area ya fue añadida.')
  } else if (
    checkCorreoExists(correo) &&
    MULTIEMPRESA_FORM_ACTION === 'STORE'
  ) {
    alertify.warning('El correo ya fue añadido.')
  } else {
    if (MULTIEMPRESA_FORM_ACTION == 'STORE') {
      DATATABLE_MULTIEMPRESA.row
        .add({
          id: '',
          empresa_area: $(
            '#inputEmpresaAreaMultiempresa option:selected'
          ).text(),
          correo: inputCorreoMultiempresa.value,
          id_empresa_area: $(
            '#inputEmpresaAreaMultiempresa option:selected'
          ).val(),
        })
        .draw()
      frmMultiempresa.reset()
    } else {
      DATATABLE_MULTIEMPRESA.row(DATATABLE_MULTIEMPRESA_ROW_EDIT)
        .data({
          id: inputIdMultiEmpresa.value,
          empresa_area: $(
            '#inputEmpresaAreaMultiempresa option:selected'
          ).text(),
          correo: inputCorreoMultiempresa.value,
          id_empresa_area: $(
            '#inputEmpresaAreaMultiempresa option:selected'
          ).val(),
        })
        .draw()
      frmMultiempresa.reset()
    }
    Utils.cleanValidationMessages('#frmMultiempresaContainer')
  }

  MULTIEMPRESA_FORM_ACTION = 'STORE'
  collapseMultiempresaLabel.textContent = 'AÑADIR'
  btnSendFrmMultiempresaText.textContent = 'Añadir'
})

$('#modalColaborador').on('hidden.bs.modal', function (event) {
  frmColaborador.reset()
  Utils.cleanValidationMessages('#frmColaborador')
  frmMultiempresa.reset()
  Utils.cleanValidationMessages('#frmMultiempresaContainer')
  DATATABLE_MULTIEMPRESA.clear().draw()
})

$('#collapseFrmMultiempresa').on('hidden.bs.collapse', function (event) {
  frmMultiempresa.reset()
  Utils.cleanValidationMessages('#frmMultiempresaContainer')
})

btnAgregarColaborador.addEventListener('click', function (e) {
  COLABORADOR_FORM_ACTION = 'STORE'
  modalColaboradorLabel.textContent = 'REGISTRAR'
})

frmColaborador.addEventListener('submit', function (e) {
  e.preventDefault()
  btnSendFrmColaborador.disabled = true
  loaderBtnSendFrmColaborador.style.display = 'inline-block'

  let data = new FormData(this)
  data.append('_token', token_)

  let i = 0
  DATATABLE_MULTIEMPRESA.data().each(function (item) {
    data.append(`empresas[${i}][id]`, item.id)
    data.append(`empresas[${i}][id_empresa_area]`, item.id_empresa_area)
    data.append(`empresas[${i}][correo]`, item.correo)
    i++
  })

  let url = 'colaborador'

  if (COLABORADOR_FORM_ACTION == 'UPDATE') {
    url = `colaborador/${inputIdColaborador.value}`
    data.append('_method', 'PUT')
  }

  axios
    .request({
      method: 'post',
      url: url,
      data: data,
    })
    .then((response) => {
      console.log(response)
      alertify.success('Registrado con exito.')
      datatable.ajax.reload(null, false)
      $('#modalColaborador').modal('hide')
    })
    .catch((error) => {
      console.log(error)
      if (error.response) {
        if (error.response.status === 422) {
          Utils.showValidationMessages(
            '#frmColaborador',
            error.response.data.errors
          )
          showValidationMessagesInTable(error.response.data.errors)
        } else {
          alert('Ocurrio un error inesperado!')
        }
      }
    })
    .then(() => {
      btnSendFrmColaborador.disabled = false
      loaderBtnSendFrmColaborador.style.display = 'none'
    })
})

function showValidationMessagesInTable(errors) {
  document
    .querySelectorAll('#tablaMultiempresa tbody tr')
    .forEach((element) => {
      element.style.backgroundColor = 'transparent'
    })

  Object.entries(errors).forEach((error) => {
    console.log(error)
    if (error[0].search('empresas.*') != -1) {
      let index = error[0].split('.')[1]
      document.querySelectorAll('#tablaMultiempresa tbody tr')[
        index
      ].style.backgroundColor = '#dc3545'
      alertify.error(
        error[1][0].replace(
          `empresas.${index}.correo`,
          // $('#tablaMultiempresa').DataTable().rows(index).data()[0].correo
          'correo'
        )
      )
    }
  })
}

$('#colaboradores').on('click', '.desactivar', function () {
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
      var data = datatable.row($(this).parents('tr')).data()
      if (datatable.row(this).child.isShown()) {
        var data = datatable.row(this).data()
      }

      console.log(data)
      let route = '/colaborador/' + data['id']
      let data2 = {
        id: data.id,
        _token: token_,
      }

      $.ajax({
        method: 'delete',
        url: route,
        data: data2,

        success: function (Response) {
          if (Response == 1) {
            Swal.fire(
              '¡Desactivado!',
              'Su registro ha sido actualizado.',
              'success'
            )

            datatable.ajax.reload(null, false)
          } else {
            alert('no editado')
          }
        },
        error: (response) => {
          console.log(response)
          $.each(response.responseJSON.errors, function (key, value) {
            response.responseJSON.errors[key].forEach((element) => {
              console.log(element)
              toastr.error(element)
            })
          })
        },
      })
    }
  })
})
