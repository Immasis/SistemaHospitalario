<?php
$host = "localhost";
$user = "root"; // Cambia según tu configuración
$pass = "mamba";     // Cambia según tu configuración
$db   = "hospitalsys";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
