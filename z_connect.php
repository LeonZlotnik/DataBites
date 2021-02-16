<?php
error_reporting(0);
$conn = mysqli_connect('207.210.232.61','wolfs_super','O$ion3t85','H_tostada') or die("error en conexion ".mysqli_connect_error());
$conn->set_charset("utf8");
if(mysqli_connect_error()){
    die("La Conexion Fallo: ".mysqli_connect_error());
}
?>