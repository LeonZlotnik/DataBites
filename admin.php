<?php  

require_once('z_connect.php');

  if(isset($_POST['login'])){
      $username = $_POST["usuario"];
      $password = $_POST["password"];

      $query = "SELECT * FROM administradores WHERE usuario='$username' AND password='$password'";

      $result = mysqli_query($conn, $query);

      if(mysqli_num_rows($result)>0){
          while($row = mysqli_fetch_assoc($result)){
              if($row["usuario"]){
                  session_start();
                  $_SESSION['admin'] = $row["usuario"];
                  header('Location:admin/panel.php?Bienvenido='.$_SESSION['admin']);
              }
          }
      }else{
          $msg = "<div class='alert alert-danger' role='alert'>Acceso negado, verifique la informacion</div>";
          //header('Location:login.php');
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administradores</title>
    <style>
      #gif{
        height: 200px;
        width: 300;
      }
      .title {
            text-align: center;
            color:#D7627C; 
            text-shadow: 1.5px 1px 2px #000;
        }
    </style>
</head>
<body>
<?php require_once('nav_bar.php')?>
<br>
<h2 class="text-center title">Acceso de Administradores</h2>
<br>
<section class="container">
<?php echo $msg ?>
<form action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Usuario</label>
    <input type="text" name="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Usuario">
    <small id="emailHelp" class="form-text text-muted">Acceso unicamente para administradores</small>
  </div>
  <div class="form-group">
    <select class="custom-select" name="acceso" id="inputGroupSelect01">
            <option selected>--</option>
            <option value="Gerencia">Gerencia</option>
            <option value="Piso">Piso</option>
        </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
  </div>
  <input type="submit" class="btn btn-primary" name="login" value="Entrar">
</form>

</section>



<br>
</body>
</html>