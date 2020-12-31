<?php
    if(isset($_POST['insert'])){
        $user = $_POST['usuario'];
        $pw = $_POST['password'];
        $type = $_POST['acceso'];

        $conn = mysqli_connect("localhost","root","root","H_tostada") or die("error en conexion ".mysqli_connect_error());
        mysqli_set_charset($conn, "utf8");

        $sql = "INSERT INTO administradores (usuario, password, acceso) VALUES ('$user', '$pw','$type');";
        $result = mysqli_query($conn, $sql) or die ("error en query $sql".mysqli_error());

        if($result){
            echo "Success!";
          }else{
            echo "<script type='text/javascript'>alert('Se ha generado un error');</script>";
          };
          
          mysqli_free_result($result);
          mysqli_close($conn);
          
          header('Location:contol_admin.php');

    }

?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creacion de admin</title>
    <link rel="shorcut icon" type="img/png" href="img/favicon.png">
    <link rel="stylesheet" type="text/css" href="admin_controll.css">
</head>
<body>
<?php require_once('admin_navbar.php')?>
<br>
<h2 class="text-center">Crear Administrador</h2>
<br>
<section class="container">
<form method="POST" enctype="multipart/form-data">
  <div class="form-row">
    
    <div class="form-group col-md-6">
      <label for="inputPassword4">Usuario:</label>
      <input type="text" name="usuario"  class="form-control" id="inputPassword4" placeholder="Inrtoduce apellido">
    </div>
  </div>
  <div class="form-row">
    <label for="inputAddress2">Contraseña:</label>
    <input type="password" name="password"  class="form-control" id="inputAddress2" placeholder="Inrtoduce contrase単a">
  </div>
  <br>
  <div class="form-row">
  <select name="acceso" class="custom-select" id="inputGroupSelect01">
            <option value="null">--</option>
            <option value="gerente">Gerencia</option>
            <option value="piso">Personal</option>
        </select>
  </div>
  <br>
  
  <a href="contol_admin.php" class="btn btn-info">Regresar</a>
  <input type="submit" name="insert" class="btn btn-info" value="Crear">
</form>
</section>
<br>
</body>
</html>