console.log('¡HOLA PERFIL!');


$( document ).ready( function() {
    // Mi código de inicialización
    let valor =$("#imagenuser").attr("value");

    let rol=$("#rol").attr("value");
    let empresa_area=$("#rol").attr("value");

     $("#rol").val(rol);
    $("#empresa_area").val(empresa_area);

    if(valor==0  || valor==null){

        document.getElementById("imagenuser").src = "/vendor/adminlte/dist/img/sinimg.jpg";
        }

        else{

        document.getElementById("imagenuser").src = "/storage/"+ valor;

        }


} )


$('#btnactualizaruser').on("click" ,(event)=>{
    event.preventDefault();

    let dataArray = $("#frmeditar").serializeArray();
    let route = "/usuario/" + dataArray[0].value;
    let _CSRF = { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') };
    var formData = new FormData($("#frmeditar")[0]);


    let valor =$("#imagenuser").attr("value");


    let divisiones = valor.split("/", -1);

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


$("#btnactualizarcolab").on("click", (event) => {
    event.preventDefault();


    let dataArray = $("#frmeditarcolab").serializeArray();
    let route = "/colaborador/" + dataArray[0].value;
    dataArray.push({ name: "_token", value: token_ });
    console.log(dataArray[0].value);

    $.ajax({
        method: "put",
        url: route,
        data: dataArray,

        success: function (Response) {
            if (Response == 1) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Editado correctamente",
                    showConfirmButton: false,
                    timer: 1500,
                });

                datatable.ajax.reload(null, false);
                
            } else {
                alert("no editado");
            }
        },
        error: (response) => {
            console.log(response);
            $.each(response.responseJSON.errors, function (key, value) {
                response.responseJSON.errors[key].forEach((element) => {
                    console.log(element);
                    toastr.error(element);
                });
            });
        },
    });
});


$(".retirar").on("click", function (e){


    $("#imn").val(null);

    $('#imag').hide();
    $('#imag').removeAttr("src");

    $(".retirar").hide();

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
