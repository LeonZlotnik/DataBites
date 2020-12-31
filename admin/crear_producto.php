<?php
//Creación de Producto
if(isset($_POST['create'])){

$sku = $_POST['sku'];
$product = $_POST['producto'];
$brand = $_POST['marca'];
$unit = $_POST['unidad_c'];
$measure = $_POST['medida'];
$price = $_POST['precio'];
$avg = $_POST['promedio_c'];

$conn = mysqli_connect("localhost","root","root","H_tostada") or die("error en conexion ".mysqli_connect_error());
        mysqli_set_charset($conn, "utf8");

$sql = "INSERT INTO inventarios (sku, producto, marca, unidad_c, medida, precio, promedio_c) VALUES ('$sku','$product','$brand','$unit','$measure','$price','$avg');";
$result = mysqli_query($conn, $sql) or die ("error en query $sql".mysqli_error());


if($result){
  echo "Success!";
}else{
  echo "<script type='text/javascript'>alert('Se ha generado un error');</script>";
};

mysqli_free_result($result);
mysqli_close($conn);

header('Location:inventariodb.php');

}
//Edición de Producto

$id = 0;
$update = false;

if(isset($_GET['edit'])){
  $conn = mysqli_connect("localhost","root","root","H_tostada") or die("error en conexion ".mysqli_connect_error());
  mysqli_set_charset($conn, "utf8");

    $id = $_GET['edit'];
    $update = true;
    $query = "SELECT * FROM inventarios WHERE sku = '$id'";
    $result = mysqli_query($conn, $query) or die ("error en query $query".mysqli_error());
   if(count($result)==1){

      $row = $result->fetch_array();
      $sku = $_POST['sku'];
      $product = $_POST['producto'];
      $brand = $_POST['marca'];
      $unit = $_POST['unidad_c'];
      $measure = $_POST['medida'];
      $price = $_POST['precio'];
      $avg = $_POST['promedio_c'];
   //};


if(isset($_POST['update']) and $_SERVER['REQUEST_METHOD'] == "POST"){
  
    $new_sku = $_POST['sku'];
    $new_product = $_POST['producto'];
    $new_brand = $_POST['marca'];
    $new_unit = $_POST['unidad_c'];
    $new_measure = $_POST['medida'];
    $new_price = $_POST['precio'];
    $new_avg = $_POST['promedio_c'];
 
  $mysql = ("UPDATE inventarios SET sku= '$new_sku', producto= '$new_product', marca= '$new_brand', unidad_c= '$new_unit', medida= '$new_measure', precio= '$new_price', promedio_c= '$new_avg' WHERE sku='$id'");

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
    <title>Contacto</title>
    <link rel="shorcut icon" type="img/png" href="img/favicon.png">
    <link rel="stylesheet" type="text/css" href="admin_controll.css">
</head>
<body>
<?php require_once('admin_navbar.php')?>
<br>
<h2 class="text-center">Nuevo Producto</h2>
<br>
<section class="container">
<form method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id_producto" value="<?php echo $id;?>">
  <div class="form-row">
    <label for="inputAddress2">Nombre de Producto:</label>
    <input type="text" class="form-control" id="inputAddress2" name="producto" value="<?php echo $product;?>" placeholder="Introduce nombre" require>
  </div>
  <br>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">SKU:</label>
      <input type="text" class="form-control"  name="sku" value="<?php echo $sku;?>" id="inputCity" placeholder="000" require>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Marca:</label>
      <input type="text" class="form-control" name="marca" value="<?php echo $brand;?>" id="inputZip" placeholder="Marca de Procuto">
    </div>
    <div class="form-group col-md-6">
      <label for="inputCity">Cantidad:</label>
      <input type="number" step="0.01" min="0" max="100000" class="form-control"  name="unidad_c" value="<?php echo $unit;?>" id="inputCity" placeholder="00 Gr/Lt">
    </div>
    <div class="form-group col-md-2">
    <label for="inputEmail4">Medición:</label>
      <select id="inputState" class="form-control" name="medida">
        <option value="<?php echo $measure;?>"><?php echo $measure;?></option>
        <option value="Gramos">Gr</option>
        <option value="Litros">Lt</option>
      </select>
    </div>
  </div>

  <br>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Precio:</label>
      <input type="number" step="0.01" min="0" max="100000" class="form-control"  name="precio" value="<?php echo $price;?>" id="inputCity" placeholder="$00.00">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Consumo Promedio Semanal:</label>
      <input type="number" step="0.01" min="0" max="100000" class="form-control" name="promedio_c" value="<?php echo $avg;?>" id="inputZip" placeholder="00 Gr/Lt">
    </div>
    <div class="form-group col-md-2">
      
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