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

    $("#rol").prop("disabled", false);

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
                $("#frmguardar")[0].reset();

                $("#modaleditar").modal("hide");
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
