@extends('adminlte::page')
@section('content_header')
    <h1>Requerimientos</h1>
    @section('title', 'Requerimientos')
@endsection

@section('css')

<style>


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

    <table id="tickets" class="table table-striped table-bordered" style="overflow-x:auto;">
        <thead>
            <tr>
              <th colspan="3" style="text-align: center;">ACCIÓN</th>
              <th>ID</th>
              <th>USUARIO SOLICITANTE</th>
              <th>PROBLEMA</th>
              <th>CREADO</th>

            </tr>
        </thead>
       <tbody>
{{-- CONTENIDO EN TICKET.JS --}}

        </tbody>

    </table>

  </div>
</div>


<div class="modal fade" id="modalagregar" tabindex="-1" role="dialog" aria-labelledby="modalagregar" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo requerimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



    <form action="{{ route('ticket.store') }}" id="frmguardar" >


        <div class="form-group text-center">

            <img src="{{ asset('vendor/adminlte/dist/img/soporte.png') }}" alt=""  style="height: 200px; width: 200px;">
        </div>

            <div class="form-group">
         <label for="">AVANCE:</label>

                <input class="progress-bar progress-bar-striped progress-bar-animated" type="range" id="temperatura" min="0" value="0" max="100" step="10" style="width: 100%;">
                <span id="temp">0</span><span>%</span>


            </div>


        <div class="form-group">
            <label for="">TÍTULO:</label>

            <input type="hidden" name="usuario_id" value="{{ auth()->user()->id}}" id="">

            <textarea maxlength="200" class="form-control" id="txtProblema" placeholder="Ingrese la descripción de la atención." rows="3" name="problema"></textarea>

            <div id="contador">0/200</div>

        </div>


    <div class="form-row">

        <div class="form-group col-md-6">
            <label for="">EMPRESA</label>

            <select class="form-control" id="empresa" name="">
                <option value="a">Elegir</option>

                @foreach ($empresas as $e)
                <option value="{{ $e->id }}">{{$e->nombre}}</option>
              @endforeach
              </select>


        </div>

        <div class="form-group col-md-6">
      <label for="">SERVICIO</label>

      <select class="form-control" id="servicio" name="empresa_servicio_id">
           <option value="a">¡Seleccione una empresa!</option>

        </select>

        </div>

      </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="">ENCARGADO</label>

            <select class="form-control" id="empresa" name="">
                <option value="a">Elegir</option>

                @foreach ($empresas as $e)
                <option value="{{ $e->id }}">{{$e->nombre}}</option>
              @endforeach
              </select>
        </div>

        <div class="form-group col-md-6">
            <label for="">PERSONAL</label>

            <select class="form-control" id="empresa" name="">
                <option value="a">Elegir</option>

                @foreach ($empresas as $e)
                <option value="{{ $e->id }}">{{$e->nombre}}</option>
              @endforeach
              </select>
        </div>


      </div>


<div class="row">

    <div class="form-group col-md-6">
    <label for="">ESTADO</label>

    <select class="form-control" id="empresa" name="">
        <option value="a">Elegir</option>

        @foreach ($empresas as $e)
        <option value="{{ $e->id }}">{{$e->nombre}}</option>
      @endforeach
      </select>

</div>

<div class="form-group col-md-6">
    <label for="">PRIORIDAD</label>

    <select class="form-control" id="empresa" name="">
        <option value="a">Elegir</option>

        @foreach ($empresas as $e)
        <option value="{{ $e->id }}">{{$e->nombre}}</option>
      @endforeach
      </select>

</div>
</div>


<div class="form-group">

    <label for="">DESCRIPCIÓN:</label>

        <textarea maxlength="600" class="form-control" id="txtDetalle" placeholder="Ingrese el detalle del problema." rows="10" name="detalle"></textarea>

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
          <h5 class="modal-title" id="exampleModalLongTitle">Ver Detalle de Ticket - Usuario responsable : </h5>&nbsp; <h5 class="modal-title" id="vernb"></h5>

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
  <div class="modal fade bd-example-modal-xl"  id="modalatender" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Generar atención</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form  id="frmguardaratencion" >

              <input type="hidden" name="usuarioadmin_id" value="{{ auth()->user()->id}}" id="">

                <div class="form-row">

                  <div class="form-group col-md-3">
                    <label for="inputEmail4">PROBLEMA</label>
                    <textarea class="form-control" id="mostrarProblema" rows="8" readonly></textarea>

                  </div>

                  <div class="form-group col-md-6">
                    <label for="inputAddress">DETALLE</label>
                    <textarea class="form-control" id="mostrarDetalle" rows="8" readonly></textarea>
                  </div>

                  <div class="form-group text-center col-md-3">
                    <p>
                     <img src="{{ asset('vendor/adminlte/dist/img/reparacion.png') }}" alt=""  style="height: 200px; width: 200px;">
                    </p>

                  </div>

                </div>

                <div class="form-row">

                  <div class="form-group col-md-4">
                    <label for="inputState">Servicio</label>

                <select class="form-control" name="servicio_id">
                  <option selected>Elegir</option>

                  @foreach ($servicios as $s)
                  <option value="{{ $s->id }}">{{$s->nombre}}</option>
                @endforeach
                </select>

                  </div>

                  <div class="form-group col-md-4">
                    <label for="inputState">Prioridad</label>

                    <select class="form-control" name="prioridad_id">
                      <option selected>Elegir</option>

                      @foreach ($prioridades as $p)
                      <option value="{{ $p->id }}">{{$p->nombre}}</option>
                    @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">Estado</label>
                  <select class="form-control" name="estado_id">
                  <option selected>Elegir</option>

                  @foreach ($estados as $e)
                  <option value="{{ $e->id }}">{{$e->nombre}}</option>
                @endforeach
                </select>
                  </div>
                </div>



                <div class="form-row">

                  <div class="form-group col-md-12">
                    <label for="inputAddress2">Descripción</label>
                    <textarea maxlength="200" class="form-control" id="txtDescripcion" placeholder="Ingrese la descripción de la atención." rows="3" name="descripcion"></textarea>

                    <div id="contador3">0/200</div>
                  </div>

                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

          <button  id="btnguardaratencion" class="btn btn-primary">GUARDAR</button>

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
            <h5 class="modal-title" id="exampleModalLabel">Actualiza registro de ticket</h5>
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
<script src="{{asset('js/ticket.js')}}"></script>

<script>

listar()
</script>
@endsection