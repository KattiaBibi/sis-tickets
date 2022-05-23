
/* ACA LA USO PARA HACER EL POST Y TRAER LA DATA AHORA SI ME ENTIUENDES ? */
var datatable ;
function listar(){


    datatable= $('#usuarios').DataTable( {
        searchHighlight: true,
        pageLength: 5,
        searching: true,
        ordering: true,
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        dom: "Bfrtip",

        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },

        buttons: [{
            extend: 'copy',
            text: 'Copiar'
        },

        {
            extend: 'colvis',
            text: 'Visibilidad'
        },

             'excel', 'pdf'
            ],

        "columnDefs": [
            {
            "searchable": false,
            "orderable": false,
            "targets": 0
            }
        ],
    "ajax": {
    "url": "/datatable/usuarios",
    "method": "post",
    'data' : { '_token' : token_ },
    },
    "columns":[

    {data: 'uid',
    render: function(data, type, row, meta) {
    return meta.row+1;}},

    {data: 'uname'},
    {data: 'cnombres',

    render: function (data) {

        if(data==null){
        return "Aún sin colaborador asignado";

        }

        else{

           return data;
        }

        }
    },

    {data: 'uemail'},

    // {data: 'upassword'},

    {data: null,
    className: 'text-center',
    render: function (data) {

        return "<button type='button'  id='ButtonEditar' class='editar edit-modal btn btn-warning botonEditar'><span class='fa fa-edit'></span><span class='hidden-xs'> Editar</span></button>";
        }
    },

    {data: 'uestado',
    className: 'text-center',
    render: function(data){

        if(data=="1"){
        return "<button type='button'  id='ButtonDesactivar' class='desactivar edit-modal btn btn-danger botonDesactivar'><span class='fa fa-edit'></span><span class='hidden-xs'>Desactivar</span></button>";

        }

        if(data=="0"){
            return "<button type='button'  id='ButtonActivar' class='desactivar edit-modal btn btn-info botonActivar'><span class='fa fa-edit'></span><span class='hidden-xs'>Activar</span></button>";
        }
    }
    },

],

        // order: [[1, "desc"]],
} );
};


$("#btnagregar").on("click", function (e){

    $("#frmguardar")[0].reset();

    $('#prev').hide();
    $('#prev').removeAttr("src");

    $(".retirar").hide();

});

$(".retirar").on("click", function (e){


    $("#imn").val(null);

    $("#xy").val(null);

    $('#imag').hide();
    $('#imag').removeAttr("src");


    $('#prev').hide();
    $('#prev').removeAttr("src");


    $(".retirar").hide();

    });



    $('#imag').on("error", function(event) {
        $(event.target).css("display", "none");
    });


    const MAXIMO_TAMANIO_BYTES = 2000000; // 1MB = 1 millón de bytes


        function readImage (input)

        {
            if (input.files && input.files[0]) {
              var reader = new FileReader();
              reader.onload = function (e) {
                  $('.imagenPrevisualizacion').attr('src', e.target.result); // Renderizamos la imagen
              }
              reader.readAsDataURL(input.files[0]);
            }

          }

          $(".img").on("change", function ()

        {

        const MAXIMO_TAMANIO_BYTES = 2000000; // 1MB = 1 millón de bytes

            // Código a ejecutar cuando se detecta un cambio de archivo

            if (this.files.length <= 0) return;

            const archivo = this.files[0];



        if (archivo.size > MAXIMO_TAMANIO_BYTES)

        {

            const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
            alert(`El tamaño máximo es ${tamanioEnMb}  MB`);

            // Limpiar
            this.value = "";

        }

        else{

            $('#imag').show();
            $('#prev').show();

             $('.retirar').show();
            readImage(this);

        }

    }

    );


$('#usuarios').on('click','.editar',function(){
    var data = datatable.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(datatable.row(this).child.isShown()){//Cuando esta en tamaño responsive
        var data = datatable.row(this).data();
    }
    $('#idregistro').val(data['uid']);
    $('#editarNombre').val(data['uname']);
    $('#editarEmail').val(data['uemail']);

    $("#editarColaborador").val(data.ucolaborador_id);

    if(data.role_id == "1"){

    // alert("administrador total");
        $("#editarRol").prop("disabled", true);
        $("#editarRol").val(data.role_id);

    }
    else{
        $("#editarRol").prop("disabled", false);
        $("#editarRol").val(data.role_id);

    }



    $('#imn').val("");
    $('#imag').hide();
    $(".retirar").hide();
   $('#imag').removeAttr("src");

   if(data.imagen==0  || data.imagen==null){

   document.getElementById("mostimg").src = "vendor/adminlte/dist/img/sinimg.jpg";
   }

   else{

   document.getElementById("mostimg").src = "storage/"+data.imagen;

   }



    $('#modaleditar').modal('show');

});



$('#btnguardar').on("click" ,(event)=>{
    event.preventDefault();

    let route = $("#frmguardar").attr("action");

    let dataArray = new FormData($("#frmguardar")[0]);

    console.log(dataArray);

    $.ajax({
        method: "POST",
        url: route,
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

    $("#editarRol").prop("disabled", false);

    let dataArray = $("#frmeditar").serializeArray();
    let route = "/usuario/" + dataArray[0].value;
    let _CSRF = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };
    var formData = new FormData($("#frmeditar")[0]);

    let valor =$("#mostimg").attr("src");

    let divisiones = valor.split("/", -2);

    let extraer =divisiones.slice(-1);

    formData.append("imganterior", extraer);
    formData.append("_method", 'PUT');

    $.ajax({
    method: "post",
    url: route,
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    headers: _CSRF,

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
        $('#frmeditar')[0].reset();

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



    $('#usuarios').on('click','.desactivar',function(){

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
                let route="/usuario/"+data['uid'];
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
                                '¡Hecho!',
                                'Su registro ha sido actualizado.',
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

