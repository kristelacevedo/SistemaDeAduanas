<div class="modal fade" id="modalRegistroVehiculo" tabindex="-1" aria-labelledby="vehiculoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="vehiculoLabel"><i class="fas fa-car"></i> Registrar Movimiento de Vehículo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_guardar_movimiento">
        <div class="modal-body">
            
            <div id="mensaje_modal_vehiculo"></div>

            <input type="hidden" id="id_movimiento" name="id_movimiento" value="">

            <div class="mb-3">
                <label class="form-label d-block">Tipo de Tránsito</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_movimiento" id="entrada" value="ENTRADA" checked>
                    <label class="form-check-label text-success" for="entrada"><strong><i class="fas fa-sign-in-alt"></i> ENTRADA</strong></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_movimiento" id="salida" value="SALIDA">
                    <label class="form-check-label text-danger" for="salida"><strong><i class="fas fa-sign-out-alt"></i> SALIDA</strong></label>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="patente" class="form-label">Patente / Placa</label>
                    <input type="text" class="form-control text-uppercase" id="patente" name="patente" required placeholder="Ej: AA-BB-11">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="marca" class="form-label">Marca</label>
                    <input type="text" class="form-control" id="marca" name="marca" required placeholder="Ej: Toyota">
                </div>
            </div>

            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo / Año</label>
                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Ej: Hilux 2022">
            </div>

            <div class="mb-3">
                <label for="id_persona" class="form-label">Conductor Responsable</label>
                <select class="form-select" id="id_persona" name="id_persona" required>
                    <option value="">-- Seleccione un conductor --</option>
                    <?php
                    // Incluimos la clase Persona para listar los conductores disponibles
                    require_once __DIR__ . '/../classes/Persona.php';
                    $personaModel = new Persona();
                    $listaPersonas = $personaModel->listarTodas();
                    
                    foreach($listaPersonas as $p){
                        echo "<option value='".$p['id_persona']."'>".$p['apellido'].", ".$p['nombre']." (".$p['documento'].")</option>";
                    }
                    ?>
                </select>
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success" id="btn_guardar_v">Guardar Tránsito</button>
        </div>
      </form>
    </div>
  </div>
</div>