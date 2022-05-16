@extends('adminlte::page')
@section('content_header')
    <h1>Usuarios</h1>
    @section('title', 'Usuarios')
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


    <table id="usuarios" class="table table-striped table-bordered" style="">
        <thead>
            <tr>
                <th></th>
                <th>USUARIO</th>
                <th>COLABORADOR</th>
                <th>EMAIL</th>
                {{-- <th>CONTRASEÑA</th> --}}
                <th colspan="2" style="text-align: center;">ACCIONES</th>

            </tr>
        </thead>
       <tbody>


        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>USUARIO</th>
                <th>COLABORADOR</th>
                <th>EMAIL</th>
                {{-- <th>CONTRASEÑA</th> --}}

                <th colspan="2" style="text-align: center;">ACCIONES</th>

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
    <form action="{{ route('usuario.store') }}" id="frmguardar" >

        <div class="form-group">
            <label for="">Nombre:</label>
            <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" name="name">
        </div>
        <div class="form-group">
            <label for="">Email:</label>
            <input type="email" class="form-control" id="txtEmail" placeholder="Ingrese la dirección" name="email">
        </div>

        <div class="form-group">
            <label for="">Contraseña:</label>
            <input type="text" class="form-control" id="txtPassword" placeholder="Ingrese una contraseña" name="password">
        </div>

        <div class="form-group">
            <label for="">Colaborador:</label>

            <select name="colaborador_id" id="txtColaboradorId" class="form-control">
              <option value="a">Elegir</option>

              @foreach ($colaboradores as $c)
              <option value="{{ $c->id }}">{{$c->nombres}}</option>
            @endforeach
            </select>

        </div>



        <div class="form-group">
            <label for="">Rol:</label>

            <select name="role" class="form-control" id="editarEmpresaArea">

                <option selected>Elegir</option>

                @foreach ($roles as $r)
                <option value="{{ $r->id }}">{{$r->name}}</option>
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

          <div class="form-group">
              <label for="">Nombre:</label>
              <input type="hidden" class="form-control" id="idregistro"  name="id">

              <input type="text" class="form-control" id="editarNombre" placeholder="Ingrese el nombre" name="name">
          </div>
          <div class="form-group">
              <label for="">Email:</label>
              <input type="text" class="form-control" id="editarEmail" placeholder="Ingrese la dirección" name="email">
          </div>

          <div class="form-group">
            <label for="">Contraseña:</label>
            <input type="text" class="form-control" id="editarContrasena" placeholder="Ingrese la dirección" name="password">
        </div>

        <div class="form-group">
            <label for="">Colaborador:</label>

            <select name="colaborador_id" id="editarColaborador" class="form-control">
              <option value="a">Elegir</option>

              @foreach ($colaboradores as $c)
              <option value="{{ $c->id }}">{{$c->nombres}}</option>
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
<script src="{{asset('js/usuario.js')}}"></script>



<script>

listar();

</script>
@endsection
