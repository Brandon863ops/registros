<?php
require "conexion.php";
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$fechanaci = $_POST['fechanaci'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$estado = $_POST['estado'];
$grado = $_POST['grado'];
$carrera = $_POST['carrera'];




//imprimir en pantalla
//echo "Hola " . $nombre;

$sql = "INSERT INTO estudiantes(nombre, apellido, fechanaci, direccion, correo, estado, telefono, grado, carrera) VALUES ('$nombre', '$apellido', '$fechanaci',
'$direccion', '$telefono', '$correo', '$estado', '$grado', '$carrera')";
if($conn ->query($sql)){
    header("Location: registrar.php");

}else{

}

?>