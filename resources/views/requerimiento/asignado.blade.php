@extends('adminlte::page')
@section('content_header')
    <h1>Requerimientos</h1>
    @section('title', 'Requerimientos')
@endsection

@section('css')

@endsection

@section('content')

<div class="card">

  <div class="card-header">

  <div class="row">
        <div class="col-lg-12">
                <h2>Atenciones pendientes</h2>
        </div>
        {{-- <div class="col-lg-2">

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalagregar">AGREGAR</button>

        </div> --}}
    </div>
    </div>

  <div class="card-body">

  @if ($message = Session::get('success'))
        <div class="alert alert-success" id="mensaje">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table id="requerimientos" class="table table-striped table-bordered" style="overflow-x:auto;">
        <thead>
            <tr>
              <th colspan="3" style="text-align: center;">ACCIÓN</th>
              <th>ID</th>
              <th>USUARIO SOLICITANTE</th>
              <th>PROBLEMA</th>
              <th>CREADO</th>

            </tr>
       <tbody>
{{-- CONTENIDO EN REQUERIMIENTO.JS --}}

        </tbody>

    </table>

  </div>
</div>


<div class="modal fade" id="modalagregar" tabindex="-1" role="dialog" aria-labelledby="modalagregar" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo requerimiento</h5>
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


    <form action="{{ route('requerimiento.store') }}" id="frmguardar" >


        <div class="form-group text-center">

            <img src="{{ asset('vendor/adminlte/dist/img/soporte.png') }}" alt=""  style="height: 200px; width: 200px;">
        </div>

      <div class="form-group">
        <label for="">PROBLEMA:</label>

        <input type="hidden" name="usuario_id" value="{{ auth()->user()->id}}" id="">

        <textarea maxlength="200" class="form-control" id="txtProblema" placeholder="Ingrese la descripción de la atención." rows="4" name="problema"></textarea>

        <div id="contador">0/200</div>

    </div>

        <div class="form-group">
            <label for="">DETALLE:</label>

            <textarea maxlength="600" class="form-control" id="txtDetalle" placeholder="Ingrese el detalle del problema." rows="12" name="detalle"></textarea>

            <div id="contador2">0/600</div>

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



  <!-- Modal -->
  <div class="modal fade"  id="modalver" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Ver Detalle de Requerimiento - Usuario responsable : </h5>&nbsp; <h5 class="modal-title" id="vernb"></h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


          <div class="form-row">

            <div class="form-group col-md-6">
              <label for="inputEmail4">PROBLEMA</label>
              <textarea class="form-control" id="verProblema" rows="10" readonly></textarea>

            </div>

            <div class="form-group col-md-6">
              <label for="inputAddress">DETALLE</label>
              <textarea class="form-control" id="verDetalle" rows="10" readonly></textarea>
            </div>


          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal detalle -->

  <!-- Modal -->


  <div class="modal fade bd-example-modal-xl"  id="modaldescripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ingrese alguna descripción de la atención</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


      <form action="{{ route('estado.store') }}" id="frmguardar" >
          @csrf
          <div class="form-group">


            <input type="hidden" class="form-control" id="idregistro"  name="id">

        <label for="inputAddress2">Descripción o notas</label>
        <textarea maxlength="200" class="form-control" id="txtDescripcion" placeholder="Ingrese la descripción de la atención." rows="5" name="descripcion"></textarea>

        <div id="contador3">0/200</div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
          <button  id="btnguardar" class="btn btn-primary">PROCESAR ATENCIÓN</button>
        </div>
      </form>

      </div>
    </div>
  </div>


  <!-- Modal detalle -->


<div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="modaleditar" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualiza registro de requerimiento</h5>
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
           <label for="">PROBLEMA:</label>

           <textarea maxlength="200" class="form-control" id="editarProblema" placeholder="Ingrese el problema." rows="4" name="problema"></textarea>


       </div>

           <div class="form-group">
               <label for="">DETALLE:</label>
               <textarea maxlength="600" class="form-control" id="editarDetalle" placeholder="Ingrese el detalle de su problema." rows="12" name="detalle"></textarea>


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

  </div>

@endsection




@section('js')

<script> console.log('¡HOLA!');

</script>
<script src="{{asset('js/requerimiento.js')}}"></script>



<script>

listarasignados()
</script>
@endsection
