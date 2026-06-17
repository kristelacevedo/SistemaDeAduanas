<?php
// classes/Dashboard.php
declare(strict_types=1);
require_once __DIR__ . '/../config/Database.php';

class Dashboard {
    private PDO $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function obtenerTotales(): array {
        // Total personas registradas
        $totalPersonas = $this->db->query("SELECT COUNT(*) FROM personas")->fetchColumn();
        
        // Movimientos hoy
        $hoy = date('Y-m-d');
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM movimientos WHERE DATE(fecha_registro) = :hoy");
        $stmt->execute([':hoy' => $hoy]);
        $movimientosHoy = $stmt->fetchColumn();

        return [
            'total_personas' => $totalPersonas,
            'movimientos_hoy' => $movimientosHoy
        ];
    }
}