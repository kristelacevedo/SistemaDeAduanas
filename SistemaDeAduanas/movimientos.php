<?php
// movimientos.php
session_start();

// Opcional: Proteger la ruta para que solo entren usuarios logueados
if(!isset($_SESSION['usuario_logueado'])){
    header("Location: login.php");
    exit;
}

include("head.php");
include("navbar.php");
?>

<div class="container mt-4">
    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h2><i class="fas fa-exchange-alt text-success"></i> Control de Movimientos Aduaneros</h2>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistroVehiculo">
                <i class="fas fa-truck-moving"></i> Registrar Entrada / Salida
            </button>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-history text-muted"></i> Registro de Accesos Recientes</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Fecha / Hora</th>
                            <th>Tipo</th>
                            <th>Patente / Placa</th>
                            <th>Vehículo</th>
                            <th>Conductor</th>
                            <th>Documento</th>
                        </tr>
                    </thead>
                    <tbody id="tabla_movimientos_body">
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="spinner-border text-success spinner-border-sm" role="status"></div> Cargando datos...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php 
include("modal/registro_vehiculos.php"); 
include("footer.php"); 
?>