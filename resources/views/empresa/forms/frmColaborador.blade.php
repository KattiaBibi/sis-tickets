<div class="modal fade" id="modalFrmColaborador" tabindex="" role="dialog" aria-labelledby="modalFrmColaborador" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFrmColaboradorLabel">NUEVO COLABORADOR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('colaborador.store') }}" id="frmColaborador">

          <input type="hidden" name="id" id="txtIdColaborador">

          <div class="form-group">
            <label for="">N° De Documento:</label>
            <input type="text" class="form-control" id="txtNroDocumento" placeholder="Ingrese el nombre" name="nrodocumento">
          </div>

          <div class="form-group">
            <label for="">Nombres:</label>
            <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" name="nombres">
          </div>

          <div class="form-group">
            <label for="">Apellidos:</label>
            <input type="text" class="form-control" id="txtApellido" placeholder="Ingrese el nombre" name="apellidos">
          </div>

          <div class="form-group">
            <label for="">Fecha de nacimiento:</label>
            <input type="date" class="form-control" id="txtFechanac" placeholder="" name="fechanacimiento">
          </div>

          <div class="form-group">
            <label for="">Dirección:</label>
            <input type="text" class="form-control" id="txtDireccion" placeholder="Ingrese la dirección" name="direccion">
          </div>

          <div class="form-group">
            <label for="">Teléfono:</label>
            <input type="text" class="form-control" id="txtTelefono" placeholder="Ingrese la dirección" name="telefono">
          </div>

          <!-- <input type="hidden" class="form-control" name="empresa_area_id" id="txtEmpresaAreaIdForColaborador"> -->

          <div class="form-group">
            <label for="txtEmpresaArea">Empresa/Area</label>
            <select name="empresa_area_id" id="txtEmpresaArea" lang="es" class="form-control form-control-sm"></select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="submit" form="frmColaborador" class="btn btn-primary">GUARDAR</button>
      </div>
    </div>
  </div>
</div>