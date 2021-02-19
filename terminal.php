<?php
session_start();
$USR = $_SESSION['usuario'];
//$MSA = $_SESSINO['m'];

if($USR == null){
    header("location:preferencias.php");
}
require_once('z_connect.php');

if(isset($_GET['Total'])){
    (int)$id = $_GET['Total'];
    $Total = (int)$id;
  }


if(isset($_POST['validar_token'])){
    $token = $_POST['token'];
    $email = $_POST['email'];

    $sql="SELECT count(*) total from usuarios where usuario='$USR' and codigo='$token'";
    $res=mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);
    $countExist= $row["total"];
    if ($countExist>0) {
        $paid = "UPDATE comandas SET status= 'Pagado' WHERE usuario = '$USR' AND DATE(registro) = CURDATE() AND status = 'Cuenta'";
        $res = mysqli_query($conn, $paid) or die ("error en query $paid".mysqli_error());
        header('Location:hecho.php?total='.$Total);
    } else {
        $error = "<div class='alert alert-danger' role='alert'>
                Código Inválido, favor de verificarlo.
        </div>";
    }
}
s
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    <link rel="shorcut icon" type="img/png" href="img/favicon.png">
    <link rel="stylesheet" href="../style.css">
    <style>
.title {
        text-align: center;
        color:#D7627C; 
        text-shadow: 1.5px 1px 2px #000;
    }
    </style>
</head>
<body>
<?php
require_once("nav_bar.php");
?>
<br>
<section class="container">
<h4 class="my-4 text-center title">Pago en Terminal</h4>
<div class="card row">
    <div class="card-body col-12">
        <p class="card-text"><b><?php echo $USR ?> tu total a pagar es de: $<?php echo $Total ?></b></p>
        <p class="card-text">La propina se deja aparte.</p>
        <div class="container">
            <?php echo $success ?>
            <?php echo $error ?>
        </div>
    </div>
</div>
<form method="post" id="payment-form">
  <div class="form-row">
      <input type="text" name="token" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Ingrese Token" required>
      <input type="email" name="email" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Email Address" required>
  </div>

  <button class="btn btn-primary btn-lg btn-block" name="validar_token">Generar Pago</button>
</form>
</section>
<br>
<br>
<section class="container">
<div class="card row">
  <div class="card-body col-12">
    <p class="card-text">
    Introduzca el mail a donde quiera recibir el comprobante de su cuenta, esta información no será utilizada para fines comerciales.
    </p>
  </div>
</div>
</section>
<br>
<section class="container">
    <a class="btn btn-info btn-lg btn-block" href="cuenta.php?total=<?php echo $Total ?>">Atras</a>
</section>
</body>
<br>
<br>
<br>
<br>
<?php //require_once('../footer.html')?>
</html>