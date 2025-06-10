<?php
include("conexion.php");
$id = $_GET["id"];
$sql = "DELETE FROM estudiantes WHERE id = '$id'";
$res = mysqli_query($conn, $sql);
if($res){
    header("Location:registro.php");
}else{

}
?>  