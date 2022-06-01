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
        @can('admin.requerimientos.filtros')
                <h4>Buscar por:</h4>
        @endcan
        </div>


    <div class="col-lg-2">
        @can('admin.requerimientos.filtros')

            <select class="form-control" id="filtros">
                <option value="todos" selected>Todos los estados ...</option>
                <option value="pendiente">PENDIENTE</option>
                <option value="en espera">EN ESPERA</option>
                <option value="en proceso">EN PROCESO</option>
                <option value="culminado">CULMINADO</option>
                <option value="cancelado">CANCELADO</option>
              </select>
        @endcan
    </div>


    <div class="col-lg-2">
        @can('admin.requerimientos.filtros')
        <select class="form-control" id="filtrosempre">
            <option value="todos" selected>Todas las empresas ...</option>

            @foreach ($empresas as $e)
                <option value="{{$e->nombre}}">{{$e->nombre}}</option>
            @endforeach

          </select>

          @endcan
    </div>

    <div class="col-lg-2">


        @can('admin.requerimientos.filtros')


        <select class="form-control" id="filtronb">
            <option value="todos" selected>Todo  ...</option>
            <option value="solicitante">Solicitante</option>
            <option value="encargado">Encargado</option>
            <option value="asignado">Asignado</option>

          </select>

        @endcan


    </div>

    <div class="col-lg-2" style="text-align: center;">

        @can('admin.requerimientos.filtros')

        <button type="button" class="btn btn-info" id="btnquitarfiltros">BORRAR FILTROS</button>

        @endcan


    </div>

        <div class="col-lg-2" style="text-align: right;">

            @can('admin.requerimientos.agregar')

            <button type="button" class="btn btn-success" id="btnagregar" data-toggle="modal" data-target="#modalagregar">AGREGAR</button>

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
                <th colspan="4" class="text-center">OPCIONES</th>
                {{-- <th>ID</th> --}}
                <th>TITULO</th>
                <th>SOLICITANTE</th>
                <th>ENCARGADO(S)</th>
                <th>ASIGNADO(S)</th>
                <th>EMPRESA</th>
                <th>SERVICIO</th>
                <th>AVANCE</th>
                <th>ESTADO</th>
                <th>PRIORIDAD</th>
                <th>FECHA HORA REGISTRO</th>
                <th>FECHAS Y HORAS PROGRAMADAS:</th>

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



 <form action="{{ route('requerimiento.store') }}" id="frmguardar" enctype="multipart/form-data">
    @csrf

        <div class="form-group text-center">

            <img src="{{ asset('vendor/adminlte/dist/img/soporte.png') }}" alt=""  style="height: 200px; width: 200px;">
        </div>


        <div class="form-group">
            <label for="">TÍTULO:</label>

            <input type="hidden" name="usuarioregist_id" value="{{ auth()->user()->id}}" id="registro">

            <textarea maxlength="100" class="form-control" id="txtProblema" placeholder="Ingrese el nombre del requerimiento." rows="3" name="titulo"></textarea>

            <div id="contador">0/200</div>

        </div>


        <div class="form-row">

            <div class="form-group col-md-6">
                <label for="">EMPRESA RESPONSABLE</label>

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

                <textarea maxlength="600" class="form-control" id="txtDetalle" placeholder="Ingrese el detalle del requerimiento." rows="10" name="descripcion"></textarea>

                <div id="contador2">0/600</div>

        </div>

        <div class="form-group col-md-6">

            <label for="">IMAGEN</label>

            <input type="file"  accept="image/*" class="img form-control-file" id="fileimg" name="imagenpost">

            <img id="prev" class="imagenPrevisualizacion mt-2" style="width: 350px;height: 200;">


            <button type="button" id="" class="retirar btn btn-info" style="display: none; border-radius: 0px;">QUITAR IMAGEN</button>

        </div>

</div>

<div class="row">



    <div class="form-group col-md-6">

        <label for="">ARCHIVO</label>

        <input type="file"  accept="" class="archfile form-control-file" id="filearch" name="archivopost">

        <button type="button" id="" class="retirararch btn btn-sm mt-2 btn-info" style="display: none;border-radius: 0px;">QUITAR ARCHIVO</button>

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



<div class="modal fade" id="modaleditaravance" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Editar avance</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form  id="frmeditaravance">

                <input type="hidden" class="form-control" id="idregistroavance"  name="id">

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <label for="">Avance</label>
                        <input class="progress-bar progress-bar-striped progress-bar-animated" name="avance" type="range" id="editavance" min="0" value="0" max="100" step="5" style="width: 100%;">
                        <span id="editavan">0</span>
                    </div>

                </div>

                <input type="hidden" name="detalle_requerimiento_id" id="iddetallereq">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="cerrar" data-dismiss="modal">Cerrar</button>
          <button type="" id="btnactualizaravance" class="btn btn-primary">Guardar</button>
        </div>

            </form>
      </div>
    </div>
  </div>



<div class="modal fade" id="modalfechahora" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLongTitle">FECHA Y HORA PARA REQUERIMIENTO</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

                <form action="{{ route('historialfechahora.store') }}" id="frmguardarfechahora">
                    @csrf

                    <div id="oculto">
                        <h5>Historial de fechas para requerimiento</h5>
                        <p><a  role="button" id="" class="btnhistorial btn btn-secondary popover-test" title="Popover title" data-content="Popover body content is set in this attribute." style="
                            font-size: 12px;padding: 7px;">AQUÍ</a> para conocerlos.</p>
                        <hr>

                        <p class="text-info">Último registro de fecha: </p>
                        <p class="text-secondary" id="datafecha"></p>

                        <hr class="ocult">

                        <div class="vencimiento alert alert-danger" id="" role="alert">
                            <h5 class="alert-heading">FECHA VENCIDA</h5>
                            <hr>
                            <p id="fragmento"></p>

                </div>
                <hr class="vencimiento">
                <div class="ocult form-row" id="">

                    <div class="form-group col-md-12">
                        <h5>Registrar nueva fecha</h5>
                        <label id="fecha" for="">Fecha y hora estimada, para finalizar requerimiento</label>
                        <label id="fechanueva" for="">Nueva fecha y hora estimada, para finalizar requerimiento</label>

                              <div class="input-group date" id="requerimientodatetime" data-target-input="nearest">
                                  <input type="text"  id="fechayhora" name="fechahora" class="form-control datetimepicker-input" data-target="#requerimientodatetime" onkeydown="return false"/>
                                  <div class="input-group-append" data-target="#requerimientodatetime" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                  </div>
                              </div>


                    </div>

                </div>

                <div class="form-row" id="ocultar">

                    <div class="form-group col-md-12">

                        <label for="">Motivo:</label>
                        <input type="text" class="form-control" id="motivo" value="" maxlength="200" placeholder="Ingrese el motivo para la nueva fecha" name="motivo">

                    </div>

                </div>

                <input type="hidden" name="detalle_requerimiento_id" id="iddetalle">
                <input type="hidden" name="avance" id="avance">
                <input type="hidden" name="idrequerimiento" id="id_requerimiento">


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="" data-dismiss="modal">Cerrar</button>
          <button type="" id="btnfechahora" class="ocult btn btn-primary">Guardar</button>
        </div>

            </form>
      </div>
    </div>
  </div>
<</div>

  <!-- Modal editar -->


<div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="modaleditarlabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modaleditarlabel"><span class="div divoculto divocult">ACTUALIZA </span>REGISTRO DE MANTENIMIENTO</h5>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

      <form  id="frmeditar" enctype="multipart/form-data">

        <input type="hidden" class="form-control" id="idregistro"  name="id">

        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="">ARCHIVO DE AUTORIZACIÓN:</label>

                <a href="" id="download" class="link-info"><i class="icon-download-alt"> </i> Descargar</a>
            </div>


    <div class="form-group col-md-8">

        <label for="">ACTUALIZAR ARCHIVO DE AUTORIZACIÓN:</label>

        <input type="file"  accept="" class="archfile form-control-file" id="arch" name="archivonue">

        <button type="button" id="consarch" class="retirararch btn btn-sm mt-1 btn-info" style="display:none;border-radius: 0px;">QUITAR ARCHIVO</button>
    </div>

          </div>
        <hr>

        <div class="form-row" id="">

            <div class="divoculto divocult form-group text-center col-md-4">

                <input type="file"  accept="image/*" class="img form-control-file" id="imn" name="imagennue">

                <img id="imag" onerror="this.style.display='none'" class="imagenPrevisualizacion mt-2" style="width: 200px;height: 200px;display: none;">

            </div>



            <div class="form-group text-center row justify-content-center align-items-end col-md-4">

                   <img src="{{ asset('vendor/adminlte/dist/img/req.png') }}" alt="" id="mostimg" style="height: 200px; width: 200px;" name="">

                </div>


            <div class="form-group text-center row justify-content-center align-items-center col-md-4">

                <button type="button" id="consim" class="retirar btn btn-info" style="display: none;">QUITAR IMAGEN</button>

            </div>

        </div>


        <div class="form-row">

            <div class="form-group col-md-12">
                <label for="">USUARIO SOLICITANTE:</label>
                <input type="hidden" class="form-control" name="usuarioregist_id" id="UsuarioSolicitante2" readonly>
                <input class="form-control"  type="text" value=""  id="UsuarioSolicitante" readonly>

            </div>




          </div>

          <div class="form-row">

            <div class="form-group col-md-12">
                <label for="">GERENTE(S) RESPONSABLE(S)</label>
            <input class="form-control"  type="text" name="" id="UsuarioResponsable" readonly>

            </div>


          </div>

        <div class="form-row">

            <div class="form-group col-md-12">
                <label for="">TÍTULO:</label>

                <textarea maxlength="100" readonly class="datosocultos form-control" id="editarTitulo" placeholder="Ingrese el nombre del requerimiento." rows="2" name="titulo"></textarea>
            </div>


          </div>


        <div class="form-row">

            <div class="form-group col-md-12">

                <label for="">DESCRIPCIÓN:</label>
                <textarea maxlength="200" readonly class="datosocultos form-control" id="editarDescripcion" placeholder="Ingrese la descripción de la atención." rows="5" name="descripcion"></textarea>
            </div>


          </div>


            <div class="form-group" id="elemento">
                <label for="">AVANCE:</label>

            <div class="progress progress-md">
              <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" id="avance" style="width: 100%" value="30" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span id="avan">0</span>
                {{-- <input class="progress-bar bg-primary progress-bar-striped progress-bar-animated" name="avance" role="progressbar" id="avance" min="0" value="0" max="100" step="5" style="width: 100%;"> --}}


            </div>



    <div class="divoculto divocult row">

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
                {{-- <option value="culminado">CULMINADO</option> --}}
              </select>
        </div>

    </div>

    <div class="divoculto divocu form-row">

        <div class="form-group col-md-12" id="trabajadores">

            <label for="">PERSONAL</label>
            <select style="width:100%" class="js-example-basic-multiple" id="personal" name="usuario_colab_id[]" multiple="multiple" readonly lang="es">

            </select>
        </div>

    </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            <button type="" id="btnactualizar" class="btn btn-primary">EDITAR</button>
        </div>
      </form>

      </div>
    </div>
  </div>


@include('requerimiento.historialfechas')

@endsection




@section('js')

<script src="{{asset('js/requerimiento.js')}}"></script>

<script>

listar()
</script>
@endsection
