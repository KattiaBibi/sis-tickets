// $(function () {
//     var $avatarImage, $avatarInput, $avatarForm;

//     $avatarImage = $('#imagenPrevisualizacion');
//     $avatarInput = $('#img');
//     $avatarForm = $('#frmguardar');

//     $avatarImage.on('click', function () {
//         $avatarInput.click();
//     });

//     $avatarInput.on('change', function () {
//         // alert('change');

//         var formData = new FormData();
//         formData.append('imagen', $avatarInput[0].files[0]);

//         $.ajax({
//             url: $avatarForm.attr('action') + '?' + $avatarForm.serialize(),
//             method: $avatarForm.attr('method'),
//             data: formData,
//             processData: false,
//             contentType: false
//         }).done(function (data) {
//             if (data.success)
//                 $avatarImage.attr('src', data.path);
//         }).fail(function () {
//             alert('La imagen subida no tiene un formato correcto');
//         });


//     });
// });


const MAXIMO_TAMANIO_BYTES = 2000000; // 1MB = 1 millón de bytes

// Obtener referencia al input y a la imagen

const $seleccionArchivos = document.querySelector("#img"),
  $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");


// Escuchar cuando cambie
$seleccionArchivos.addEventListener("change", function () {
	// si no hay archivos, regresamos
	if (this.files.length <= 0) return;

	// Validamos el primer archivo únicamente
	const archivo = this.files[0];
	if (archivo.size > MAXIMO_TAMANIO_BYTES) {
		const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
		alert(`El tamaño máximo es ${tamanioEnMb} MB`);
		// Limpiar
		$seleccionArchivos.value = "";
	}


    else{

		// Validación pasada.

        // let extension = $seleccionArchivos.files[0].name.split('.')[1];
        // let nuevo_nombre = `archivo_nuevo.${extension}`;

        // alert(nuevo_nombre);
        // $seleccionArchivos.files[0].name = nuevo_nombre;

          // Los archivos seleccionados, pueden ser muchos o uno
            const archivos = $seleccionArchivos.files;
            // Si no hay archivos salimos de la función y quitamos la imagen
            if (!archivos || !archivos.length) {
                $imagenPrevisualizacion.src = "";
                return;
            }
            // Ahora tomamos el primer archivo, el cual vamos a previsualizar
            const primerArchivo = archivos[0];
            // Lo convertimos a un objeto de tipo objectURL
            const objectURL = URL.createObjectURL(primerArchivo);
            // Y a la fuente de la imagen le ponemos el objectURL
            $imagenPrevisualizacion.src = objectURL;



	}

});



$('.js-example-basic-multiple').select2();


function cambioAvance()
{
  document.getElementById('avan').innerHTML=document.getElementById('avance').value;
}

function inicio()
{
  document.getElementById('avance').addEventListener('change',cambioAvance,false);
}


addEventListener('load',inicio,false);


$("#empresa").on("change", function (e) {
    let valor =e.target.value;

    if(valor=='a'){

        $('#servicio').html('<option value="a" >¡Seleccione una empresa!</option>');

        $('#gerente').html('<option value="a" >¡Seleccione una empresa!</option>');
        return;
    }

        $.get('/requerimiento/'+valor+'/listado', function(data){


            if(data.length==0){

                $('#servicio').html('<option value="a">No hay servicios ...</option>');

            }

          else{

            var html_select='<option value="a" >Seleccione ...</option>';

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

            var html_select='<option value="a" disabled>Seleccione ...</option>';

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
          type: "GET",
        //   data : { '_token' : token_ },
          data: function(d) {
            d._token = token_;
            return $.extend({}, d, {
              filters: {
                  estado: $("#filtros").val()
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
            data: "estado_requerimiento",
            orderable: false,
            render: function(data, type, row, meta) {

                if(data=="cancelado"){

                    return `<button type='button'  id='ButtonDesactivar' class='desactivar edit-modal btn btn-danger botonDesactivar' disabled><span class='fa fa-edit'></span><span class='hidden-xs'>Cancelar</span></button>`

                }


                else{
                    return `<button type='button'  id='ButtonDesactivar' class='desactivar edit-modal btn btn-danger botonDesactivar'><span class='fa fa-edit'></span><span class='hidden-xs'>Cancelar</span></button>`


                }

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


               return `<div class="progress">
                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: ${data}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">${data}%</div>
              </div>`


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
    $('#estado').val(data['estado_requerimiento']);
    $('#prioridad').val(data['prioridad_requerimiento']);
    document.getElementById('avan').innerHTML=document.getElementById('avance').value;




    if(data['estado_requerimiento']=="en proceso"){
        document.getElementById('elemento').removeAttribute("hidden");
        document.getElementById('trabajadores').removeAttribute("hidden");

    }

    else if(data['estado_requerimiento']=="culminado"){
        document.getElementById('elemento').removeAttribute("hidden");
        document.getElementById('trabajadores').removeAttribute("hidden");

    }

    else{
        document.getElementById('elemento').setAttribute("hidden","");
        document.getElementById('trabajadores').setAttribute("hidden","");

    }



    $("#estado").on('change',function(e){
        let estado = e.target.value;
        let el = document.getElementById('elemento');
        let tr = document.getElementById('trabajadores');

        if(estado=="pendiente"|| estado=="en espera"){
            el.setAttribute("hidden","")
            tr.setAttribute("hidden","")
            $("#avance").val(0);

            cambioAvance();

        }


        if(estado=="en proceso"){
            el.removeAttribute("hidden")
            tr.removeAttribute("hidden")

            // $('#personal').val(null).trigger('change');
            $("#avance").val(0);
            cambioAvance();

        }

        if(estado=="culminado"){
            el.removeAttribute("hidden")
            tr.removeAttribute("hidden")

            $("#avance").val(100);
            cambioAvance();

        }


      });



    $("#avance").on('change',function(e){
        let avance = e.target.value;


        if(avance=="100"){


            $("#estado").val("culminado");

        }


        else{

            $("#estado").val("en proceso");
        }


      });



        $.get('/personal/'+data['id_empresa']+'/listado', function(dato){


            if(dato.length==0){

                $('#personal').html('<option value="a">No hay colaboradores ...</option>');

            }

          else{

            var html_select='<option value="a" disabled>Seleccione ...</option>';

            for(var i=0; i<dato.length; ++i)


            html_select += '<option value="'+ dato[i].id +'">'+ dato[i].nombres + " " +dato[i].apellidos +'</option>';

            $('#personal').html(html_select);

            console.log(dato.length);
            console.log(dato);



            $.get(`/requerimiento/${data['id']}/getdetalle`, function(data){
            console.log(data);
        $('#personal').val(data.map(item => item.id)).trigger('change');
            })




          }



        });





    $('#modaleditar').modal('show');

})



$('#btnguardar').on("click" ,(event)=>{
    event.preventDefault();

let route=$('#frmguardar').attr("action");

/* let dataArray=$('#frmguardar').serialize() */
let dataArray= new FormData($('#frmguardar')[0])

// dataArray.push({name:'_token',value:token_})
console.log(dataArray)

$.ajax({
    "method":'POST',
    "url": route,
    data: dataArray,
    cache: false,
        contentType: false,
        processData: false,

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




    let val = document.getElementById('personal').value;
    let val2 = document.getElementById('estado').value;


    if(val.length==0 && val2=="en proceso"|| val=="culminado"){

        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Si su estado es en proceso o culminado debe asignar personal.',
            showConfirmButton: false,
            timer: 2500
          })



    }

    else{

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
    }







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

    $("#filtros").on("change", function (e) {
        datatable.ajax.reload(null, false);
    })




    $('#requerimientos').on('click','.desactivar',function(){

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
                let route="/requerimiento/"+data['id'];
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
                                'Cancelado!',
                                'El requerimiento ha sido cancelado.',
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

