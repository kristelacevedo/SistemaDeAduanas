<?php
// classes/usuario.php
declare(strict_types=1);
require_once __DIR__ . '/../config/Database.php';

class Usuario {
    private PDO $db;

    public function __construct() {
        $this->db = Database::conectar();
    }

    public function login(string $usuario, string $password): bool {
        $sql = "SELECT id_usuario, usuario, password FROM usuarios WHERE usuario = :usuario LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':usuario' => strip_tags($usuario)]);
        $user = $stmt->fetch();

        // Comparamos el hash seguro
        if ($user && password_verify($password, $user['password'])) {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['usuario_logueado'] = true;
            $_SESSION['id_usuario'] = $user['id_usuario'];
            $_SESSION['nombre_usuario'] = $user['usuario'];
            return true;
        }
        return false;
    }
}