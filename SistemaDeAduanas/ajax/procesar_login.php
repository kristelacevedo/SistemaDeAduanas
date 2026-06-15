<?php
// ajax/procesar_login.php
declare(strict_types=1);

// 1. Forzamos a que la respuesta del servidor sea SIEMPRE en formato JSON
header('Content-Type: application/json; charset=utf-8');

// 2. Incluimos el modelo de Usuario que creamos previamente
require_once __DIR__ . '/../classes/Usuario.php';

// 3. Verificamos por seguridad que los datos vengan por método POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no permitido.']);
    exit;
}

try {
    // 4. Capturamos los datos enviados desde el formulario (con fallback a string vacío si no existen)
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    // 5. Validación rápida para evitar procesar campos vacíos
    if (empty($usuario) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Por favor, ingrese su usuario y contraseña.']);
        exit;
    }

    // 6. Instanciamos la clase y ejecutamos la verificación
    $auth = new Usuario();
    
    if ($auth->login($usuario, $password)) {
        // Éxito: Las credenciales son correctas y la sesión ya se inició en la clase
        echo json_encode([
            'status' => 'success', 
            'message' => 'Credenciales válidas. Iniciando sistema...'
        ]);
    } else {
        // Fallo: El usuario no existe o la contraseña no coincide con el hash
        echo json_encode([
            'status' => 'error', 
            'message' => 'Usuario o contraseña incorrectos.'
        ]);
    }

} catch (Exception $e) {
    // 7. Si algo se rompe a nivel de servidor (ej: base de datos caída), lo capturamos aquí
    http_response_code(500);
    echo json_encode([
        'status' => 'error', 
        'message' => 'Error crítico en el sistema de autenticación.'
    ]);
}
?>