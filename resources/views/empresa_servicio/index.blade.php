@extends('adminlte::page')
@section('content_header')
<h1>Empresas y Servicios</h1>
@section('title', 'Empresas y Servicios')
@endsection
<style>
  td.details-control {
    background: transparent url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
  }

  tr.shown td.details-control {
    background: transparent url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
  }

  .test {
    width: 8% !important;
  }
</style>
@section('css')
@endsection

@section('content')

@include('empresa_servicio.tables.index')
@include('empresa_servicio.forms.servicio')

@endsection

@section('js')
<script src="{{asset('js/empresa_servicio.js')}}"></script>
<script>
  listar()
</script>
@endsection