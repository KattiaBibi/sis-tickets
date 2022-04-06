
var datatable ;
function listar(){


    datatable= $('#permisos').DataTable( {
        "pageLength": 5,
        "destroy": true,
        "async": false,
        responsive: true,
        autoWidth: false,
        dom: 'Bfrtip',
        lengthChange: false,
    
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
    "url": "/datatable/permisos",
    "method": "post",
    'data' : { '_token' : token_ },
    },
    "columns":[

    {data: 'id',
    render: function(data, type, row, meta) {
    return meta.row+1;}},

    {data: 'name'},
    {data: 'description'},
    {data:null, render: function (data) {

        return "<button type='button'  id='ButtonEditar' class='editar edit-modal btn btn-warning botonEditar'><span class='fa fa-edit'></span><span class='hidden-xs'> Editar</span></button>";
        }
    },


]
} );
}


// $('#estado').on('click','.editar',function(){
//     var data = datatable.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
//     if(datatable.row(this).child.isShown()){//Cuando esta en tamaño responsive
//         var data = datatable.row(this).data();
//     }
//     $('#idregistro').val(data['id']);
//     $('#editarNombre').val(data['nombre']);

//     jQuery.noConflict();
//     $('#modaleditar').modal('show');

// })



// $('#btnguardar').on("click" ,(event)=>{
//     event.preventDefault();

// let route=$('#frmguardar').attr("action");
// let dataArray=$('#frmguardar').serializeArray()
// dataArray.push({name:'_token',value:token_})
// console.log(dataArray)

// $.ajax({
//     "method":'POST',
//     "url": route,
//     "data": dataArray,


//     "success":function(Response){

//         if(Response==1){

//         Swal.fire({
//         position: 'top-end',
//         icon: 'success',
//         title: 'Datos guardados correctamente',
//         showConfirmButton: false,
//         timer: 1500
//         })

//        datatable.ajax.reload(null,false);
//         $('#frmguardar')[0].reset()
//         jQuery.noConflict();
//         $('#modalagregar').modal('hide');

//         }
//             else{

//                 alert("no guardado");
//             }


//     },'error':(response)=>{
//         console.log(response)
//        $.each(response.responseJSON.errors, function (key, value){
//         response.responseJSON.errors[key].forEach(element => {

//             console.log(element);
//             toastr.error(element);

//            });
//        });
//     }
// })

// })



// $('#btnactualizar').on("click" ,(event)=>{
//     event.preventDefault();

//     let dataArray=$('#frmeditar').serializeArray();
//     let route="/estado/"+dataArray[0].value;
// dataArray.push({name:'_token',value:token_})
// console.log(dataArray[0].value)

// $.ajax({
//     "method":'put',
//     "url": route,
//     "data": dataArray,


//     "success":function(Response){

//         if(Response==1){

//         Swal.fire({
//         position: 'top-end',
//         icon: 'success',
//         title: 'Editado correctamente',
//         showConfirmButton: false,
//         timer: 1500
//         })

//       datatable.ajax.reload(null,false);
//         $('#frmguardar')[0].reset();
//         jQuery.noConflict();
//         $('#modaleditar').modal('hide');

//         }
//             else{

//                 alert("no editado");
//             }


//     },'error':(response)=>{
//         console.log(response)
//        $.each(response.responseJSON.errors, function (key, value){
//         response.responseJSON.errors[key].forEach(element => {

//             console.log(element);
//             toastr.error(element);

//            });
//        });
//     }
// })

// });



