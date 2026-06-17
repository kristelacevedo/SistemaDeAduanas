<?php
// ajax/buscar_personas.php
declare(strict_types=1);
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../classes/Persona.php';

try {
    $personaModel = new Persona();
    $action = $_GET['action'] ?? 'buscar';

    // 1. Buscar y listar (Leer)
    if ($action === 'buscar') {
        $q = $_GET['q'] ?? '';
        echo json_encode(['status' => 'success', 'data' => $personaModel->buscar($q)]);
        exit;
    }

    // 2. Obtener datos para el modal de edición
    if ($action === 'obtener') {
        $id = (int)($_GET['id'] ?? 0);
        $datos = $personaModel->obtenerPorId($id);
        if ($datos) {
            echo json_encode(['status' => 'success', 'data' => $datos]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Persona no encontrada.']);
        }
        exit;
    }

    // 3. Eliminar persona
    if ($action === 'eliminar') {
        $id = (int)($_POST['id'] ?? 0);
        if ($personaModel->eliminar($id)) {
            echo json_encode(['status' => 'success', 'message' => 'Registro eliminado correctamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo eliminar el registro.']);
        }
        exit;
    }

    // 4. Insertar o Actualizar
    if ($action === 'guardar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['documento']) || empty($_POST['nombre']) || empty($_POST['apellido'])) {
            echo json_encode(['status' => 'error', 'message' => 'Campos obligatorios faltantes.']);
            exit;
        }

        $id_persona = $_POST['id_persona'] ?? '';
        
        if (empty($id_persona)) {
            // Si no hay ID, creamos uno nuevo
            $exito = $personaModel->insertar($_POST);
            $mensaje = 'Persona registrada con éxito.';
        } else {
            // Si hay ID, actualizamos el existente
            $exito = $personaModel->actualizar($_POST);
            $mensaje = 'Datos actualizados correctamente.';
        }

        if ($exito) {
            echo json_encode(['status' => 'success', 'message' => $mensaje]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar los datos en la base de datos.']);
        }
        exit;
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error interno: ' . $e->getMessage()]);
}