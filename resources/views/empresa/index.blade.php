@extends('adminlte::page')

@section('content_header')
    <h1>Empresas</h1>
    @section('title', 'Empresas')
@stop


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
 
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DIRECCIÓN</th>
            <th>TELÉFONO</th>
            <th width="280px" class="text-center">ACCIÓN</th>
        </tr>
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
    </table>

  </div>
</div>


@endsection



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
    <form action="{{ route('empresa.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Nombre:</label>
            <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" name="txtNombre">
        </div>
        <div class="form-group">
            <label for="">Dirección:</label>
            <input type="text" class="form-control" id="txtDireccion" placeholder="Ingrese la dirección" name="txtDireccion">
        </div>
        <div class="form-group">
            <label for="">Teléfono:</label>
            <input type="text" class="form-control" id="txtTelefono" placeholder="Ingrese la dirección" name="txtTelefono">
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="submit" class="btn btn-primary">GUARDAR</button>
      </div>
    </form>

    </div>
  </div>
</div>


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function() {
        $("#mensaje").fadeOut(1500);
    },3000);

});
</script>
@stop
