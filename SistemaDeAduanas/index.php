<?php
// index.php
// Aquí normalmente verificarías si el usuario tiene sesión iniciada
/*
session_start();
if(!isset($_SESSION['usuario_logueado'])){
    header("Location: login.php");
    exit;
}
*/

require_once("config/conexion.php");
include("head.php");
include("navbar.php");
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Bienvenido al Sistema de Aduanas</h1>
            <p class="lead">Gestión de registro de personas, vehículos y movimientos fronterizos.</p>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Gestión de Personas</h5>
                    <p class="card-text">Registra y administra las personas que cruzan.</p>
                    <a href="personas.php" class="btn btn-primary">Ir a Personas</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-exchange-alt fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Control de Movimientos</h5>
                    <p class="card-text">Registra entradas y salidas (vehículos y peatones).</p>
                    <a href="movimientos.php" class="btn btn-success">Ir a Movimientos</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>