<?php
// index.php
require_once("config/conexion.php");
require_once("classes/Dashboard.php");

$dashboard = new Dashboard();
$stats = $dashboard->obtenerTotales();

include("head.php");
include("navbar.php");
?>

<div class="container mt-5">
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <h1>Panel de Control Aduanero</h1>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Personas Registradas</h5>
                    <h2 class="display-4"><?php echo $stats['total_personas']; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Movimientos Realizados Hoy</h5>
                    <h2 class="display-4"><?php echo $stats['movimientos_hoy']; ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        </div>
</div>

<?php include("footer.php"); ?>