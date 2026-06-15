<?php
// classes/login.php
require_once(__DIR__ . "/../config/conexion.php");

class login {
    
    public function verificarUsuario($usuario, $password) {
        global $conexion;
        
        // Limpiar las variables para evitar inyección SQL
        $usuario = mysqli_real_escape_string($conexion, $usuario);
        $password = mysqli_real_escape_string($conexion, $password);
        
        // Asumiendo que tienes una tabla llamada 'usuarios'
        $sql = "SELECT id_usuario, usuario FROM usuarios WHERE usuario = '$usuario' AND password = '$password'";
        $resultado = mysqli_query($conexion, $sql);
        
        if (mysqli_num_rows($resultado) == 1) {
            $row = mysqli_fetch_array($resultado);
            
            // Iniciar sesión y guardar variables globales
            session_start();
            $_SESSION['usuario_logueado'] = true;
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['nombre_usuario'] = $row['usuario'];
            
            return true;
        } else {
            return false;
        }
    }
}
?>