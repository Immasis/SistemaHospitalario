<?php
header('Content-Type: application/json');

require_once 'conexion/conexion.php';

$response = [
    'total_citas' => 0,
    'citas_confirmadas' => 0,
    'citas_pendientes' => 0,
    'citas_canceladas' => 0
];

if ($conn) {
 
    $sql_total = "SELECT COUNT(*) AS total FROM citas";
    $result_total = $conn->query($sql_total);
    if ($result_total) {
        $response['total_citas'] = $result_total->fetch_assoc()['total'];
    }

     $sql_confirmadas = "SELECT COUNT(*) AS total FROM citas WHERE estado = 'confirmada'";
    $result_confirmadas = $conn->query($sql_confirmadas);
    if ($result_confirmadas) {
        $response['citas_confirmadas'] = $result_confirmadas->fetch_assoc()['total'];
    }

     $sql_pendientes = "SELECT COUNT(*) AS total FROM citas WHERE estado = 'pendiente'";
    $result_pendientes = $conn->query($sql_pendientes);
    if ($result_pendientes) {
        $response['citas_pendientes'] = $result_pendientes->fetch_assoc()['total'];
    }

    $sql_canceladas = "SELECT COUNT(*) AS total FROM citas WHERE estado = 'cancelada'";
    $result_canceladas = $conn->query($sql_canceladas);
    if ($result_canceladas) {
        $response['citas_canceladas'] = $result_canceladas->fetch_assoc()['total'];
    }

    $conn->close();
}

echo json_encode($response);
?>