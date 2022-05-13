var datatable = null
var dataTableArea = null
var dataTableColaborador = null

let EMPRESA_FORM_ACTION = 'STORE'
let AREA_FORM_ACTION = 'STORE'
let COLABORADOR_FORM_ACTION = 'STORE'

function listar() {
  datatable = $('#tablaEmpresas').DataTable({
    pageLength: 5,
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
        width: '5%',
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
            return "<button type='button' class='btn btn-danger btn-sm btnOnOff'><span class='fa fa-edit'></span><span class='hidden-xs'>Desactivar</span></button>"
          }

          if (data == '0') {
            return "<button type='button' class='btn btn-info btn-sm btnOnOff'><span class='fa fa-edit'></span><span class='hidden-xs'>Activar</span></button>"
          }
        },
      },
      {
        data: null,
        className: 'text-center test',
        render: function (data) {
          return "<button type='button' class='btn btn-warning btn-sm btnEditar'><span class='fa fa-edit'></span><span class='hidden-xs'>Editar</span></button>"
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

function displayChildOfTable1(row, data) {
  string = `
  <table class="DTTable2 table table-responsive table-bordered" id="" style="width: 100%; display: table; font-size: small; border: 3px solid tomato;">
    <thead>
      <tr>
        <th></th>
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
        text: 'NUEVA AREA',
        className: 'btn btn-sm btn-success mt-2',
        action: function (e, dt, node, config) {
          AREA_FORM_ACTION = 'STORE'
          modalFrmAreaLabel.textContent = 'NUEVA AREA'

          $('#frmArea #txtEmpresa').find('option').remove()
          Utils.establecerOpcionSelect2('#frmArea #txtEmpresa', {
            id: data.id,
            text: data.nombre,
          })

          $('#modalFrmArea').modal('show')
          dataTableArea = dt
          frmArea.reset()
        },
      },
    ],
    ajax: {
      url: 'datatable/areas',
      type: 'POST',
      data: { _token: token_, id_empresa: data.id },
    },
    columns: [
      {
        className: 'details-control2',
        orderable: false,
        data: null,
        defaultContent: '',
        width: '10%',
      },
      { data: 'id' },
      { data: 'nombre' },
      {
        data: 'estado',
        className: 'text-center test',
        render: function (data) {
          if (data == '1') {
            return "<button type='button' class='btn btn-danger btn-sm btnOnOffArea'><span class='fa fa-edit'></span><span class='hidden-xs'>Desactivar</span></button>"
          }

          if (data == '0') {
            return "<button type='button' class='btn btn-info btn-sm btnOnOffArea'><span class='fa fa-edit'></span><span class='hidden-xs'>Activar</span></button>"
          }
        },
      },
      {
        data: null,
        className: 'text-center test',
        render: function (data) {
          return "<button type='button' class='btn btn-warning btn-sm btnEditarArea'><span class='fa fa-edit'></span><span class='hidden-xs'>Editar</span></button>"
        },
      },
    ],
  })

  $('.DTTable2 tbody').on('click', 'td.details-control2', function (event) {
    event.stopImmediatePropagation()
    var tr = $(this).closest('tr'),
      row = $('.DTTable2').DataTable().row(tr)

    if (row.child.isShown()) {
      destroyChild2(row)
      tr.removeClass('shown')
    } else {
      displayChildOfTable2(row, row.data())
      tr.addClass('shown')
    }
  })
}

function displayChildOfTable2(row, data) {
  string = `
    <table class="DTTable2 table table-responsive table-bordered" id="" style="width: 100%; display: table; font-size: small; border: 3px solid steelblue;">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>F. Nac.</th>
          <th>Direccion</th>
          <th>Telefono</th>
          <th colspan='2' class='text-center'>Opciones</th>
        </tr>
      </thead>
    </table>
  `

  var table = $(string)

  row.child(table).show()

  var Table3 = table.DataTable({
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
        text: 'NUEVO COLABORADOR',
        className: 'btn btn-sm btn-success mt-2',
        action: function (e, dt, node, config) {
          COLABORADOR_FORM_ACTION = 'STORE'
          modalFrmColaboradorLabel.textContent = 'NUEVO COLABORADOR'

          $('#frmColaborador #txtEmpresaArea').find('option').remove()
          Utils.establecerOpcionSelect2('#frmColaborador #txtEmpresaArea', {
            id: data.empresa_areas_id,
            text: `${data.nombre_empresa} - ${data.nombre}`,
          })

          $('#modalFrmColaborador').modal('show')
          dataTableColaborador = dt
          frmColaborador.reset()
        },
      },
    ],
    ajax: {
      url: 'datatable/colaboradores',
      type: 'POST',
      data: {
        _token: token_,
        id_empresa_area: data.empresa_areas_id,
      },
    },
    columns: [
      { data: 'id' },
      { data: 'nombres' },
      { data: 'apellidos' },
      { data: 'fechanacimiento' },
      { data: 'direccion' },
      { data: 'telefono' },
      {
        data: 'colaborador_estado',
        className: 'text-center test',
        render: function (data) {
          if (data == '1') {
            return "<button type='button' class='btn btn-danger btn-sm btnOnOffColaborador'><span class='fa fa-edit'></span><span class='hidden-xs'>Desactivar</span></button>"
          }

          if (data == '0') {
            return "<button type='button' class='btn btn-info btn-sm btnOnOffColaborador'><span class='fa fa-edit'></span><span class='hidden-xs'>Activar</span></button>"
          }
        },
      },
      {
        data: null,
        className: 'text-center test',
        render: function (data) {
          return "<button type='button' class='btn btn-warning btn-sm btnEditarColaborador'><span class='fa fa-edit'></span><span class='hidden-xs'>Editar</span></button>"
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

function destroyChild2(row) {
  var table = $('Table3', row.child())
  table.detach()
  table.DataTable().destroy()

  row.child.hide()
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
// ######## AREAS ##########
// #########################

$('#frmArea').on('submit', (event) => {
  event.preventDefault()

  let dataArray = $('#frmArea').serializeArray()
  let route =
    AREA_FORM_ACTION === 'STORE' ? '/area' : `/area/${txtIdArea.value}`
  dataArray.push({ name: '_token', value: token_ })

  $.ajax({
    method: AREA_FORM_ACTION === 'STORE' ? 'POST' : 'PUT',
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

        dataTableArea.ajax.reload(null, false)
        frmArea.reset()
        $('#modalFrmArea').modal('hide')
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
})

$('#tablaEmpresas').on('click', '.btnEditarArea', function () {
  AREA_FORM_ACTION = 'UPDATE'
  modalFrmAreaLabel.textContent = 'EDITAR AREA'
  $('#modalFrmArea').modal('show')

  let data = $(this)
    .parents('table')
    .DataTable()
    .row($(this).parents('tr'))
    .data()

  $('#frmArea #txtIdArea').val(data['id'])
  $('#frmArea #txtNombre').val(data['nombre'])

  $('#frmArea #empresaAreaId').val(data['empresa_areas_id'])

  $('#frmArea #txtEmpresa').find('option').remove()
  Utils.establecerOpcionSelect2('#frmArea #txtEmpresa', {
    id: data.empresa_id,
    text: data.nombre_empresa,
  })

  dataTableArea = $($(this).parents('table')[0]).DataTable()
})

$('#tablaEmpresas').on('click', '.btnOnOffArea', function () {
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
      let btnOnOffArea = this

      let data = $(btnOnOffArea)
        .parents('table')
        .DataTable()
        .row($(btnOnOffArea).parents('tr'))
        .data()

      let route = '/area/' + data['id']
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

            $($(btnOnOffArea).parents('table')[0])
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

searchEmpresa('#frmArea #txtEmpresa')

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

// #########################
// ######## ./AREAS ########
// #########################

// #################################
// ######## COLABORADORES ##########
// #################################
$('#frmColaborador').on('submit', (event) => {
  event.preventDefault()

  let dataArray = $('#frmColaborador').serializeArray()
  let route =
    COLABORADOR_FORM_ACTION === 'STORE'
      ? '/colaborador'
      : `/colaborador/${txtIdColaborador.value}`
  dataArray.push({ name: '_token', value: token_ })

  $.ajax({
    method: COLABORADOR_FORM_ACTION === 'STORE' ? 'POST' : 'PUT',
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

        dataTableColaborador.ajax.reload(null, false)
        frmColaborador.reset()
        $('#modalFrmColaborador').modal('hide')
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
})

$('#tablaEmpresas').on('click', '.btnEditarColaborador', function () {
  COLABORADOR_FORM_ACTION = 'UPDATE'
  modalFrmColaboradorLabel.textContent = 'EDITAR COLABORADOR'
  $('#modalFrmColaborador').modal('show')

  let data = $(this)
    .parents('table')
    .DataTable()
    .row($(this).parents('tr'))
    .data()

  $('#frmColaborador #txtIdColaborador').val(data['id'])
  $('#frmColaborador #txtNroDocumento').val(data['nrodocumento'])
  $('#frmColaborador #txtNombre').val(data['nombres'])
  $('#frmColaborador #txtApellido').val(data['apellidos'])
  $('#frmColaborador #txtFechanac').val(data['fechanacimiento'])
  $('#frmColaborador #txtDireccion').val(data['direccion'])
  $('#frmColaborador #txtTelefono').val(data['telefono'])

  $('#frmColaborador #txtEmpresaArea').find('option').remove()
  Utils.establecerOpcionSelect2('#frmColaborador #txtEmpresaArea', {
    id: data.empres_area_id,
    text: `${data.nombre_empresa} - ${data.nombre_area}`,
  })

  dataTableColaborador = $($(this).parents('table')[0]).DataTable()
})

$('#tablaEmpresas').on('click', '.btnOnOffColaborador', function () {
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
      let btnOnOffColaborador = this

      let data = $(btnOnOffColaborador)
        .parents('table')
        .DataTable()
        .row($(btnOnOffColaborador).parents('tr'))
        .data()

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
              'Su registro ha sido desactivado.',
              'success'
            )

            $($(btnOnOffColaborador).parents('table')[0])
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

searchEmpresaArea('#txtEmpresaArea')

function searchEmpresaArea(control, _filters = null) {
  return $(`${control}`).select2({
    width: '100%',
    placeholder: 'Buscar',
    allowClear: true,
    ajax: {
      url: `empresa_area/search`,
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
// #################################
// ######## ./COLABORADORES ########
// #################################
