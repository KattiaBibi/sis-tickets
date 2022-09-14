@extends('adminlte::page')
@section('content_header')
<h1>Empresas</h1>
@section('title', 'Empresas')
@endsection

@section('css')

<style>
  td.details-control {
    background: transparent url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
  }

  tr.shown td.details-control {
    background: transparent url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
  }

  td.details-control2 {
    background: transparent url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
  }

  tr.shown td.details-control2 {
    background: transparent url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
  }

  div.dataTables_wrapper {
    width: 100% !important;
  }

  .test {
    width: 8% !important;
  }

  .color-empresa {
    display: inline-block;
    padding: 3px;
    border-radius: 13px;
  }

  #chart-container {
    font-family: Arial;
    height: 420px;
    border: 1px solid #aaa;
    overflow: auto;
    text-align: center;
  }

  #github-link {
    display: inline-block;
    background-image: url("https://dabeng.github.io/OrgChart/img/logo.png");
    background-size: cover;
    width: 64px;
    height: 64px;
    position: absolute;
    top: 0;
    left: 0;
  }
</style>

@endsection

@section('content')

<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-lg-10">
        <h2>Listar</h2>
      </div>
      <div class="col-lg-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalEmpresa" id="btnRegistrarEmpresa">AGREGAR</button>
      </div>
    </div>
  </div>

  <div class="card-body">

    <div class="table-responsive">
      <table id="tablaEmpresas" class="table table-bordered table-sm">
        <thead>
          <tr>
            <th></th>
            <th>ID</th>
            <th>Ruc</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Color</th>
            <th colspan="2" style="text-align: center;">Opciones</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>

@include('empresa.forms.empresa')
@include('empresa.forms.area')
@include('empresa.forms.colaborador')


<!-- <div class="btn-group mb-2" role="group" aria-label="CRUD Buttons">
  <button type="button" class="btn btn-sm btn-success" id="btnCrear" onclick="demo_create()">CREAR</button>
  <button type="button" class="btn btn-sm btn-warning" id="btnEditar" onclick="demo_rename()">EDITAR</button>
  <button type="button" class="btn btn-sm btn-danger" id="btnEliminar" onclick="demo_delete()">ELIMINAR</button>
</div>

<div class="mb-2">
  <input type="text" id="searchTreeView" class="form-control form-control-sm w-auto">
</div>

<div id="treeView"></div> -->

@endsection


@section('js')
<script src="{{asset('js/empresa.js')}}"></script>

<script>
  listar();
</script>

@endsection
