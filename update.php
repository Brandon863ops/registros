<?php 
include("conexion.php");
$id=$_POST["id"];
$nombre=$_POST["nombre"];
$apellido=$_POST["apellido"];
$fechanaci=$_POST["fechanaci"];
$direccion=$_POST["direccion"];
$telefono=$_POST["telefono"];
$correo=$_POST["correo"];
$estado=$_POST["estado"];
$grado=$_POST["grado"];
$carrera=$_POST["carrera"];




$sql = "UPDATE estudiantes SET nombre ='$nombre', 
    apellido = '$apellido', fechanaci = '$fechanaci', direccion = '$direccion',
     telefono = '$telefono', correo = '$correo',
     estado='$estado', grado='$grado',
    carrera = '$carrera' WHERE id = '$id'";

$r = mysqli_query($conn, $sql);
if($r){
    header("Location: registro.php");
}else{

}


?>