<div class="modal fade" id="modalRegistroPersona" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalLabel"><i class="fas fa-user-edit"></i> Registrar Nueva Persona</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-shadow="none" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_guardar_persona">
        <div class="modal-body">
            
            <div id="mensaje_modal_persona"></div>

            <div class="mb-3">
                <label for="documento" class="form-label">Documento / Identificación (RUT/DNI)</label>
                <input type="text" class="form-control" id="documento" name="documento" required placeholder="Ej: 12345678-9">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="Ej: Juan Carlos">
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="Ej: Pérez Rossi">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono de Contacto</label>
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ej: +56912345678">
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="btn_guardar">Guardar Persona</button>
        </div>
      </form>
    </div>
  </div>
</div>