<div class="modal fade" id="modalArea" tabindex="" role="dialog" aria-labelledby="modalArea" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAreaLabel">NUEVA AREA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmArea">

          <input type="hidden" name="id" id="inputAreaID">
          <input type="hidden" name="empresa_area_id" id="inputEmpreaAreaID">

          <div class="form-group">
            <label for="inputNombreArea">Nombre:</label>
            <input type="text" class="form-control" maxlength="50"  id="inputNombreArea" name="nombre">
          </div>

          <div class="form-group">
            <label for="inputEmpresa">Empresa:</label>
            <select name="empresa_id" id="inputEmpresa" class="form-control form-control-sm" lang="es"></select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="submit" form="frmArea" class="btn btn-primary">GUARDAR</button>
      </div>
    </div>
  </div>
</div>