<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


function configurarPHPMailer() {
    $mail = new PHPMailer(true);

    try {
        
        $mail->isSMTP();
        $mail->Host       = 'hospitalsys1@gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'hospitalsys1@gmail.com'; 
        $mail->Password   = 'HSYS1234'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        
        $mail->setFrom('hospitalsys1@gmail.com', 'HospitalSys');

    } catch (Exception $e) {
        
        error_log("Error al configurar PHPMailer: {$e->getMessage()}");
    }

    return $mail;
}
?>