<?php
require '../conexion/conexion.php';

header('Content-Type: application/json');

$sql = "SELECT id, paciente, fecha, hora, especialidad, estado, prioridad FROM citas ORDER BY fecha ASC, hora ASC";
$result = $conn->query($sql);

$citas = [];

while ($row = $result->fetch_assoc()) {
    $citas[] = $row;
}

echo json_encode($citas);
?>
