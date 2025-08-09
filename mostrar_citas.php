<?php
header('Content-Type: application/json');

require_once 'conexion/conexion.php';

$sql = "SELECT paciente, fecha, hora, especialidad, estado FROM citas ORDER BY fecha DESC, hora DESC";
$result = $conn->query($sql);

$citas = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $citas[] = $row;
    }
}

echo json_encode($citas);

$conn->close();
?>
