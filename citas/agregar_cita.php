<?php
require '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paciente = $_POST['paciente'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $especialidad = $_POST['especialidad'];
    $estado = $_POST['estado'];
   
    $edad = isset($_POST['edad']) ? (int)$_POST['edad'] : 30;
    $enfermedad = isset($_POST['enfermedad']) ? strtolower($_POST['enfermedad']) : '';

    if ($edad >= 65 || strpos($enfermedad, 'cardíaco') !== false || strpos($enfermedad, 'diabetes') !== false) {
        $prioridad = 'alta';
    } elseif ($edad >= 40 || strpos($enfermedad, 'hipertensión') !== false) {
        $prioridad = 'media';
    } else {
        $prioridad = 'baja';
    }

    $sql = "INSERT INTO citas (paciente, fecha, hora, especialidad, estado, prioridad) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $paciente, $fecha, $hora, $especialidad, $estado, $prioridad);

    if ($stmt->execute()) {
        echo "ok";
    } else {
        echo "error";
    }
}
?>
