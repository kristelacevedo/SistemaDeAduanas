<?php
// config/conexion.php
require_once("db.php");

$conexion = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(!$conexion){
    die("Imposible conectarse: ".mysqli_error($conexion));
}
if (@mysqli_connect_errno()) {
    die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}
// Forzamos el uso de UTF-8
mysqli_query($conexion, "SET NAMES 'utf8'");
?>