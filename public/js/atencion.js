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
        title: 'Atención generada',
        showConfirmButton: false,
        timer: 1500
        })

        window.location.replace("/tickets_asignados");
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
