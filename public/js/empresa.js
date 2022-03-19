
/* ACA LA USO PARA HACER EL POST Y TRAER LA DATA AHORA SI ME ENTIUENDES ? */
var datatable ;
function listar(){


    datatable= $('#empresas').DataTable( {
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
    "url": "/datatable/empresas",
    "method": "post",
    'data' : { '_token' : token_ },
    },
    "columns":[

    {data: 'id',
    render: function(data, type, row, meta) {
    return meta.row+1;}},

    {data: 'nombre'},
    {data: 'direccion'},
    {data: 'telefono'},
    {data: 'estado_id',
    render: function(data){

        if(data=="1"){
        return "<button type='button'  id='ButtonDesactivar' class='desactivar edit-modal btn btn-danger botonDesactivar'><span class='fa fa-edit'></span><span class='hidden-xs'>Desactivar</span></button>";

        }

        if(data=="2"){
            return "<button type='button'  id='ButtonActivar' class='aesactivar edit-modal btn btn-danger botonActivar'><span class='fa fa-edit'></span><span class='hidden-xs'>Activar</span></button>";
        }
    }
    },

    {data:'id', render: function (data) {

        return "<button type='button'  id='ButtonEditar' class='editar edit-modal btn btn-warning botonEditar'><span class='fa fa-edit'></span><span class='hidden-xs'> Editar</span></button>";
        }
    },


]
} );
}


$('#empresas').on('click','.editar',function(){
    var data = datatable.row($(this).parents('tr')).data();//Detecta a que fila hago click y me captura los datos en la variable data.
    if(datatable.row(this).child.isShown()){//Cuando esta en tamaño responsivo
        var data = datatable.row(this).data();
    }
    $('#idregistro').val(data['id']);
    $('#editarNombre').val(data['nombre']);
    $('#editarDireccion').val(data['direccion']);
    $('#editarTelefono').val(data['telefono']);
    jQuery.noConflict();
    $('#modaleditar').modal('show');

})






var editar = function(tbody, table){
    $(tbody).on("click","button.editar", function(){
      if(table.row(this).child.isShown()){
          var data = table.row(this).data();
      }else{
          var data = table.row($(this).parents("tr")).data();
      }

      $('#idregistro').val(data['id']);
      $('#editarNombre').val(data['nombre']);
      $('#editarDireccion').val(data['direccion']);
      $('#editarTelefono').val(data['telefono']);
      jQuery.noConflict();
      $('#modaleditar').modal('show');


    })
  }
/*
editar("#empresas tbody",datatable); */


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
    let route="/empresa/"+dataArray[0].value;
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


$('#btnactualizar').on("click" ,(event)=>{
    event.preventDefault();



});
