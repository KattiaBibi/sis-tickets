@extends('adminlte::page')
@section('content_header')
    <h1>Requerimientos</h1>
    @section('title', 'Requerimientos')
@endsection

@section('css')

<style>

.select2-container--default .select2-selection--multiple .select2-selection__choice{

    color: rgb(172, 30, 30) !important;

}
</style>

@endsection

@section('content')

<div class="card">

  <div class="card-header">

  <div class="row">
        <div class="col-lg-2">
                <h2>Listar</h2>
        </div>

        <div class="col-lg-3">

            <select class="form-control" id="filtros">
                <option value="todos" selected>TODOS</option>
                <option value="pendiente">PENDIENTE</option>
                <option value="en espera">EN ESPERA</option>
                <option value="en proceso">EN PROCESO</option>
                <option value="culminado">CULMINADO</option>
                <option value="cancelado">CANCELADO</option>
              </select>
    </div>

        <div class="col-lg-7" style="text-align: right;">

            @can('admin.requerimientos.agregar')

            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalagregar">AGREGAR</button>

            @endcan



        </div>
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
                <th colspan="2">OPCIONES</th>
                <th>ID</th>
                <th>TITULO</th>
                <th>SOLICITANTE</th>
                <th>ENCARGADO(S)</th>
                <th>ASIGNADO(S)</th>
                <th>EMPRESA</th>
                <th>SERVICIO</th>
                <th>AVANCE</th>
                <th>ESTADO</th>
                <th>PRIORIDAD</th>
                <th>FECHA</th>
            </tr>
        </thead>
       <tbody>
{{-- CONTENIDO EN REQUERIMIENTO.JS --}}

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


{{-- <form action="{{ route('requerimiento.store') }}" id="frmguardar" enctype="multipart/form-data" method="post">

@csrf

<div class="form-group col-md-6">

    <label for="">IMAGEN</label>

    <input type="file"  accept="image/*" class="form-control-file" id="img" name="imagen">

    <img id="imagenPrevisualizacion" class="mt-2" style="width: 350px;height: 200;">

</div>

<button type="submit" class="btn btn-primary">ENVIAR</button>


</form> --}}

 <form action="{{ route('requerimiento.store') }}" id="frmguardar" enctype="multipart/form-data">
    @csrf

        <div class="form-group text-center">

            <img src="{{ asset('vendor/adminlte/dist/img/soporte.png') }}" alt=""  style="height: 200px; width: 200px;">
        </div>


        <div class="form-group">
            <label for="">TÍTULO:</label>

            <input type="hidden" name="usuarioregist_id" value="{{ auth()->user()->id}}" id="">

            <textarea maxlength="200" class="form-control" id="txtProblema" placeholder="Ingrese la descripción de la atención." rows="3" name="titulo"></textarea>

            <div id="contador">0/200</div>

        </div>


        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="">EMPRESA</label>

                <select class="form-control" id="empresa" name="">
                    <option value="a" >Elegir</option>

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
          <label for="">GERENTE(S) RESPONSABLE(S)</label>

          <select style="width:100%" class="js-example-basic-multiple" id="gerente" name="usuarioencarg_id[]" multiple="multiple" lang="es">



            </select>

            </div>


            <div class="form-group col-md-6">
                <label for="">PRIORIDAD</label>

                <select class="form-control" id="" name="prioridad">
                    <option value="1">Elegir</option>

                    <option value="alta">ALTA</option>
                    <option value="media">MEDIA</option>
                    <option value="baja">BAJA</option>


                  </select>

            </div>

          </div>


 <div class="row">

        <div class="form-group col-md-6">


            <label for="">DESCRIPCIÓN:</label>

                <textarea maxlength="600" class="form-control" id="txtDetalle" placeholder="Ingrese el detalle del problema." rows="10" name="descripcion"></textarea>

                <div id="contador2">0/600</div>

        </div>

        <div class="form-group col-md-6">

            <label for="">IMAGEN</label>

            <input type="file"  accept="image/*" class="img form-control-file" id="img" name="imagenpost">

            <img id="prev" class="imagenPrevisualizacion mt-2" style="width: 350px;height: 200;">

        </div>

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
                     <img src="{{ asset('vendor/adminlte/dist/img/req.png') }}" alt=""  style="height: 200px; width: 200px;">
                    </p>

                  </div>

                </div>

                <div class="form-row">

                  <div class="form-group col-md-4">
                    <label for="inputState">Servicio</label>

                <select class="form-control" name="servicio_id">
                  <option selected disabled>Elegir</option>

                  @foreach ($servicios as $s)
                  <option value="{{ $s->id }}">{{$s->nombre}}</option>
                @endforeach
                </select>

                  </div>

                  <div class="form-group col-md-4">
                    <label for="inputState">Prioridad</label>

                    <select class="form-control" name="prioridad_id">
                      <option selected disabled>Elegir</option>

                      <option value=""></option>

                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">Estado</label>
                  <select class="form-control" name="estado">
                  <option selected disabled>Elegir</option>
                  <option value=""></option>

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

  <!-- Modal editar -->


<div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="modaleditar" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualiza registro de requerimiento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

      <form  id="frmeditar">

        <input type="hidden" class="form-control" id="idregistro"  name="id">


        <div class="form-row">

            <div class="form-group text-center col-md-4">

                <input type="file"  accept="image/*" class="img form-control-file" id="imn" name="">

                <img id="imag" class="imagenPrevisualizacion mt-2" style="width: 200px;height: 200px;">

            </div>



            <div class="form-group text-center row justify-content-center align-items-end col-md-4">

                   <img src="{{ asset('vendor/adminlte/dist/img/req.png') }}" alt=""  id="mostimg" style="height: 200px; width: 200px;">

                </div>


            <div class="form-group text-center row justify-content-center align-items-center col-md-4">

                <button type="button" id="" class="btn btn-primary">CONSERVAR IMAGEN</button>

            </div>

        </div>


        <div class="form-row">

            <div class="form-group col-md-12">
                <label for="">USUARIO SOLICITANTE:</label>
                <input type="hidden" class="form-control" name="usuarioregist_id" id="UsuarioSolicitante2" readonly>
                <input class="form-control"  type="text" value=""  id="UsuarioSolicitante" readonly>

            </div>

            <div class="form-group col-md-12">
                <label for="">GERENTE(S) RESPONSABLE(S)</label>
            <input class="form-control"  type="text" name="" id="UsuarioResponsable" readonly>

            </div>


          </div>

        <div class="form-row">

            <div class="form-group col-md-12">
                <label for="">TÍTULO:</label>

                <textarea maxlength="200" readonly class="form-control" id="editarTitulo" placeholder="Ingrese la descripción de la atención." rows="2" name="titulo"></textarea>
            </div>


          </div>


        <div class="form-row">

            <div class="form-group col-md-12">

                <label for="">DESCRIPCIÓN:</label>
                <textarea maxlength="200" readonly class="form-control" id="editarDescripcion" placeholder="Ingrese la descripción de la atención." rows="3" name="titulo"></textarea>
            </div>


          </div>


            <div class="form-group" id="elemento" hidden>
                <label for="">AVANCE:</label>

                <input class="progress-bar progress-bar-striped progress-bar-animated" name="avance" type="range" id="avance" min="0" value="0" max="100" step="5" style="width: 100%;">
                <span id="avan">0</span><span>%</span>

            </div>

    <div class="row">

        <div class="form-group col-md-6">
            <label for="">PRIORIDAD</label>

            <select class="form-control" id="prioridad" name="prioridad">


                <option value="alta">ALTA</option>
                <option value="media">MEDIA</option>
                <option value="baja">BAJA</option>

              </select>
        </div>

        <div class="form-group col-md-6">
            <label for="">ESTADO</label>

            <select class="form-control"  id="estado" name="estado">

                <option value="pendiente">PENDIENTE</option>
                <option value="en espera">EN ESPERA</option>
                <option value="en proceso">EN PROCESO</option>
                <option value="culminado">CULMINADO</option>
              </select>
        </div>

    </div>


    <div class="form-row">

        <div class="form-group col-md-12" hidden id="trabajadores">
            <label for="">PERSONAL</label>


            <select style="width:100%" class="js-example-basic-multiple" id="personal" name="usuario_colab_id[]" multiple="multiple" lang="es">

            </select>

        </div>


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

<script src="{{asset('js/requerimiento.js')}}"></script>

<script>

listar()
</script>
@endsection
