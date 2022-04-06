@extends('adminlte::page')
@section('content_header')
    <h1>Roles</h1>
    @section('title', 'Roles')
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


    <table id="roles" class="table table-striped table-bordered" style="">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>

                <th colspan="" style="text-align: center;">ACCIÓN</th>

            </tr>
        </thead>
       <tbody>


        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>

                <th colspan="" style="text-align: center;">ACCIÓN</th>

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
    <form action="{{ route('rol.store') }}" id="frmguardar" >

        <div class="form-group">
            <label for="">Nombre:</label>
            <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" name="name">
        </div>

        <div class="form-group">
            <label for="">Permisos:</label>

            @foreach ($permissions as $p)

            <div class="form-check">

                <input class="form-check-input" type="checkbox" value="{{$p->id}}" name="permission[]" id="checkPermisos">
                <label class="form-check-label" for="flexCheckDefault">{{$p->description}}.</label>
              </div>

          @endforeach

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
            <label for="">Permisos:</label>

            @foreach ($permissions as $p)

            <div class="form-check">



                <input class="form-check-input" type="checkbox" value="{{$p->id}}" name="permission[]" id="editarPermisos">
                <label class="form-check-label" for="flexCheckDefault">{{$p->description}}.</label>
              </div>

          @endforeach

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
<script src="{{asset('js/rol.js')}}"></script>



<script>

listar()
</script>
@endsection
