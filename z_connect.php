<?php
$conn = mysqli_connect("207.210.232.61","wolfs_super",'O$ion3t85',"H_tostada") or die("error en conexion ".mysqli_connect_error());
    $conn->set_charset("utf8");
         if($conn -> connect_erro){
             die("La Conexion Fallo: ".$conn-> connect_error);
         }
?>