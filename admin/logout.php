<?php
    session_start();
    if(isset($_GET['salir'])){
        session_destroy();
        header('location:../admin.php');
    }else{
        header('location:panel.php');
    }
?>