<?php
session_start();
require "conexion.php";

// Verificar que hay usuario logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fechanaci = $_POST['fechanaci'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$estado = $_POST['estado'];
$grado = $_POST['grado'];
$carrera = $_POST['carrera'];

// Usuario que registró
$usuarioCreador = $_SESSION['usuario'];

// Insertar datos con fecha actual y usuario creador
$sql = "INSERT INTO estudiantes (nombre, apellido, fechanaci, direccion, telefono, correo, estado, grado, carrera, createAt, createBy)
        VALUES ('$nombre', '$apellido', '$fechanaci', '$direccion', '$telefono', '$correo', '$estado', '$grado', '$carrera', NOW(), '$usuarioCreador')";

if ($conn->query($sql)) {
    header("Location: registrar.php");
    exit();
} else {
    echo "Error al registrar: " . $conn->error;
}
?>
