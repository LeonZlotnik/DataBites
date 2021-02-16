<?php
require '../z_connect.php';
//Creación de Producto
if(isset($_POST['create'])){

$condimento = $_POST['condimento'];
$valor = $_POST['valor'];



$sql = "INSERT INTO extras ( condimento, valor) VALUES ('$condimento','$valor');";
$result = mysqli_query($conn, $sql) or die ("error en query $sql".mysqli_error());


if($result){
  echo "Success!";
}else{
  echo "<script type='text/javascript'>alert('Se ha generado un error');</script>";
};

mysqli_free_result($result);
mysqli_close($conn);

header('Location:extras.php');

}
//Edición de Producto

$id = 0;
$update = false;

if(isset($_GET['edit'])){

    $id = $_GET['edit'];
    $update = true;
    $query = "SELECT * FROM extras WHERE id_condimento = '$id'";
    $result = mysqli_query($conn, $query) or die ("error en query $query".mysqli_error());
   if(count($result)==1){

    $row = $result->fetch_array();
    $condimento = $_POST['condimento'];
    $valor = $_POST['valor'];
    //};


    if(isset($_POST['update']) and $_SERVER['REQUEST_METHOD'] == "POST"){
      
      $new_condimento = $_POST['condimento'];
      $new_valor = $_POST['valor'];
    
      $mysql = ("UPDATE extras SET condimento= '$new_condimento', valor= '$new_valor' WHERE platillo='$id'");

      $res = mysqli_query($conn, $mysql) or die ("error en query $mysql".mysqli_error());

      if($res){
        echo "Success!";
      }else{
        echo "<script type='text/javascript'>alert('Se ha generado un error');</script>";
      };
      
      mysqli_free_result($mysql);
      mysqli_close($conn);

      header('Location:menudb.php');
    };

  };

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear extra</title>
    <link rel="shorcut icon" type="img/png" href="img/favicon.png">
    <link rel="stylesheet" type="text/css" href="admin_controll.css">
</head>
<body>
<?php require_once('admin_navbar.php')?>
<br>
<h2 class="text-center">Nuevo extra</h2>
<br>
<section class="container">
<form method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id_condimento" value="<?php echo $id;?>">
  <div class="form-row">
    <label for="inputAddress2">Nombre del extra:</label>
    <input type="text" class="form-control" id="inputAddress2" name="condimento" value="<?php echo $condimento ?? "";?>" placeholder="Introduce nombre" require>
  </div>
  <br>

  <div class="form-row">
    <div class="form-group col-12">
      <label for="inputCity">Precio:</label>
      <input type="number" step="0.01" min="0" max="100000" class="form-control"  name="valor" value="<?php echo $price;?>" id="inputCity" placeholder="$00.00">
    </div>
  </div>
  
  <a href="inventariodb.php" class="btn btn-info">Regresar</a> <!--Cambio Variable GET-->
  <?php if($update == true){?>
  <input class="btn btn-warning" type="submit" name="update" value="Editar" id="gridCheck">
  <p><?php echo $mysql;?></p>
  <?php }else{?>
  <input class="btn btn-info" type="submit" name="create" value="Crear" id="gridCheck">
  <?php }?>
</form>
</section>
<br>
</body>
</html>