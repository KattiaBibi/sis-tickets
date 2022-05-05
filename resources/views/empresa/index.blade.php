@extends('adminlte::page')
@section('content_header')
<h1>Empresas</h1>
@section('title', 'Empresas')
@endsection

@section('css')

<style>
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


    <table id="empresas" class="table table-striped table-bordered" style="">
      <thead>
        <tr>
          <th>ID</th>
          <th>RUC</th>
          <th>NOMBRE</th>
          <th>DIRECCIÓN</th>
          <th>TELÉFONO</th>
          <th colspan="2" style="text-align: center;">ACCIÓN</th>

        </tr>
      </thead>
      <tbody>


      </tbody>
      <tfoot>
        <tr>
          <th>ID</th>
          <th>RUC</th>
          <th>NOMBRE</th>
          <th>DIRECCIÓN</th>
          <th>TELÉFONO</th>
          <th>COLOR</th>
          <th colspan="2">ACCIÓN</th>

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
        <form action="{{ route('empresa.store') }}" id="frmguardar">

          <div class="form-group">
            <label for="">RUC:</label>
            <input type="text" class="form-control" id="txtRuc" maxlength="11" placeholder="Ingrese el nombre" name="ruc">

          </div>
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
          <div class="form-group">
            <label for="txtColor">Color:</label>
            <input type="color" name="color" id="txtColor" class="form-control">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button id="btnguardar" class="btn btn-primary">GUARDAR</button>
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
        <form id="frmeditar">

          <div class="form-group">
            <label for="">RUC:</label>
            <input type="hidden" class="form-control" id="idregistro" name="id">

            <input type="text" class="form-control" maxlength="11" id="editarRuc" placeholder="Ingrese el nombre" name="ruc">
          </div>


          <div class="form-group">
            <label for="editarNombre">Nombre:</label>
            <input type="text" class="form-control" id="editarNombre" placeholder="Ingrese el nombre" name="nombre">
          </div>
          <div class="form-group">
            <label for="editarDireccion">Dirección:</label>
            <input type="text" class="form-control" id="editarDireccion" placeholder="Ingrese la dirección" name="direccion">
          </div>
          <div class="form-group">
            <label for="editarTelefono">Teléfono:</label>
            <input type="text" class="form-control" id="editarTelefono" placeholder="Ingrese la dirección" name="telefono">
          </div>
          <div class="form-group">
            <label for="editarColor">Color:</label>
            <input type="color" name="color" id="editarColor" class="form-control">
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



<div id="chart-container"></div>


@endsection


@section('js')

<script src="{{asset('js/empresa.js')}}"></script>

<script>
  listar();
</script>

<script>
  (function($) {
    $(function() {
      var ds = {
        'name': 'Janina Rivas Cabrejos',
        'title': 'Jefa de Area (Compusistel)',
        'children': [{
            'name': 'Bibiana Cruzado',
            'title': 'Asistente Sistemas'
          },
          {
            'name': 'David MC',
            'title': 'Asistente Sistemas',
          },
          {
            'name': 'Maryori',
            'title': 'Asistente Soporte'
          },
          {
            'name': 'JuanMDH',
            'title': 'Asistente Soporte'
          }
        ]
      };

      var oc = $('#chart-container').orgchart({
        'data': ds,
        'depth': 2,
        'nodeContent': 'title'
      });

    });
  })(jQuery);
</script>

@endsection