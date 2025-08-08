<?php
session_start();
require '../conexion/conexion.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rol = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email = ? AND rol = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $rol);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($usuario = $result->fetch_assoc()) {
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario'] = $usuario['email'];
            $_SESSION['rol'] = $usuario['rol'];

            echo "success";
        } else {
            echo "error_pass";
        }
    } else {
        echo "error_user";
    }
}
?>
