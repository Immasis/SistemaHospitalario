<?php
require '../conexion/conexion.php';
$result = $conn->query("SELECT * FROM citas ORDER BY fecha, hora");
$citas = [];
while ($row = $result->fetch_assoc()) {
    $citas[] = $row;
}
echo json_encode($citas);
?>
