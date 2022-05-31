var datatable

function listar() {
  datatable = $('#requerimientos').DataTable({
    searchHighlight: true,
    pageLength: 5,
    searching: false,
    ordering: true,
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    dom: 'Bfrtip',

    language: {
      url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json',
    },


    ajax: {
      url: 'datatable/requerimientos',
      type: 'GET',
      //   data : { '_token' : token_ },
      data: function (d) {
        d._token = token_
        return $.extend({}, d, {
          filters: {
            nombrado: $('#filtronb').val(),
            nombre_empresa: $('#filtrosempre').val(),
            estado: $('#filtros').val(),
          },
        })
      },
    },
    columns: [
      {
        data: 'elemento[]',
        orderable: false,
        className: 'text-center',
        render: function (data, type, row, meta) {
          if (data.filter((i) => i === 'dos').length) {
            return `<button type='button' value="dos" id='ButtonEditar' class='editar edit-modal btn btn-warning botonEditar'><span class='fa fa-edit'></span><span class='hidden-xs'>Editar</span></button>`
          } else if (data.filter((i) => i === 'silog').length) {
            return `<button type='button' value="silog" id='ButtonEditar' class='editar edit-modal btn btn-warning botonEditar'><span class='fa fa-edit'></span><span class='hidden-xs'>Modificar</span></button>`
          } else if (data.filter((i) => i === 'sireg').length) {
            return `<button type='button' value="sireg" id='ButtonEditar' class='editar edit-modal btn btn-warning botonEditar'><span class='fa fa-edit'></span><span class='hidden-xs'>Editar</span></button>`
          } else if (data.filter((i) => i === 'mostrar').length) {
            return `<button type='button' value="mostrar" id='ButtonEditar' class='editar edit-modal btn btn-warning botonEditar'><span class='fa fa-edit'></span><span class='hidden-xs'>Mostrar</span></button>`
          }
        },
      },

      {
        data: 'valor[]',
        orderable: false,
        className: 'text-center',
        render: function (data, type, row, meta) {
          // if(data.filter(i => (i === "logue")).length ) {

          //     return `Asignado logueado`;
          // }

          if (data.filter((i) => i === 'disabled').length) {
            return `<button type='button'  id='ButtonDesactivar' class='desactivar edit-modal btn btn-danger botonDesactivar' disabled><span class='fa fa-edit'></span><span class='hidden-xs'>Cancelar</span></button>`
          } else if (data.filter((i) => i === 'nodisabled').length) {
            return `<button type='button'  id='ButtonDesactivar' class='desactivar edit-modal btn btn-danger botonDesactivar' ><span class='fa fa-edit'></span><span class='hidden-xs'>Cancelar</span></button>`
          }
        },
      },

      {
        data: 'asignadolog[]',
        className: 'text-center',
        orderable: false,
        render: function (data, type, row, meta) {
          if (data.filter((i) => i === 'log').length) {
            return `<button type='button' value="log" id='ButtonEditarAvance' class='editaravance edit-modal btn btn-info'><span class='fa fa-edit'></span><span class='hidden-xs'>Avance</span></button>`
          } else {
            return `<button type='button' value="nolog" id='ButtonEditarAvance' class='editaravance edit-modal btn btn-info' disabled><span class='fa fa-edit'></span><span class='hidden-xs'>Avance</span></button>`
          }
        },
      },

      {
        data: 'asignadolog[]',
        className: 'text-center',
        orderable: false,
        render: function (data, type, row, meta) {
          if (data.filter((i) => i === 'log').length) {
            return `<button type='button' value="log" id='ButtonEditarFechaHora' class='guardarfechahora edit-modal btn btn-secondary'><span class='fa fa-clock'></span><span class='hidden-xs'>Fecha y hora </span></button>`
          } else {

            return `<button type='button' value="nolog" id='ButtonEditarFechaHora' class='guardarfechahora edit-modal btn btn-secondary'><span class='fa fa-clock'></span><span class='hidden-xs'>Historial </span></button>`

          }
        },
      },


    //   {
    //     data: 'id',
    //     orderable: false,
    //   },

      {
        data: 'titulo_requerimiento',
        orderable: false,
      },

      {
        data: 'nom_ape_solicitante',
        orderable: false,
      },
      {
        data: 'encargados',
        orderable: false,
        render: function (data, type, row, meta) {
          let encargados = data
            .map((item) => {
              return item.nom_ape
            })
            .toString()
          return `<span>${encargados}</span>`
        },
      },
      {
        data: 'asignados',
        orderable: false,
        render: function (data, type, row, meta) {
          let asignados = data
            .map((item) => {
              return item.nom_ape
            })
            .toString()
          return `<span>${asignados}</span>`
        },
      },
      {
        data: 'nombre_empresa',
        orderable: false,
      },
      {
        data: 'nombre_servicio',
        orderable: false,
      },
      {
        data: 'avance_requerimiento',
        orderable: false,
        render: function (data, type, row, meta) {
          return `<div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: ${data}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">${data}%</div>
              </div>`
        },
      },
      {
        data: 'estado_requerimiento',
        orderable: false,

        render: function (data, type, row, meta) {
          if (data == 'pendiente') {
            return '<span class="badge badge-warning">PENDIENTE</span>'
          } else if (data == 'en espera') {
            return '<span class="badge badge-primary">EN ESPERA</span>'
          } else if (data == 'en proceso') {
            return '<span class="badge badge-info">EN PROCESO</span>'
          } else if (data == 'culminado') {
            return '<span class="badge badge-success">CULMINADO</span>'
          } else if (data == 'cancelado') {
            return '<span class="badge badge-danger">CANCELADO</span>'
          }
        },
      },
      {
        data: 'prioridad_requerimiento',
        orderable: false,

        render: function (data, type, row, meta) {
          if (data == 'alta') {
            return '<span class="badge badge-danger">ALTA</span>'
          } else if (data == 'media') {
            return '<span class="badge badge-warning">MEDIA</span>'
          } else if (data == 'baja') {
            return '<span class="badge badge-info">BAJA</span>'
          }
        },
      },
      {
        data: 'fecha_creacion',
        orderable: true,
        render: function (data, type, row, meta) {
          return `${new Date(data).toLocaleDateString()} ${new Date(
            data
          ).toLocaleTimeString('es-PE', { hour12: true })}`
        },
      },

      {
        data: 'historial',
        orderable: false,
        render: function (data, type, row, meta) {


          let historial = data.map((item) => {
            return `[${new Date(item.fechahoraprogramada).toLocaleDateString()} ${new Date(item.fechahoraprogramada).toLocaleTimeString('es-PE', { hour12: true })}]`
            });


        if(historial==""){
            return `<span>Falta asignar fecha y hora</span>`

        }

        else{
            return `<span>${historial}</span>`
        }

        },
      },

    ],
    order: [[9, 'desc']],
  })

  // datatable.on( 'draw', function () {
  //     var body = $( datatable.table().body() );

  //     body.unhighlight();
  //     body.highlight("Johon");
  // } );
}



$(document).ready(function(){



});

$('#btnagregar').on('click', function (e) {
  $('#frmguardar')[0].reset()

  $('#prev').hide()
  $('#prev').removeAttr('src')

  $('.retirar').hide()
})

$('.retirar').on('click', function (e) {
  $('#imn').val(null)

  $('#xy').val(null)

  $('#imag').hide()
  $('#imag').removeAttr('src')

  $('#prev').hide()
  $('#prev').removeAttr('src')

  $('.retirar').hide()
})

$('#imag').on('error', function (event) {
  $(event.target).css('display', 'none')
})

const MAXIMO_TAMANIO_BYTES = 2000000 // 1MB = 1 millón de bytes

function readImage(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader()
    reader.onload = function (e) {
      $('.imagenPrevisualizacion').attr('src', e.target.result) // Renderizamos la imagen
    }
    reader.readAsDataURL(input.files[0])
  }
}

$('.img').on('change', function () {
  const MAXIMO_TAMANIO_BYTES = 2000000 // 1MB = 1 millón de bytes

  // Código a ejecutar cuando se detecta un cambio de archivo

  if (this.files.length <= 0) return

  const archivo = this.files[0]

  if (archivo.size > MAXIMO_TAMANIO_BYTES) {
    const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000
    alert(`El tamaño máximo es ${tamanioEnMb}  MB`)

    // Limpiar
    this.value = ''
  } else {
    $('#imag').show()
    $('#prev').show()

    $('.retirar').show()
    readImage(this)
  }
})

$('.js-example-basic-multiple').select2()

$('#empresa').on('change', function (e) {
  $('#gerente').val(null).trigger('change')

  let valor = e.target.value

  if (valor == 'a') {
    $('#servicio').html('<option value="a" >¡Seleccione una empresa!</option>')

    $('#gerente').html('<option value="a" >¡Seleccione una empresa!</option>')
    return
  }

  $.get('/requerimiento/' + valor + '/listado', function (data) {
    if (data.length == 0) {
      $('#servicio').html('<option value="a">No hay servicios ...</option>')
    } else {
      var html_select = '<option value="a" >Seleccione ...</option>'

      for (var i = 0; i < data.length; ++i)
        html_select +=
          '<option value="' +
          data[i].esid +
          '">' +
          data[i].snombre +
          '</option>'

      $('#servicio').html(html_select)

      console.log(data.length)
      console.log(valor)
      console.log(data)
    }
  })

  $.get('/gerente/' + valor + '/listado', function (data) {
    if (data.length == 0) {
      $('#gerente').html('<option value="a">No hay gerentes ...</option>')
    } else {
      var html_select = '<option value="a" disabled>Seleccione ...</option>'

      for (var i = 0; i < data.length; ++i)
        html_select +=
          '<option value="' +
          data[i].id +
          '">' +
          data[i].nombres +
          ' ' +
          data[i].apellidos +
          '</option>'

      $('#gerente').html(html_select)

      console.log(data.length)
      console.log(valor)
      console.log(data)
    }
  })
})

const mensaje = document.getElementById('txtProblema')
const mensaje2 = document.getElementById('txtDetalle')

const contador = document.getElementById('contador')
const contador2 = document.getElementById('contador2')
const contador3 = document.getElementById('contador3')

mensaje.addEventListener('input', function (e) {
  const target = e.target
  const longitudMax = target.getAttribute('maxlength')
  const longitudAct = target.value.length
  contador.innerHTML = `${longitudAct}/${longitudMax}`
})

mensaje2.addEventListener('input', function (e) {
  const target = e.target
  const longitudMax = target.getAttribute('maxlength')
  const longitudAct = target.value.length
  contador2.innerHTML = `${longitudAct}/${longitudMax}`
})

function cambioAvance() {
  document.getElementById('editavan').innerHTML =
    document.getElementById('editavance').value + '%'
}

$('#editavance').on('change', function (e) {
  let avance = e.target.value

  cambioAvance()

  // if (avance == "100") {
  //     $("#estado").val("culminado");
  // } else {
  //     $("#estado").val("en proceso");
  // }
})

$('#requerimientos').on('click', '.editaravance', function (event) {
  event.preventDefault()

  var data = datatable.row($(this).parents('tr')).data() //Detecta a que fila hago click y me captura los datos en la variable data.
  if (datatable.row(this).child.isShown()) {
    //Cuando esta en tamaño responsive

    var data = datatable.row(this).data()
  }

  if(data.avance_requerimiento==100){

      Swal.fire({
        icon: 'info',
        html:
          '¡Su requerimiento está culminado, si desea volver al estado <b>EN PROCESO</b> debe asignar nueva fecha de finalización!',
        showCloseButton: true,
        timer: 6000,
        timerProgressBar: true,
      }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
          console.log('I was closed by the timer')
        }
      })

  }

  else{

      let iddetalle=data['usuariodetalle'].map((item) => {return item.detalle_id}).toString();



  $('#idregistroavance').val(data['id'])
  $('#editavance').val(data['avance_requerimiento'])
  $('#iddetallereq').val(iddetalle)
  document.getElementById('editavan').innerHTML =
    data['avance_requerimiento'] + '%'

  $('#modaleditaravance').modal('show')

  }

})


$('#requerimientos').on('click', '.guardarfechahora', function (event) {
    event.preventDefault()

    document.getElementById("divhisto").innerHTML = "";


    var data = datatable.row($(this).parents('tr')).data() //Detecta a que fila hago click y me captura los datos en la variable data.
    if (datatable.row(this).child.isShown()) {
      //Cuando esta en tamaño responsive

      var data = datatable.row(this).data()
    }


        let fechahora = data['historial'].map((item) => {return item.fechahoraprogramada}).toString();
        let fechacreacion = data['ultimafecha'].map((item) => {return item.created_at});
        let fechaprogramada=data['ultimafecha'].map((item) => {return item.fechahoraprogramada});
        let iddetalle=data['usuariodetalle'].map((item) => {return item.detalle_id}).toString();


        $("#iddetalle").val(iddetalle);
        $("#avance").val(data.avance_requerimiento);
        $("#id_requerimiento").val(data.id);

        let historial=data['historial'];


        $('#requerimientodatetime').datetimepicker({
          locale: 'es',
          dateFormat: "yy-mm-dd",
          minDate: new Date(),
          icons: { time: 'far fa-clock' }
      });

    if(fechahora==""){

        // alert("No hay fechas programadas");
        $("#fecha").show();
        $("#fechanueva").hide();
        $("#oculto").hide();
        $("#ocultar").hide();
        $("#motivo").val("Primer registro de fecha");

    }

    else{

        // alert("hay fechas programadas");
        $("#fecha").hide();
        $("#fechanueva").show();
        $("#oculto").show();
        $("#motivo").val("");
        $("#ocultar").show();

        $("#datafecha").html(`Se creó el:  ${fechacreacion} / para el día: ${fechaprogramada}`);

        console.log(fechacreacion[0])

        var fecha1 = moment(''+fechaprogramada[0]+'');
        var fechaact = moment();


        console.log(fecha1)
        console.log(fechaact)

        if(fechaact > fecha1){

        //   alert("Registro vencido");

          $("#fragmento").html("¡Tu última fecha de finalización del requerimiento venció hace " + fechaact.diff(fecha1, 'days') + " día(s) /" + fechaact.diff(fecha1, 'hours') +" hora(s)!") ;
          $(".vencimiento").show();
        }

        else{

            $(".vencimiento").hide();
        }

        console.log(fecha1);


    }



      historial.find(object =>{

            moment.locale('es');
            let date = moment(object.fechahoraprogramada);
            let date2 = moment(object.created_at);
            let  fechaprogr=  date.format('LL')
            let  horaprogr=   date.format('LTS');

            let  fecharegis=  date2.format('LL')
            let  horaregis=   date2.format('LTS');

        $("#divhisto").append(
          `<div class="card text-white bg-dark mb-6"><div class="card-header" style="text-decoration: underline;">HISTORIAL:</div><div class="card-body"><h1 class="card-title">El COLABORADOR ASIGNADO: ${object.nom_ape}</h1><p class="card-text">REGISTRÓ EL DÍA: ${fecharegis} / HORA - ${horaregis}</p><p class="card-text">PARA EL DÍA: ${fechaprogr} / HORA - ${horaprogr}</p><p class="card-text">DETALLE: ${object.motivo}</p></div></div>`);
    });



    let dato= data.asignados;
    let log=data.log;

    console.log(dato)


    let x=dato.find(object => object.id_user===log);

    if(x=="" || x== null){

        console.log("asignado no logueado")

        let valor = document.getElementById("oculto");

        let style = $(valor).css('display');

        if ( style == 'none'){

            console.log("oculto")

          Swal.fire({
            icon: 'info',
            title: 'No hay fechas registradas',
            showConfirmButton: false,
            timer: 1500,
          })

        }

        else{
          console.log("no oculto")
          $('#ocultar').hide();
          $('.ocult').hide();

          $('#modalfechahora').modal('show')

        }

    }

    else{
      console.log(x.id_user)
      $('#modalfechahora').modal('show')
    }


  })


  $('.btnhistorial').on('click', (event) => {

    event.preventDefault()



  $('#modalhistorial').modal('show');

  });


  $('#btnfechahora').on('click', (event) => {
    event.preventDefault()

    let fecha_hora=$("#fechayhora").val();
    let motivo=$("#motivo").val();


    if(fecha_hora=="" || motivo==""){

        Swal.fire({
            icon: 'error',
            title: 'Faltan completar datos',
            showConfirmButton: false,
            timer: 1500,
          })
    }

    else{

    let dateComponents = fecha_hora.split(' ');

    var arrFecha=dateComponents[0].split("/");
    var arrHora=dateComponents[1].split(":");

    let fecha=new Date(arrFecha[2]+"/"+arrFecha[1]+"/"+arrFecha[0]);

    let formatted_date = fecha.getFullYear() + "-" + (fecha.getMonth() + 1) + "-" + fecha.getDate() + " " + arrHora[0] + ":" + arrHora[1] + ":00";

    let route = $('#frmguardarfechahora').attr('action')

    let dataArray = new FormData($('#frmguardarfechahora')[0])
    dataArray.append("fechahora", formatted_date);


    $.ajax({
      method: 'POST',
      url: route,
      data: dataArray,
      cache: false,
      contentType: false,
      processData: false,

      success: function (Response) {
        if (Response == 1) {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Fecha guardada correctamente',
            showConfirmButton: false,
            timer: 1500,
          })

          datatable.ajax.reload(null, false)

          $('#frmguardarfechahora')[0].reset()

          $('#modalfechahora').modal('hide')

        } else {
          alert('no guardado')
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

    } // FINAL ELSE
  });


$('#btnactualizaravance').on('click', (event) => {
  event.preventDefault()

  let dataArray = $('#frmeditaravance').serializeArray()
  let route = '/requerimiento/' + dataArray[0].value
  dataArray.push({ name: '_token', value: token_ })
  console.log(dataArray[0].value)

  $.ajax({
    method: 'get',
    url: route,
    data: dataArray,

    success: function (Response) {
      if (Response == 1) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Avance editado correctamente',
          showConfirmButton: false,
          timer: 1500,
        })

        datatable.ajax.reload(null, false)
        $('#frmeditar')[0].reset()

        $('#modaleditaravance').modal('hide')
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
})

$('#requerimientos').on('click', '.editar', function (event) {


  console.log(event)
  let valorboton = $(this).val()

  if (valorboton == 'dos') {
    // alert("dos");
    $('.divoculto').show()
    $('.divocult').show()
    $('.divocu').show()
    $('#btnactualizar').show()

    $('.div').prop('disabled', false)
    $('.datosocultos').attr('readonly', false)
  }

  if (valorboton == 'sireg') {
    $('#btnactualizar').show()
    // alert("usuario que registró");
    $('.divoculto').show()
    $('.divocu').hide()
    $('.div').prop('disabled', true)
    $('.datosocultos').attr('readonly', false)
  } else if (valorboton == 'silog') {
    $('#btnactualizar').show()

    // alert("usuario que está encargado");
    $('.divocult').hide()
    $('.divocu').show()
    $('.div').prop('disabled', false)
    $('.datosocultos').attr('readonly', true)
  } else if (valorboton == 'mostrar') {
    // alert("Mostrar");
    $('#btnactualizar').hide()
    $('.divoculto').hide()
    $('.divocu').hide()
    $('.div').prop('disabled', true)
    $('.datosocultos').attr('readonly', true)
  }

  event.preventDefault()

  var data = datatable.row($(this).parents('tr')).data() //Detecta a que fila hago click y me captura los datos en la variable data.
  if (datatable.row(this).child.isShown()) {
    //Cuando esta en tamaño responsive

    var data = datatable.row(this).data()
  }

  console.log(data)
  $('#idregistro').val(data['id'])
  $('#editarTitulo').val(data['titulo_requerimiento'])
  $('#editarDescripcion').val(data['descripcion_requerimiento'])
  $('#UsuarioSolicitante').val(data['nom_ape_solicitante'])
  $('#UsuarioSolicitante2').val(data['usuario_que_registro'])
  $('#imn').val('')
  $('#imag').hide()
  $('.retirar').hide()
  $('#imag').removeAttr('src')

  if (data.imagen == 0 || data.imagen == null) {
    document.getElementById('mostimg').src =
      'vendor/adminlte/dist/img/sinimg.jpg'
  } else {
    document.getElementById('mostimg').src = 'storage/' + data.imagen
  }


  $('#download').on('click', function (evento) {


    if (data.archivo == 0 || data.archivo == null) {
         evento.preventDefault()
        Swal.fire({
            icon: 'info',
            title: 'No hay archivo subido',
            showConfirmButton: false,
            timer: 1500,
          })

      } else {
        document.getElementById('download').href = 'download/' + data.archivo
      }

  });


  $('#UsuarioResponsable').val(
    data['encargados']
      .map((item) => {
        return item.nom_ape
      })
      .toString()
  )

  $('#avance').width(data['avance_requerimiento'] + '%')
  document.getElementById('avan').innerHTML = data['avance_requerimiento'] + '%'
  $('#estado').val(data['estado_requerimiento'])
  $('#prioridad').val(data['prioridad_requerimiento'])

  $.get('/personal/' + data['id_empresa'] + '/listado', function (dato) {
    if (dato.length == 0) {
      $('#personal').html('<option value="a">No hay colaboradores ...</option>')
    } else {
      var html_select = '<option value="a" disabled>Seleccione ...</option>'

      for (var i = 0; i < dato.length; ++i)
        html_select +=
          '<option value="' +
          dato[i].id +
          '">' +
          dato[i].nombres +
          ' ' +
          dato[i].apellidos +
          '</option>'

      $('#personal').html(html_select)

      console.log(dato.length)
      console.log(dato)

      $.get(`/requerimiento/${data['id']}/getdetalle`, function (data) {
        console.log(data)
        $('#personal')
          .val(data.map((item) => item.id))
          .trigger('change')
      })
    }
  })

  $('#modaleditar').modal('show')
})

$('#btnguardar').on('click', (event) => {
  event.preventDefault()

  let route = $('#frmguardar').attr('action')

  /* let dataArray=$('#frmguardar').serialize() */
  let dataArray = new FormData($('#frmguardar')[0])

  // dataArray.push({name:'_token',value:token_})
  console.log(dataArray)

  $.ajax({
    method: 'POST',
    url: route,
    data: dataArray,
    cache: false,
    contentType: false,
    processData: false,

    success: function (Response) {
      if (Response == 1) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Datos guardados correctamente',
          showConfirmButton: false,
          timer: 1500,
        })

        datatable.ajax.reload(null, false)
        $('#frmguardar')[0].reset()
        $('#prev')[0].setAttribute('src', '')

        $('#modalagregar').modal('hide')
      } else {
        alert('no guardado')
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
})

$('#btnactualizar').on('click', (event) => {
  event.preventDefault()

  let dataArray = $('#frmeditar').serializeArray()
  let route = '/requerimiento/' + dataArray[0].value

  let _CSRF = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
  var formData = new FormData($('#frmeditar')[0])

  let valor = $('#mostimg').attr('src')

  let divisiones = valor.split('/', -2)

  let extraer = divisiones.slice(-1)

  let x = $('.editar').val()
  console.log(x)

  formData.append('imganterior', extraer)
  formData.append('_method', 'PUT')

  let val = document.getElementById('personal').value
  // let val2 = document.getElementById("estado").value;

  $.ajax({
    method: 'post',
    url: route,
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    headers: _CSRF,

    success: function (Response) {
      if (Response == 1) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Editado correctamente',
          showConfirmButton: false,
          timer: 1500,
        })

        datatable.ajax.reload(null, false)
        $('#frmeditar')[0].reset()

        $('#modaleditar').modal('hide')
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
})

$('#filtros').on('change', function (e) {
  datatable.ajax.reload(null, false)
})

$('#filtrosempre').on('change', function (e) {
  datatable.ajax.reload(null, false)
})

$('#filtronb').on('change', function (e) {
  datatable.ajax.reload(null, false)
})

$('#btnquitarfiltros').on('click', function (e) {

  $('#filtros').val('todos')
  $('#filtrosempre').val('todos')
  $('#filtronb').val('todos')

  datatable.ajax.reload(null, false)

})

$('#requerimientos').on('click', '.desactivar', function () {
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
      let route = '/requerimiento/' + data['id']
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
              'Cancelado!',
              'El requerimiento ha sido cancelado.',
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
