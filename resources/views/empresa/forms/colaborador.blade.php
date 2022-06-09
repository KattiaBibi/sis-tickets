<div class="modal fade" id="modalColaborador" tabindex="" role="dialog" aria-labelledby="modalColaborador" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalColaboradorLabel">NUEVO COLABORADOR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmColaborador">

          <input type="hidden" name="id" id="inputColaboradorID">

          <div class="form-group">
            <label for="">N° De Documento:</label>
            <input type="text" class="solonros form-control"  maxlength="11" minlength="8" id="inputNroDocumentoColaborador" name="nrodocumento">
          </div>

          <div class="form-group">
            <label for="">Nombres:</label>
            <input type="text" class="sololetras form-control" maxlength="50" minlength="50" id="inputNombreColaborador" name="nombres">
          </div>

          <div class="form-group">
            <label for="">Apellidos:</label>
            <input type="text" class="sololetras form-control" maxlength="50" minlength="50" id="inputApellidoColaborador" name="apellidos">
          </div>

          <div class="form-group">
            <label for="">Fecha de nacimiento:</label>
            <input type="date" class="form-control" id="inputFechanacColaborador" name="fechanacimiento">
          </div>

          <div class="form-group">
            <label for="">Dirección:</label>
            <input type="text" class="form-control" id="inputDireccionColaborador" maxlength="50" minlength="50" name="direccion">
          </div>

          <div class="form-group">
            <label for="">Teléfono:</label>
            <input type="text" class="solonros form-control" maxlength="12" minlength="9" id="inputTelefonoColaborador" name="telefono">
          </div>

          <div class="form-group">
            <label for="inputEmpresaArea">Empresa/Area</label>
            <select name="empresa_area_id" id="inputEmpresaArea" lang="es" class="form-control form-control-sm"></select>
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