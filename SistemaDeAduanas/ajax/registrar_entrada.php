<?php
// ajax/registrar_entrada.php
declare(strict_types=1);
header('Content-Type: application/json');

require_once __DIR__ . '/../classes/Movimiento.php';

try {
    $movimientoModel = new Movimiento();
    $metodo = $_SERVER['REQUEST_METHOD'];

    // CASO GET: Obtener el historial para la tabla
    if ($metodo === 'GET') {
        $historial = $movimientoModel->listarHistorial(30);
        echo json_encode(['status' => 'success', 'data' => $historial]);
        exit;
    }

    // CASO POST: Registrar un nuevo cruce aduanero
    if ($metodo === 'POST') {
        if (empty($_POST['patente']) || empty($_POST['marca']) || empty($_POST['id_persona']) || empty($_POST['tipo_movimiento'])) {
            echo json_encode(['status' => 'error', 'message' => 'Faltan datos críticos para registrar el movimiento.']);
            exit;
        }

        $exito = $movimientoModel->registrar($_POST);
        if ($exito) {
            echo json_encode(['status' => 'success', 'message' => 'Tránsito vehicular autorizado y registrado.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo guardar el registro de aduana.']);
        }
        exit;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}