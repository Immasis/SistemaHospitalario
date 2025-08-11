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


if ($stmt->execute()) {
    echo "Prioridad actualizada correctamente.";

    
    $paciente_email = 'correo_del_paciente@ejemplo.com'; 
    $mail = configurarPHPMailer();
    if ($mail) {
        try {
            $mail->addAddress($paciente_email);
            $mail->Subject = 'Actualización de tu cita - HospitalSys';
            $mail->Body    = "Hola,<br>Tu prioridad ha sido actualizada a **{$prioridad}**.";
            $mail->send();
        } catch (Exception $e) {
            error_log("Error al enviar notificación de actualización.");
        }
    }
}

?>