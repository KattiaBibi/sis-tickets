
/* ACA LA USO PARA HACER EL POST Y TRAER LA DATA AHORA SI ME ENTIUENDES ? */
var datatable ;
function listar(){


    datatable= $('#colaboradores').DataTable( {
    "pageLength": 5,
    "destroy": true,
    "async": false,
    responsive: true,
    autoWidth: false,
    "columnDefs": [
        {
        "searchable": false,
        "orderable": false,
        "targets": 0
        }
    ],
    "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    "ajax": {
    "url": "/datatable/colaboradores",
    "method": "post",
    'data' : { '_token' : token_ },
    },
    "columns":[

        {data: 'estado_id',
    render: function(data){

        if(data=="1"){
        return "<button type='button'  id='ButtonDesactivar' class='desactivar edit-modal btn btn-danger botonDesactivar'><span class='fa fa-edit'></span><span class='hidden-xs'>Desactivar</span></button>";

        }

        if(data=="2"){
            return "<button type='button'  id='ButtonActivar' class='desactivar edit-modal btn btn-info botonActivar'><span class='fa fa-edit'></span><span class='hidden-xs'>Activar</span></button>";
        }
    }
    },

    {data:null, render: function () {

        return "<button type='button'  id='ButtonEditar' class='editar edit-modal btn btn-warning botonEditar'><span class='fa fa-edit'></span><span class='hidden-xs'> Editar</span></button>";
        }
    },

    
    {data: 'id',
    render: function(data, type, row, meta) {
    return meta.row+1;}},
    {data: 'nrodocumento'},
    {data: 'nombres'},
    {data: 'apellidos'},
    {data: 'fechanacimiento'},
    {data: 'direccion'},
    {data: 'telefono'},
    {data: 'empresa_area_id'},
    {data: 'empresa_area_id'},


]
} );
}


$('#colaboradores').on('click','.editar',function(){
    var data = datatable.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(datatable.row(this).child.isShown()){//Cuando esta en tamaño responsive
        var data = datatable.row(this).data();
    }
    $('#idregistro').val(data['id']);
    $('#editarNrodoc').val(data['nrodocumento']);
    $('#editarNombre').val(data['nombres']);
      $('#editarApellido').val(data['apellidos']);
    $('#editarFechanac').val(data['fechanacimiento']);
    $('#editarDireccion').val(data['direccion']);
    $('#editarTelefono').val(data['telefono']);

    jQuery.noConflict();
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

