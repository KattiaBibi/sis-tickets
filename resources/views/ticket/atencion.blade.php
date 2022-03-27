@extends('adminlte::page')
@section('content_header')
    <h1>Roles</h1>
    @section('title', 'Roles')
@endsection

@section('css')


@endsection

@section('content')

<div class="card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  <div class="card-footer text-muted">
    2 days ago
  </div>
</div>


@endsection



@section('js')



<script> console.log('¡HOLA!');

</script>
{{-- <script src="{{asset('js/rol.js')}}"></script> --}}



<script>

listar()
</script>
@endsection
