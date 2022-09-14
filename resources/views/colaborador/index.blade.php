@extends('adminlte::page')
@section('content_header')
<h1>Colaboradores</h1>
@section('title', 'Colaboradores')
@endsection

@section('css')

@endsection

@section('content')

<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-lg-10">
        <h5>TABLA COLABORADORES</h5>
      </div>
      <div class="col-lg-2">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalColaborador" id="btnAgregarColaborador">
          AGREGAR
        </button>
      </div>
    </div>
  </div>

  <div class="card-body">
    <table id="colaboradores" class="table table-striped table-bordered table-sm" style="font-size: small;">
      <thead>
        <tr>
          <th colspan="2" style="text-align: center;">OPCIONES</th>
          <th>N° DOCUMENTO</th>
          <th>NOMBRES</th>
          <th>APELLIDOS</th>
          <th>FECHA DE NACIMIENTO</th>
          <th>DIRECCIÓN</th>
          <th>TELÉFONO</th>
          <th>EMPRESA(S)</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>


<div class="modal fade" id="modalColaborador" tabindex="-1" role="dialog" aria-labelledby="modalColaborador" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalColaboradorLabel">REGISTRAR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmMultiempresa"></form>
        <form id="frmColaborador">
          <input type="hidden" class="form-control" id="inputIdColaborador" name="id">

          <div class="form-group">
            <label for="inputNrodoc">N° DOCUMENTO:</label>
            <input type="text" class="solonros form-control" id="inputNrodoc" maxlength="11" minlength="8" placeholder="Ingrese su DNI" name="nrodocumento" data-label-validation="nrodocumento">
            <div class="show-validation-message"></div>
          </div>

          <div class="form-group">
            <label for="inputNombre">Nombres:</label>
            <input type="text" class="form-control" id="inputNombre" maxlength="50" placeholder="Ingrese su(s) nombre(s)" name="nombres" data-label-validation="nombres">
            <div class="show-validation-message"></div>
          </div>

          <div class="form-group">
            <label for="inputApellido">Apellidos:</label>
            <input type="text" class="form-control" maxlength="50" id="inputApellido" placeholder="Ingrese sus apellidos" name="apellidos" data-label-validation="apellidos">
            <div class="show-validation-message"></div>
          </div>

          <div class="form-group">
            <label for="inputFechanac">Fecha de nacimiento:</label>
            <input type="date" class="form-control" id="inputFechanac" placeholder="" name="fechanacimiento" data-label-validation="fechanacimiento">
            <div class="show-validation-message"></div>
          </div>

          <div class="form-group">
            <label for="inputDireccion">Dirección:</label>
            <input type="text" class="form-control" id="inputDireccion" maxlength="50" placeholder="Ingrese su dirección" name="direccion" data-label-validation="direccion">
            <div class="show-validation-message"></div>
          </div>
          <div class="form-group">
            <label for="inputTelefono">Teléfono:</label>
            <input type="text" class="solonros form-control" id="inputTelefono" maxlength="12" minlength="9" placeholder="Ingrese su teléfono" name="telefono" data-label-validation="telefono">
            <div class="show-validation-message"></div>
          </div>

          <div class="form-group">
            <label for="" class="mb-0 pb-0">Empresa(s):</label>
            <input type="hidden" data-label-validation="empresas">
            <div class="show-validation-message mb-2"></div>
            <p>
              <button class="btn btn-sm btn-primary" type="button" data-toggle="collapse" data-target="#collapseFrmMultiempresa" aria-expanded="false" aria-controls="collapseFrmMultiempresa" id="btnNuevoMultiempresa">
                Añadir
              </button>
            </p>
            <div class="collapse" id="collapseFrmMultiempresa">
              <div class="card card-body">
                <p id="collapseMultiempresaLabel" style="font-weight: bold;" class="h5">AÑADIR</p>
                <div id="frmMultiempresaContainer">
                  <input type="hidden" id="inputIdMultiEmpresa">
                  <div class="form-group">
                    <label for="inputEmpresaAreaMultiempresa">Empresa/Area</label>
                    <select id="inputEmpresaAreaMultiempresa" class="form-control form-control-sm" form="frmMultiempresa" data-label-validation="empresa_area">
                      <option value="" selected>SELECCIONAR</option>
                      @foreach ($empresa_areas as $e)
                      <option value="{{ $e->eaid }}">{{$e->enombre}} ({{$e->anombre}})</option>
                      @endforeach
                    </select>
                    <div class="show-validation-message"></div>
                  </div>
                  <div class="form-group">
                    <label for="inputCorreoMultiempresa">Correo</label>
                    <input type="text" id="inputCorreoMultiempresa" class="form-control form-control-sm" form="frmMultiempresa" data-label-validation="correo">
                    <div class="show-validation-message"></div>
                  </div>
                </div>
                <div style="text-align: right;">
                  <button type="submit" id="btnSendFrmMultiempresa" form="frmMultiempresa" class="btn btn-sm btn-success">
                    <span id="btnSendFrmMultiempresaText">Añadir</span>
                    <img src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" id="loaderBtnSendFrmMultiempresa" style="width: 18px; display: none;">
                  </button>
                </div>
              </div>
            </div>

            <table class="table table-sm table-bordered text-center" id="tablaMultiempresa" style="font-size: small; width: 100%;">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>NOMBRE</th>
                  <th>CORREO</th>
                  <th>OPCIONES</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="submit" id="btnSendFrmColaborador" class="btn btn-md btn-primary">
          GUARDAR
          <img src="https://c.tenor.com/I6kN-6X7nhAAAAAj/loading-buffering.gif" id="loaderBtnSendFrmColaborador" style="width: 18px; display: none;">
        </button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection


@section('js')

<script>
  console.log('¡HOLA!');
</script>
<script src="{{asset('js/colaborador.js')}}"></script>

<script>
  listar()
</script>
@endsection