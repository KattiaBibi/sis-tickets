<div class="modal fade" id="modalServicio" tabindex="-1" role="dialog" aria-labelledby="modalServicio" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalServicioLabel">REGISTRAR SERVICIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmServicio">
          <input type="hidden" id="inputIdServicio">
          <input type="hidden" name="id_empresa_servicio" id="inputIdEmpresaServicio">
          <div class="form-group">
            <label for="inputNombreServicio">Servicio:</label>
            <input type="text" name="nombre" id="inputNombreServicio" class="form-control form-control-sm">
          </div>
          <div class="form-group">
            <label for="inputEmpresa">Empresa:</label>
            <select name="id_empresa" id="inputEmpresa" class="form-control form-control-sm" lang="es"></select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="submit" form="frmServicio" class="btn btn-primary">GUARDAR</button>
      </div>
    </div>
  </div>
</div>