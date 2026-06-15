<?php
// ajax/registrar_entrada.php
declare(strict_types=1);

// 1. Forzar formato JSON
header('Content-Type: application/json; charset=utf-8');

// 2. Incluir el modelo
require_once __DIR__ . '/../classes/Movimiento.php';

try {
    $movimientoModel = new Movimiento();
    $metodo = $_SERVER['REQUEST_METHOD'];

    // --- CASO GET: Cargar la tabla ---
    if ($metodo === 'GET') {
        $historial = $movimientoModel->listarHistorial(30); // Trae los últimos 30 registros
        echo json_encode(['status' => 'success', 'data' => $historial]);
        exit;
    }

    // --- CASO POST: Guardar un nuevo registro ---
    if ($metodo === 'POST') {
        // Validar que los campos no estén vacíos
        if (empty($_POST['patente']) || empty($_POST['marca']) || empty($_POST['id_persona']) || empty($_POST['tipo_movimiento'])) {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios del vehículo o conductor.']);
            exit;
        }

        // Ejecutar la inserción en la base de datos
        $exito = $movimientoModel->registrar($_POST);
        
        if ($exito) {
            echo json_encode(['status' => 'success', 'message' => 'Tránsito vehicular autorizado y registrado.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar el registro en la base de datos.']);
        }
        exit;
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error crítico: ' . $e->getMessage()]);
}
?>