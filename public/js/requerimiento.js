
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

    const DATATABLE = $('#requerimientos').DataTable({
        searching: false,
        ordering: true,
        processing: true,
        serverSide: true,
        language: {
          url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        ajax: {
          url: 'datatable/requerimientos',
          type: "POST",
          data: function(d) {
            return $.extend({}, d, {
              filters: {
              }
            });
          }
        },
        columns: [{
            data: "id",
            orderable: false
          },
          {
            data: "titulo_requerimiento",
            orderable: false
          },
          {
            data: "nom_ape_encargado",
            orderable: false
          },
          {
            data: "nom_ape_solicitante",
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
            orderable: false
          },
          {
            data: "estado_requerimiento",
            orderable: false
          },
          {
            data: "prioridad_requerimiento",
            orderable: false
          },
          {
            data: "fecha_creacion",
            orderable: true
          },
          {
            defaultContent: "",
            orderable: false,
            render: function(data, type, row, meta) {
              return `
                <button class="btn btn-sm btn-primary">Editar</button>
                <button class="btn btn-sm btn-danger">Eliminar</button>
              `
            }
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

    jQuery.noConflict();
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

    jQuery.noConflict();
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


//     jQuery.noConflict();
//     $('#modalatender').modal('show');



// })


$('#requerimientos').on('click','.editar1',function(){
    var data = datatable.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(datatable.row(this).child.isShown()){//Cuando esta en tamaño responsive

        var data = datatable.row(this).data();
    }
    console.log(data);
    $('#idregistro').val(data['id']);
    $('#editarProblema').val(data['tproblema']);
    $('#editarDetalle').val(data['tdetalle']);



    jQuery.noConflict();
    $('#modaleditar1').modal('show');

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
        jQuery.noConflict();
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
    let route="/colaborador/"+dataArray[0].value;
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
        jQuery.noConflict();
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

