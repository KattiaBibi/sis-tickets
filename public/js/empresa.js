var tabla;
/* ACA LA USO PARA HACER EL POST Y TRAER LA DATA AHORA SI ME ENTIUENDES ? */
function listar(){

   tabla= $('#empresas').DataTable( {
            "pageLength": 10,
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

                return "<button type='button' class='btn btn-success'  id="+data+" data-toggle='modal' data-target='#modaleditar'>"+data+"</button>"
            }
        },


        ]
    } );
}

$('#btnguardar').on("click" ,(event)=>{
    event.preventDefault();

let route=$('#frmguardar').attr("action");
let dataArray=$('#frmguardar').serialize();
console.log(_token)
let data={
    _token:_token,
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
        title: 'Datos Guardados correctamente',
        showConfirmButton: false,
        timer: 1500
        })

        $('#empresas').DataTable().ajax.reload();
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
