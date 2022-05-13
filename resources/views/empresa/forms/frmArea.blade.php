<div class="modal fade" id="modalFrmArea" tabindex="" role="dialog" aria-labelledby="modalFrmArea" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFrmAreaLabel">NUEVA AREA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('area.store') }}" id="frmArea">

          <input type="hidden" name="area_id" id="txtIdArea">

          <input type="hidden" name="empresa_area_id" id="empresaAreaId">

          <div class="form-group">
            <label for="txtNombre">Nombre:</label>
            <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" name="nombre">
          </div>
          <div class="form-group">
            <label for="txtEmpresa">Empresa</label>
            <select id="txtEmpresa" name="empresa_id" lang="es" class="form-control form-control-sm">
            </select>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="submit" class="btn btn-primary" form="frmArea">GUARDAR</button>
      </div>
    </div>
  </div>
</div>