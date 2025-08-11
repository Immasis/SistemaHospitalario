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

require_once 'conexion/config_email.php'; 

   
    $paciente_email = 'hospitalsys1@gmail.com'; 

   
    $mail = configurarPHPMailer();
    if ($mail) {
        try {
            
            $mail->addAddress($paciente_email, $paciente);

            
            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de Cita Médica - HospitalSys';
            $mail->Body    = "Hola **{$paciente}**,<br><br>"
                           . "Tu cita ha sido solicitada correctamente.<br><br>"
                           . "Detalles de la cita:<br>"
                           . "<ul>"
                           . "<li>**Especialidad:** {$especialidad}</li>"
                           . "<li>**Fecha:** {$fecha}</li>"
                           . "<li>**Hora:** {$hora}</li>"
                           . "</ul>"
                           . "Por favor, espera la confirmación oficial. ¡Gracias!<br><br>"
                           . "Saludos cordiales,<br>"
                           . "El equipo de HospitalSys";
            $mail->AltBody = "Hola {$paciente},\n\nTu cita ha sido solicitada correctamente.\n\n"
                           . "Detalles de la cita:\n"
                           . "Especialidad: {$especialidad}\n"
                           . "Fecha: {$fecha}\n"
                           . "Hora: {$hora}\n\n"
                           . "Por favor, espera la confirmación oficial. ¡Gracias!\n\n"
                           . "Saludos cordiales,\n"
                           . "El equipo de HospitalSys";

            $mail->send();
           

        } catch (Exception $e) {
            // En caso de error en el envío
            error_log("El mensaje no se pudo enviar. Error de Mailer: {$mail->ErrorInfo}");
        }
    }

?>
