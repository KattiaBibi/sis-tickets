@extends('adminlte::page')
@section('content_header')
    <h1>Empresas con Servicios</h1>
    @section('title', 'Empresas')
@endsection

@section('css')

@endsection

@section('content')

<div class="card">

  <div class="card-header">

  <div class="row">
        <div class="col-lg-10">
                <h2>Listar</h2>
        </div>
        <div class="col-lg-2">

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalagregar">AGREGAR</button>

        </div>
    </div>
    </div>

  <div class="card-body">

  @if ($message = Session::get('success'))
        <div class="alert alert-success" id="mensaje">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table id="empresas_servicios" class="table table-striped table-bordered" style="">
        <thead>
            <tr>
                <th></th>
                <th>EMPRESA</th>
                <th>SERVICIO</th>
                <th  style="text-align: center;">EDITAR</th>

            </tr>
        </thead>
       <tbody>


        </tbody>
        <tfoot>
            <tr>
              <th></th>
              <th>EMPRESA</th>
              <th>ÁREA</th>
              <th  style="text-align: center;">EDITAR</th>

            </tr>
        </tfoot>
    </table>

  </div>
</div>


<div class="modal fade" id="modalagregar" tabindex="-1" role="dialog" aria-labelledby="modalagregar" aria-hidden="true">
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
    <form action="{{ route('empresa_servicio.store') }}" id="frmguardar" >

        <div class="form-group">
            <label for="">Empresa:</label>

            <select name="empresa_id" class="form-control">
              <option selected>Elegir</option>

              @foreach ($empresas as $e)
              <option value="{{ $e->id }}">{{$e->nombre}}</option>
            @endforeach
            </select>

        </div>

        <div class="form-group">
          <label for="">Servicio:</label>

          <select name="servicio_id" class="form-control">
            <option selected>Elegir</option>

            @foreach ($servicios as $s)
            <option value="{{ $s->id }}">{{$s->nombre}}</option>
          @endforeach
          </select>

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



<div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="modaleditar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Actualiza registro</h5>
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
      <form  id="frmeditar">


     <input type="hidden" class="form-control" id="idregistro"  name="id">
     
        <div class="form-group">
          <label for="">Empresa:</label>

          <select name="empresa_id" id="editarEmpresa" class="form-control">
            <option value="a">Elegir</option>

            @foreach ($empresas as $e)
            <option value="{{ $e->id }}">{{$e->nombre}}</option>
          @endforeach
          </select>

      </div>

      <div class="form-group">
        <label for="">Servicio:</label>

        <select name="servicio_id" id="editarServicio" class="form-control">
          <option value="a">Elegir</option>

          @foreach ($servicios as $s)
          <option value="{{ $s->id }}">{{$s->nombre}}</option>
        @endforeach
        </select>

    </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
          <button type="submit" id="btnactualizar" class="btn btn-primary">EDITAR</button>
        </div>
      </form>

      </div>
    </div>
  </div>

@endsection




@section('js')

<script> console.log('¡HOLA!');

</script>
<script src="{{asset('js/empresa_servicio.js')}}"></script>



<script>

listar()
</script>
@endsection
