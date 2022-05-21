var datatable = null
var dataTableServicio = null

let EMPRESA_FORM_ACTION = 'STORE'
let SERVICIO_FORM_ACTION = 'STORE'

function listar() {
  datatable = $('#tablaEmpresas').DataTable({
    pageLength: 10,
    destroy: true,
    async: false,
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
    ajax: {
      url: '/datatable/empresas',
      method: 'post',
      data: { _token: token_ },
    },
    order: [['1', 'desc']],
    columns: [
      {
        className: 'details-control',
        orderable: false,
        data: null,
        defaultContent: '',
        width: '50px',
      },
      {
        data: 'id',
      },
      {
        data: 'ruc',
      },
      {
        data: 'nombre',
      },
      {
        data: 'direccion',
      },
      {
        data: 'telefono',
      },
      {
        data: 'color',
        render: function (data) {
          return `<span class="color-empresa" style="background-color: ${data};">${data}</span>`
        },
      },
      {
        data: 'estado',
        className: 'text-center test',
        render: function (data) {
          if (data == '1') {
            return "<button type='button' class='btn btn-danger btn-sm btnOnOff text-truncate'><span class='fa fa-edit'></span><span class='hidden-xs'>Desactivar</span></button>"
          }

          if (data == '0') {
            return "<button type='button' class='btn btn-info btn-sm btnOnOff text-truncate'><span class='fa fa-edit'></span><span class='hidden-xs'>Activar</span></button>"
          }
        },
      },
      {
        data: null,
        className: 'text-center test',
        render: function (data) {
          return "<button type='button' class='btn btn-warning btn-sm btnEditar text-truncate'><span class='fa fa-edit'></span><span class='hidden-xs'>Editar</span></button>"
        },
      },
    ],
  })

  $('#tablaEmpresas tbody').on('click', 'td.details-control', function (event) {
    event.stopImmediatePropagation()
    var tr = $(this).closest('tr'),
      row = $('#tablaEmpresas').DataTable().row(tr)

    if (row.child.isShown()) {
      destroyChild(row)
      tr.removeClass('shown')
    } else {
      displayChildOfTable1(row, row.data())
      tr.addClass('shown')
    }
  })
}

// #########################
// ######## EMPRESAS #######
// #########################

$('#tablaEmpresas').on('click', '.btnEditar', function () {
  EMPRESA_FORM_ACTION = 'UPDATE'
  modalFrmEmpresaLabel.textContent = 'EDITAR EMPRESA'

  var data = datatable.row($(this).parents('tr')).data()

  if (datatable.row(this).child.isShown()) {
    var data = datatable.row(this).data()
  }

  $('#txtIdEmpresa').val(data['id'])
  $('#txtRuc').val(data['ruc'])
  $('#txtNombre').val(data['nombre'])
  $('#txtDireccion').val(data['direccion'])
  $('#txtTelefono').val(data['telefono'])
  $('#txtColor').val(data['color'])

  $('#modalFrmEmpresa').modal('show')
})

btnRegistrarEmpresa.onclick = (e) => {
  EMPRESA_FORM_ACTION = 'STORE'
  modalFrmEmpresaLabel.textContent = 'REGISTRAR EMPRESA'
  frmEmpresa.reset()
}

$('#frmEmpresa').on('submit', (event) => {
  event.preventDefault()

  let dataArray = $('#frmEmpresa').serializeArray()
  let route =
    EMPRESA_FORM_ACTION === 'STORE'
      ? '/empresa'
      : `/empresa/${txtIdEmpresa.value}`

  dataArray.push({ name: '_token', value: token_ })

  $.ajax({
    method: EMPRESA_FORM_ACTION === 'STORE' ? 'POST' : 'PUT',
    url: route,
    data: dataArray,

    success: function (Response) {
      if (Response == 1) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Datos Guardados',
          showConfirmButton: false,
          timer: 1500,
        })

        datatable.ajax.reload(null, false)
        frmEmpresa.reset()
        $('#modalFrmEmpresa').modal('hide')
      } else {
        alert(
          'Ocurrio un error inspereado, recargue el navegador o cominiquese con el administrador.'
        )
      }
    },
    error: (response) => {
      $.each(response.responseJSON.errors, function (key, value) {
        response.responseJSON.errors[key].forEach((element) => {
          toastr.error(element)
        })
      })
    },
  })
})

$('#tablaEmpresas').on('click', '.btnOnOff', function () {
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

      let route = '/empresa/' + data['id']
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
              'Su registro ha sido desactivado.',
              'success'
            )

            datatable.ajax.reload(null, false)
          } else {
            alert(
              'Ocurrio un error inesperado, recargue el navegador o comuniquese con el administrador.'
            )
          }
        },
        error: (response) => {
          $.each(response.responseJSON.errors, function (key, value) {
            response.responseJSON.errors[key].forEach((element) => {
              toastr.error(element)
            })
          })
        },
      })
    }
  })
})

// #########################
// ######## ./EMPRESAS #####
// #########################


// #########################
// ######## SERVICIOS ######
// #########################
function displayChildOfTable1(row, data) {
  string = `
    <table class="DTTable2 table table-responsive table-bordered" id="" style="width: 100%; display: table; border: 3px solid tomato;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th colspan='2' class='text-center'>Opciones</th>
        </tr>
      </thead>
    </table>
    `
  var table = $(string)

  row.child(table).show()

  var Table2 = table.DataTable({
    processing: true,
    serverSide: true,
    destroy: true,
    searching: false,
    paging: false,
    pageLength: 10,
    ordering: false,
    lengthChange: false,
    info: true,
    autoWidth: false,
    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json',
    },
    dom: 'Bfrtip',
    buttons: [
      {
        text: 'NUEVO SERVICIO',
        className: 'btn btn-sm btn-success mt-2',
        action: function (e, dt, node, config) {
          SERVICIO_FORM_ACTION = 'STORE'
          modalServicioLabel.textContent = 'NUEVO SERVICIO'

          $('#inputEmpresa').find('option').remove()
          Utils.establecerOpcionSelect2('#inputEmpresa', {
            id: data.id,
            text: data.nombre,
          })

          $('#modalServicio').modal('show')
          dataTableServicio = dt
          frmServicio.reset()
        },
      },
    ],
    ajax: {
      url: 'datatable/empresa_servicios',
      type: 'POST',
      data: { _token: token_, id_empresa: data.id },
    },
    columns: [
      { data: 'id_servicio' },
      { data: 'nombre_servicio' },
      {
        defaultContent: '',
        orderable: false,
        className: 'text-center',
        render: function (data, type, row, meta) {
          return `
          <button class="btn btn-sm btn-warning btnEditarServicio">Editar</button>
          <button class="btn btn-sm btn-danger btnEliminarServicio">Eliminar</button>`
        },
      },
    ],
  })
}

function destroyChild(row) {
  var table = $('Table2', row.child())
  table.detach()
  table.DataTable().destroy()

  row.child.hide()
}

$('#frmServicio').on('submit', (event) => {
  event.preventDefault()

  let dataArray = $('#frmServicio').serializeArray()
  let route =
    SERVICIO_FORM_ACTION === 'STORE'
      ? '/empresa_servicio'
      : `/empresa_servicio/${inputIdServicio.value}`
  dataArray.push({ name: '_token', value: token_ })

  $.ajax({
    method: SERVICIO_FORM_ACTION === 'STORE' ? 'POST' : 'PUT',
    url: route,
    data: dataArray,

    success: function (Response) {
      if (Response == 1) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Datos Guardados',
          showConfirmButton: false,
          timer: 1500,
        })

        dataTableServicio.ajax.reload(null, false)
        frmServicio.reset()
        $('#modalServicio').modal('hide')
      } else {
        alert(
          'Ocurrio un error inesperado, recargue el navegador o comuniquese con el administrador.'
        )
      }
    },
    error: (response) => {
      console.log(response)
      $.each(response.responseJSON.errors, function (key, value) {
        response.responseJSON.errors[key].forEach((element) => {
          toastr.error(element)
        })
      })
    },
  })
})

$('#tablaEmpresas').on('click', '.btnEditarServicio', function () {
  SERVICIO_FORM_ACTION = 'UPDATE'
  modalServicioLabel.textContent = 'EDITAR SERVICIO'
  $('#modalServicio').modal('show')

  let data = $(this)
    .parents('table')
    .DataTable()
    .row($(this).parents('tr'))
    .data()

  $('#inputIdServicio').val(data['id_servicio'])
  $('#inputNombreServicio').val(data['nombre_servicio'])
  $('#inputIdEmpresaServicio').val(data['id_empresa_servicio'])

  $('#inputEmpresa').find('option').remove()
  Utils.establecerOpcionSelect2('#inputEmpresa', {
    id: data.id_empresa,
    text: data.nombre_empresa,
  })

  dataTableServicio = $($(this).parents('table')[0]).DataTable()
})

$('#tablaEmpresas').on('click', '.btnEliminarServicio', function () {
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
      let btnEliminarServicio = this

      let data = $(btnEliminarServicio)
        .parents('table')
        .DataTable()
        .row($(btnEliminarServicio).parents('tr'))
        .data()

      let route = '/empresa_servicio/' + data['id_servicio']
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
              '¡Eliminado!',
              'Su registro ha sido eliminado.',
              'success'
            )

            $($(btnEliminarServicio).parents('table')[0])
              .DataTable()
              .ajax.reload(null, false)
          } else {
            alert(
              'Ocurrio un error inesperado, recargue el navegador o comuniquese con el administrador.'
            )
          }
        },
        error: (response) => {
          $.each(response.responseJSON.errors, function (key, value) {
            response.responseJSON.errors[key].forEach((element) => {
              toastr.error(element)
            })
          })
        },
      })
    }
  })
})
// #########################
// ######## ./SERVICIOS ####
// #########################


searchEmpresa('#inputEmpresa')

function searchEmpresa(control, _filters = null) {
  return $(`${control}`).select2({
    width: '100%',
    placeholder: 'Buscar',
    allowClear: true,
    ajax: {
      url: `empresa/search`,
      dataType: 'json',
      type: 'get',
      delay: 250,
      data: function (params) {
        let query = {
          search: params.term,
          page: params.page || 1,
          filters: _filters ? _filters() : [],
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