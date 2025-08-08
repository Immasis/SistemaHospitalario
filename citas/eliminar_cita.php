<?php
require '../conexion/conexion.php';
$id = $_GET['id'];
$conn->query("DELETE FROM citas WHERE id = $id");
?>
