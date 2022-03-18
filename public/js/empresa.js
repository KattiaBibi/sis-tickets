
/* ACA LA USO PARA HACER EL POST Y TRAER LA DATA AHORA SI ME ENTIUENDES ? */

        var datatable= $('#empresas').DataTable( {
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
            return "<button type='button' class='btn btn-danger btn-sm'>DESACTIVAR</button>";
            }

            if(data=="2"){
            return "<button type='button' class='btn btn-success btn-sm'>ACTIVAR</button>";
            }
        }
        },

        {data:'id', render: function (data) {

            return '<button type="button" id="ButtonEditar" class="editar edit-modal btn btn-warning botonEditar"><span class="fa fa-edit"></span><span class="hidden-xs"> Editar</span></button>';
            }
        },


]
} );

var editar = function(tbody, table){
    $(tbody).on("click","button.editar", function(){
      if(table.row(this).child.isShown()){
          var data = table.row(this).data();
      }else{
          var data = table.row($(this).parents("tr")).data();
      }


      $('#editarNombre').val(data['nombre']);
      $('#editarDireccion').val(data['direccion']);
      $('#editarTelefono').val(data['telefono']);
      jQuery.noConflict();
      $('#modaleditar').modal('show');


    })
  }

editar("#empresas tbody",datatable);





$('#btnguardar').on("click" ,(event)=>{
    event.preventDefault();

let route=$('#frmguardar').attr("action");
let dataArray=$('#frmguardar').serialize();
console.log(token_)
let data={
    _token:token_,
}

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

        $('#empresas').DataTable().ajax.reload(null,false);
        $('#frmguardar')[0].reset()


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



// $("a.abrirmodal").clic(function(){
//     //Capturamos el valor del id para enviarlo al modal
//     let id = $(this).attr('id');
//     //Pasamos el id al campo input hiddien del modal.
//     $("input#idmodal").val(id);
//     });



    $("#botoon").on("click" ,(event)=>{
       event.preventDefault();

        console.log("gf");


    });
