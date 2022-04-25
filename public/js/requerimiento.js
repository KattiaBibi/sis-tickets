
$('.js-example-basic-multiple').select2();

addEventListener('load',inicio,false);

function inicio()
{
  document.getElementById('avance').addEventListener('change',cambioAvance,false);
}

function cambioAvance()
{
  document.getElementById('avan').innerHTML=document.getElementById('avance').value;
}



$("#empresa").on("change", function (e) {
    let valor =e.target.value;

    if(valor=='a'){

        $('#servicio').html('<option value="a">¡Seleccione una empresa!</option>');

        $('#gerente').html('<option value="a">¡Seleccione una empresa!</option>');
        return;
    }

        $.get('/requerimiento/'+valor+'/listado', function(data){


            if(data.length==0){

                $('#servicio').html('<option value="a">No hay servicios ...</option>');

            }

          else{

            var html_select='<option value="a">Seleccione ...</option>';

            for(var i=0; i<data.length; ++i)


            html_select += '<option value="'+ data[i].esid +'">'+ data[i].snombre +'</option>';

            $('#servicio').html(html_select);

            console.log(data.length);
            console.log(valor);
            console.log(data);

          }



        });



        $.get('/gerente/'+valor+'/listado', function(data){


            if(data.length==0){

                $('#gerente').html('<option value="a">No hay gerentes ...</option>');

            }

          else{

            var html_select='<option value="a">Seleccione ...</option>';

            for(var i=0; i<data.length; ++i)


            html_select += '<option value="'+ data[i].id +'">'+ data[i].nombres + " " +data[i].apellidos +'</option>';

            $('#gerente').html(html_select);

            console.log(data.length);
            console.log(valor);
            console.log(data);

          }



        });


  });


    const mensaje = document.getElementById('txtProblema');
    const mensaje2 = document.getElementById('txtDetalle');
    const mensaje3 = document.getElementById('txtDescripcion');

    const contador = document.getElementById('contador');
    const contador2 = document.getElementById('contador2');
    const contador3 = document.getElementById('contador3');

    mensaje.addEventListener('input', function(e) {
        const target = e.target;
        const longitudMax = target.getAttribute('maxlength');
        const longitudAct = target.value.length;
        contador.innerHTML = `${longitudAct}/${longitudMax}`;
    });

    mensaje2.addEventListener('input', function(e) {
        const target = e.target;
        const longitudMax = target.getAttribute('maxlength');
        const longitudAct = target.value.length;
        contador2.innerHTML = `${longitudAct}/${longitudMax}`;
    });

    mensaje3.addEventListener('input', function(e) {
        const target = e.target;
        const longitudMax = target.getAttribute('maxlength');
        const longitudAct = target.value.length;
        contador3.innerHTML = `${longitudAct}/${longitudMax}`;
    });



/* ACA LA USO PARA HACER EL POST Y TRAER LA DATA AHORA SI ME ENTIUENDES ? */
var datatable ;


function listar(){

    datatable = $('#requerimientos').DataTable({

        pageLength: 5,
        searching: false,
        ordering: true,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        dom: 'Bfrtip',

        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
          url: 'datatable/requerimientos',
          type: "POST",
        //   data : { '_token' : token_ },
          data: function(d) {
            d._token = token_;
            return $.extend({}, d, {
              filters: {
              }
            });
          }
        },
        columns: [

            {
            defaultContent: "",
            orderable: false,
            render: function(data, type, row, meta) {
              return `<button type='button'  id='ButtonEditar' class='editar edit-modal btn btn-warning botonEditar'><span class='fa fa-edit'></span><span class='hidden-xs'> Editar</span></button>`
            },

          },


          {
            defaultContent: "",
            orderable: false,
            render: function(data, type, row, meta) {
                return `<button type='button'  id='ButtonDesactivar' class='desactivar edit-modal btn btn-danger botonDesactivar'><span class='fa fa-edit'></span><span class='hidden-xs'>Cancelar</span></button>`
              }

          },

            {
            data: "id",
            orderable: false
          },

          {
            data: "titulo_requerimiento",
            orderable: false
          },

          {
            data: "nom_ape_solicitante",
            orderable: false
          },

          {
            data: "nom_ape_encargado",
            orderable: false
          },

          {
            data: "nombre_empresa",
            orderable: false
          },
          {
            data: "nombre_servicio",
            orderable: false
          },
          {
            data: "avance_requerimiento",
            orderable: false,
            render: function(data, type, row, meta) {
                return data +`%`
              }
          },
          {
            data: "estado_requerimiento",
            orderable: false,

             render: function(data, type, row, meta) {
                if(data=="pendiente"){

                    return '<span class="badge badge-warning">PENDIENTE</span>'
                }

                if(data=="en espera"){

                    return '<span class="badge badge-primary">EN ESPERA</span>'
                }


                if(data=="en proceso"){

                    return '<span class="badge badge-info">EN PROCESO</span>'
                }


                if(data=="culminado"){

                    return '<span class="badge badge-success">CULMINADO</span>'
                }

                if(data=="cancelado"){

                    return '<span class="badge badge-danger">CANCELADO</span>'
                }
              }
          },
          {
            data: "prioridad_requerimiento",
            orderable: false,


            render: function(data, type, row, meta) {
                if(data=="alta"){

                    return '<span class="badge badge-danger">ALTA</span>'
                }

                if(data=="media"){

                    return '<span class="badge badge-warning">MEDIA</span>'
                }


                else if(data=="baja"){

                    return '<span class="badge badge-info">BAJA</span>'
                }


              }

          },
          {
            data: "fecha_creacion",
            orderable: true
          },

        ],
        order: [
          [9, 'desc']
        ]
      });


}


$('#requerimientos').on('click','.descripcion',function(){
    var data = datatable.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(datatable.row(this).child.isShown()){//Cuando esta en tamaño responsive

        var data = datatable.row(this).data();
    }
    console.log(data);
    $('#idregistro').val(data['idate']);
    $('#txtDescripcion').val(data['adescripcion']);


    $('#modaldescripcion').modal('show');

})





$('#requerimientos').on('click','.ver',function(){
    var data = datatable.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(datatable.row(this).child.isShown()){//Cuando esta en tamaño responsive

        var data = datatable.row(this).data();
    }
    console.log(data);
    $('#idregistro').val(data['id']);
    $('#verProblema').val(data['tproblema']);
    $('#verDetalle').val(data['tdetalle']);
    $('#vernb').text(data['uname']);


    $('#modalver').modal('show');



})


// $('#requerimientos').on('click','.atender',function(){
//     var data = datatable.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
//     if(datatable.row(this).child.isShown()){//Cuando esta en tamaño responsive

//         var data = datatable.row(this).data();
//     }
//     console.log(data);

//     $('#idregistro').val(data['id']);
//     $('#mostrarProblema').text(data['tproblema']);
//     $('#mostrarDetalle').text(data['tdetalle']);


//     
//     $('#modalatender').modal('show');



// })


$('#requerimientos').on('click','.editar',function(){
    var data = datatable.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(datatable.row(this).child.isShown()){//Cuando esta en tamaño responsive

        var data = datatable.row(this).data();
    }
    console.log(data);
    $('#idregistro').val(data['id']);
    $('#editarTitulo').val(data['titulo_requerimiento']);
    $('#editarDescripcion').val(data['descripcion_requerimiento']);
    $('#UsuarioSolicitante').val(data['nom_ape_solicitante']);
    $('#UsuarioSolicitante2').val(data['usuario_que_registro']);
    $('#UsuarioResponsable').val(data['nom_ape_encargado']);

    $('#avance').val(data['avance_requerimiento']);

    $("#estado").on('change',function(e){
        let estado = e.target.value;
        let p = document.getElementById('elemento');

        if(estado=="en proceso"){

            p.removeAttribute("hidden");


        }

        else{
            p.setAttribute("hidden");
        }

      });


    $('#estado').val(data['estado_requerimiento']);
    $('#prioridad').val(data['prioridad_requerimiento']);
    document.getElementById('avan').innerHTML=document.getElementById('avance').value;


        $.get('/personal/'+data['id_empresa']+'/listado', function(data){


            if(data.length==0){

                $('#personal').html('<option value="a">No hay colaboradores ...</option>');

            }

          else{

            var html_select='<option value="a">Seleccione ...</option>';

            for(var i=0; i<data.length; ++i)


            html_select += '<option value="'+ data[i].id +'">'+ data[i].nombres + " " +data[i].apellidos +'</option>';

            $('#personal').html(html_select);

            console.log(data.length);
            console.log(data);

          }



        });


    $('#modaleditar').modal('show');

})



$('#btnguardar').on("click" ,(event)=>{
    event.preventDefault();

let route=$('#frmguardar').attr("action");
let dataArray=$('#frmguardar').serializeArray()
dataArray.push({name:'_token',value:token_})
console.log(dataArray)

$.ajax({
    "method":'POST',
    "url": route,
    "data": dataArray,


    "success":function(Response){

        if(Response==1){

        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Datos guardados correctamente',
        showConfirmButton: false,
        timer: 1500
        })

       datatable.ajax.reload(null,false);
        $('#frmguardar')[0].reset()

        $('#modalagregar').modal('hide');

        }
            else{

                alert("no guardado");
            }


    },'error':(response)=>{
        console.log(response)
       $.each(response.responseJSON.errors, function (key, value){
        response.responseJSON.errors[key].forEach(element => {

            console.log(element);
            toastr.error(element);

           });
       });
    }
})

})



$('#btnactualizar').on("click" ,(event)=>{
    event.preventDefault();

    let dataArray=$('#frmeditar').serializeArray();
    let route="/requerimiento/"+dataArray[0].value;
dataArray.push({name:'_token',value:token_})
console.log(dataArray[0].value)

$.ajax({
    "method":'put',
    "url": route,
    "data": dataArray,


    "success":function(Response){

        if(Response==1){

        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Editado correctamente',
        showConfirmButton: false,
        timer: 1500
        })

      datatable.ajax.reload(null,false);
        $('#frmguardar')[0].reset();

        $('#modaleditar').modal('hide');

        }
            else{

                alert("no editado");
            }


    },'error':(response)=>{
        console.log(response)
       $.each(response.responseJSON.errors, function (key, value){
        response.responseJSON.errors[key].forEach(element => {

            console.log(element);
            toastr.error(element);

           });
       });
    }
})

});


    $('#colaboradores').on('click','.desactivar',function(){

        Swal.fire({
            title: '¿Estás seguro(a)?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí!',
            cancelButtonText: 'Cancelar',
          }).then((result) => {
            if (result.isConfirmed) {



                var data = datatable.row($(this).parents('tr')).data();
                if(datatable.row(this).child.isShown()){
                    var data = datatable.row(this).data();
                }

                console.log(data)
                let route="/colaborador/"+data['id'];
                let data2={
                    id:data.id,
                    _token:token_
                }

                $.ajax({
                    "method":'delete',
                    "url": route,
                    "data": data2,


                    "success":function(Response){

                        if(Response==1){

                            Swal.fire(
                                '¡Desactivado!',
                                'Su registro ha sido desactivado.',
                                'success'
                              )

                      datatable.ajax.reload(null,false);

                        }
                            else{

                                alert("no editado");
                            }


                    },'error':(response)=>{
                        console.log(response)
                       $.each(response.responseJSON.errors, function (key, value){
                        response.responseJSON.errors[key].forEach(element => {

                            console.log(element);
                            toastr.error(element);

                           });
                       });
                    }
                })


            }
          })

    })

