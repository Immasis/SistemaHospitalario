<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'conexion/conexion.php';

if (!$conn) {
    die("No hay conexión a la base de datos.");
}

$paciente = $_POST['paciente'] ?? '';
$especialidad = $_POST['especialidad'] ?? '';
$fecha = $_POST['fecha'] ?? '';
$hora = $_POST['hora'] ?? '';

if (!$paciente || !$especialidad || !$fecha || !$hora) {
    die("Faltan datos requeridos");
}

$stmt = $conn->prepare("INSERT INTO citas (paciente, especialidad, fecha, hora) VALUES (?, ?, ?, ?)");
if (!$stmt) {
    die("Error en prepare: " . $conn->error);
}

$stmt->bind_param("ssss", $paciente, $especialidad, $fecha, $hora);

if ($stmt->execute()) {
    echo "Cita guardada correctamente";
} else {
    echo "Error al guardar cita: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
