<?php
require '../conexion/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rol = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar si el usuario ya existe
    $check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "error_exist";
        exit;
    }

    // Encriptar contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Insertar nuevo usuario
    $sql = "INSERT INTO usuarios (rol, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Error en preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("sss", $rol, $email, $passwordHash);

    if ($stmt->execute()) {
        echo "success";
    } else {
        die("Error en ejecución de la consulta: " . $stmt->error);
    }
}
?>
