<?php
require '../conexion/conexion.php';
$paciente = $_POST['paciente'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$especialidad = $_POST['especialidad'];
$estado = $_POST['estado'];

$sql = "INSERT INTO citas (paciente, fecha, hora, especialidad, estado) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $paciente, $fecha, $hora, $especialidad, $estado);

if ($stmt->execute()) {
    echo "OK";
} else {
    echo "Error";
}
?>
