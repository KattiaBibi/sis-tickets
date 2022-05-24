<div class="modal fade" id="modalEmpresa" tabindex="-1" role="dialog" aria-labelledby="modalEmpresa" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEmpresaLabel">NUEVA EMPRESA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="frmEmpresa">

          <input type="hidden" id="inputEmpresaID" name="id">
          <div class="form-group">
            <label for="">RUC:</label>
            <input type="text" class="form-control" id="inputRuc" maxlength="11"  name="ruc" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="">Nombre:</label>
            <input type="text" class="form-control" id="inputNombre" name="nombre" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="">Dirección:</label>
            <input type="text" class="form-control" id="inputDireccion" name="direccion" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="">Teléfono:</label>
            <input type="text" class="form-control" id="inputTelefono" name="telefono" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="inputColor">Color:</label>
            <input type="color" name="color" id="inputColor" class="form-control">
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