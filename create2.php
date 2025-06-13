<?php
require "conexion.php";

// Obtener datos del formulario
$Matematica =                $_POST['Matematica'];
$Comunicacion_lenguaje =     $_POST['Comunicacion_lenguaje'];
$Fisica =                    $_POST['Fisica'];
$Programacion_estructurado = $_POST['Programacion_estructurado'];
$Estructura_datos =          $_POST['Estructura_datos'];

// Insertar en la base de datos
$sql = "INSERT INTO curso (Matematica, Comunicacion_lenguaje, Fisica, Programacion_estructurado, Estructura_datos) 
        VALUES ('$Matematica', '$Comunicacion_lenguaje', '$Fisica', '$Programacion_estructurado', '$Estructura_datos')";

if ($conn->query($sql)) {
    header("Location: registrar.php");
} else {
   
}
?>
