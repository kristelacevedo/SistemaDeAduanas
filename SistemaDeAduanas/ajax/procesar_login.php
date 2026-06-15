<?php
// ajax/procesar_login.php
require_once("../classes/login.php");

// Verificar que lleguen los datos por POST
if (isset($_POST['usuario']) && isset($_POST['password'])) {
    
    $login = new Login();
    $acceso = $login->verificarUsuario($_POST['usuario'], $_POST['password']);
    
    if ($acceso) {
        // Respuesta JSON de éxito
        echo json_encode(['status' => 'success', 'message' => 'Acceso concedido. Cargando sistema...']);
    } else {
        // Respuesta JSON de error
        echo json_encode(['status' => 'error', 'message' => 'Usuario o contraseña incorrectos.']);
    }
    
} else {
    echo json_encode(['status' => 'error', 'message' => 'Por favor, completa todos los campos.']);
}
?>