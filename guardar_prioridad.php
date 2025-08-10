<?php
require 'conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_cita = $_POST['id_cita'];
    $prioridad = $_POST['prioridad'];

    $stmt = $conn->prepare("UPDATE citas SET prioridad = ? WHERE id = ?");
    $stmt->bind_param("si", $prioridad, $id_cita);

    if ($stmt->execute()) {
        echo "Prioridad actualizada correctamente.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>