@extends('adminlte::page')

<!-- @section('title', 'Dashboard') -->

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
 

<div class="card">
  <div class="card-header">
  <h1 class="card-title">Empresas</h1>
  </div>
  <div class="card-body">
    <p class="card-text">Nuestro listado de empresas</p>

  </div>

  <div class="pull-right">
                <a class="btn btn-success" href="{{ route('empresa.crear') }}"> Crear nueva empresa</a>
            </div>

  <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
            <th>DIRECCIÓN</th>
            <th>TELÉFONO</th>
            <th width="280px">ACCIÓN</th>
        </tr>
        @foreach ($empresa as $empresa)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $empresa->nombre }}</td>
            <td>{{ $empresa->direccion }}</td>
            <td>{{ $empresa->telefono }}</td>
     
        </tr>
        @endforeach
    </table>
  
  
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop