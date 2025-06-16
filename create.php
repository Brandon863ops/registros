<?php
session_start();
require "conexion.php";

// Verificar que hay usuario logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Recibir y sanitizar datos del formulario
$nombre = $conn->real_escape_string($_POST['nombre']);
$apellido = $conn->real_escape_string($_POST['apellido']);
$fechanaci = $conn->real_escape_string($_POST['fechanaci']);
$direccion = $conn->real_escape_string($_POST['direccion']);
$telefono = $conn->real_escape_string($_POST['telefono']);
$correo = $conn->real_escape_string($_POST['correo']);
$estado = $conn->real_escape_string($_POST['estado']);
$grado = $conn->real_escape_string($_POST['grado']);
$carrera = $conn->real_escape_string($_POST['carrera']);

// Usuario que registró
$usuarioCreador = $_SESSION['usuario'];

// Insertar datos con fecha actual y usuario creador
$sql = "INSERT INTO estudiantes(nombre, apellido, fechanaci, direccion, telefono, correo, estado, grado, carrera, createAt, createBy)
        VALUES ('$nombre', '$apellido', '$fechanaci', '$direccion', '$telefono', '$correo', '$estado', '$grado', '$carrera', NOW(), '$usuarioCreador')";

if ($conn->query($sql)) {
    header("Location: registrar.php?msg=Alumno registrado correctamente");
    exit();
} else {
    echo "Error al registrar: " . $conn->error;
}
?>
