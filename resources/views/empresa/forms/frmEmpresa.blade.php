<div class="modal fade" id="modalFrmEmpresa" tabindex="-1" role="dialog" aria-labelledby="modalFrmEmpresa" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFrmEmpresaLabel">NUEVA EMPRESA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('empresa.store') }}" id="frmEmpresa">
          <input type="hidden" id="txtIdEmpresa" name="id">
          <div class="form-group">
            <label for="">RUC:</label>
            <input type="text" class="form-control" id="txtRuc" maxlength="11" placeholder="Ingrese el nombre" name="ruc" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="">Nombre:</label>
            <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" name="nombre" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="">Dirección:</label>
            <input type="text" class="form-control" id="txtDireccion" placeholder="Ingrese la dirección" name="direccion" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="">Teléfono:</label>
            <input type="text" class="form-control" id="txtTelefono" placeholder="Ingrese la dirección" name="telefono" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="txtColor">Color:</label>
            <input type="color" name="color" id="txtColor" class="form-control">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button type="submit" class="btn btn-primary" form="frmEmpresa">GUARDAR</button>
      </div>
    </div>
  </div>
</div>