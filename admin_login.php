
<?php
session_start();
require_once('z_connect.php');

$username = $_POST['usuario'];
$pw = $_POST['password'];
$type = $_POST['acceso'];

if(isset($_POST['login'])){
    if(empty($username) || empty($pw)){
        header("location:admin.php?Empty=Llenae_correctamente");
        $empty = "<div class='alert alert-warning' role='alert'>
                    Introduzca información valida.
                    </div>";
    }else{
        $sql = "SELECT * FROM administradores WHERE usuario = '$username' AND password ='$pw' AND acceso ='$type' ";
        $result = mysqli_query($conn,$sql);

        if($result){
           $_SESSION['admin'] = $_POST['usuario'];
            header("location:admin/panel.php?Bienvenido=".$_SESSION['admin']);
        }else{
            header("location:admin.php?Invalid=Introduzca_usuario_correcto");
            $error = "<div class='alert alert-danger' role='alert'>
                    Información incorrecta, favor de verificar. 
                    </div>";
        }
    }
}else{
    echo "<script>console.log('Fatal!')</script>";
}
?>

