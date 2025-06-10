<?php
session_start();

$usuarios = [
    "admin" => "1234",
    "juan" => "abc123",
    "maria" => "clave"
];

$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

if (isset($usuarios[$usuario]) && $usuarios[$usuario] === $contrasena) {
    $_SESSION['usuario'] = $usuario;
    header("Location: registrar.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}
?>
