<?php

  if(isset($_POST['insert'])){

$target = "/Applications/MAMP/htdocs/PHP-Python/DataBites_app/admin/anuncios/".basename($_FILES['imagen']['name']);

$name = $_POST['anuncio'];
$image = $_FILES['imagen']['name'];
$number = $_POST['numero'];
  
$conn = mysqli_connect("localhost","root","root","H_tostada") or die("error en conexion ".mysqli_connect_error());
        mysqli_set_charset($conn, "utf8");


  $sql = "INSERT INTO anuncios (anuncio, imagen, numero) VALUES ('$name','$image','$number');";
  $result = mysqli_query($conn, $sql) or die ("error en query $sql".mysqli_error());

  if(move_uploaded_file($_FILES['imagen']['tmp_name'], $target)){
    echo "Success";
  }else{
    echo "<script>console.log('Error de carga')</script>";
  }

  if($result){
    echo "Success!";
  }else{
    echo "<script type='text/javascript'>alert('Se ha generado un error');</script>";
  };

  mysqli_free_result($result);
  mysqli_close($conn);
  
  header('Location:centro_ads.php');

};

?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creacion de admin</title>
    <link rel="shorcut icon" type="img/png" href="img/favicon.png">
    <link rel="stylesheet" type="text/css" href="admin_controll.css">
    <style>
        .title {
            text-align: center;
            color:#D7627C; 
            text-shadow: 1.5px 1px 2px #000;
        }
    </style>
</head>
<body>
<?php require_once('admin_navbar.php')?>
<br>
<h2 class="text-center title">Crear Anuncio</h2>
<br>
<section class="container">
<form method="POST" enctype="multipart/form-data">
  <div class="form-row">
    
    <div class="form-group col-md-6">
      <label for="inputPassword4">Nombre de Anuncio:</label>
      <input type="text" name="anuncio"  class="form-control" id="inputPassword4" placeholder="Inrtoduce apellido">
    </div>
  </div>
  <div class="form-group col-md-2">
      <label for="inputZip">Imagen:</label>
      <input type="file" class="form-control" name="imagen" value="<?php echo $images;?>" id="inputZip">
    </div>
  <div class="form-row">
  <label for="inputPassword4">Posición:</label>
  <select name="numero" class="custom-select" id="inputGroupSelect01">
            <option selected>--</option>
            <option value="1st">Primero</option>
            <option value="2nd">Segundo</option>
            <option value="3rd">Tercero</option>
        </select>
  </div>
  <br>
  
  <a href="centro_ads.php" class="btn btn-info">Regresar</a>
  <input type="submit" name="insert" class="btn btn-info" value="Crear">
</form>
</section>
<br>
</body>
</html>