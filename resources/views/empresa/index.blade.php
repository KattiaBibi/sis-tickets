@extends('adminlte::page')

@section('content_header')
    <h1>Empresas</h1>
    @section('title', 'Empresas')
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"/>

    
@endsection

@section('content')

<div class="card">  
      
  <div class="card-header">

  <div class="row">
        <div class="col-lg-10">
                <h2>Listar</h2>
        </div>
        <div class="col-lg-2">

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter">AGREGAR</button>
    
        </div>
    </div>
    </div>

  <div class="card-body">

  @if ($message = Session::get('success'))
        <div class="alert alert-success" id="mensaje">
            <p>{{ $message }}</p>
        </div>
    @endif
 

    <table id="empresas" class="table table-striped table-bordered" style="">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>DIRECCIÓN</th>
                <th>TELÉFONO</th>
                <th width="280px" class="text-center">ACCIÓN</th>
          
            </tr>
        </thead>
        {{-- <tbody>
            @php
            $i = 0;
        @endphp
        @foreach ($empresas as $e)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $e->nombre }}</td>
                <td>{{ $e->direccion }}</td>
                <td>{{ $e->telefono }}</td>
                <td class="text-center">
                    <form action="{{ route('empresa.destroy',$e->id) }}" method="POST">
                   
                        <a class="btn btn-primary btn-sm" href="{{ route('empresa.edit',$e->id) }}">EDITAR</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">ELIMINAR</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody> --}}
        <tfoot>
            <tr>
      <th>ID</th>
            <th>NOMBRE</th>
            <th>DIRECCIÓN</th>
            <th>TELÉFONO</th>
            <th width="280px" class="text-center">ACCIÓN</th>
              
            </tr>
        </tfoot>
    </table>

  </div>
</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Ups!</strong> Hubo algunos problemas con tus inputs.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('empresa.store') }}" id="frmguardar" >
        @csrf
        <div class="form-group">
            <label for="">Nombre:</label>
            <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" name="nombre">
        </div>
        <div class="form-group">
            <label for="">Dirección:</label>
            <input type="text" class="form-control" id="txtDireccion" placeholder="Ingrese la dirección" name="direccion">
        </div>
        <div class="form-group">
            <label for="">Teléfono:</label>
            <input type="text" class="form-control" id="txtTelefono" placeholder="Ingrese la dirección" name="telefono">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button  id="btnguardar" class="btn btn-primary">GUARDAR</button>
      </div>
    </form>
    
    </div>
  </div>
</div>


@endsection




@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>   
<script> console.log('¡HOLA!'); </script>


<script>

$(document).ready(function() {
    setTimeout(function() {
        $("#mensaje").fadeOut(1500);
    },3000);


    $('#empresas').DataTable( {
        "ajax": "{{route(datatable.empresa)}}",
        "columns":[

        {data: 'nombre'},
        {data: 'direccion'},
        {data: 'telefono'},

        ]
    } );

});



let _token="{{csrf_token() }}"
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
            $('#frmguardar')[0].reset()
   
        Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Datos Guardados correctamente',
        showConfirmButton: false,
        timer: 1500
        })

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



</script>
@endsection
