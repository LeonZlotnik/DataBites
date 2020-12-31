<?php
//Creación de Producto
if(isset($_POST['create'])){

$target = "/Applications/MAMP/htdocs/PHP-Python/DataBites_app/admin/img_menu/".basename($_FILES['imagen']['name']);

$dish = $_POST['platillo'];
$category = $_POST['categoria'];
$status = $_POST['estado'];
$price = $_POST['precio'];
$cost = $_POST['costo'];
$image = $_FILES['imagen']['name'];
$desc = $_POST['descripcion'];
$ext = $_POST['detalle'];

$conn = mysqli_connect("localhost","root","root","H_tostada") or die("error en conexion ".mysqli_connect_error());
        mysqli_set_charset($conn, "utf8");

$sql = "INSERT INTO platillos (platillo, categoria, estado, precio, costo, imagen, descripcion, detalle) VALUES ('$dish','$category','$status','$price', '$cost','$image','$desc','$ext');";
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

header('Location:menudb.php');

}
//Edición de Producto

$id = 0;
$update = false;

if(isset($_GET['edit'])){
  $conn = mysqli_connect("localhost","root","root","H_tostada") or die("error en conexion ".mysqli_connect_error());
  mysqli_set_charset($conn, "utf8");

    $id = $_GET['edit'];
    $update = true;
    $query = "SELECT * FROM platillos WHERE id_platillo = '$id'";
    $result = mysqli_query($conn, $query) or die ("error en query $query".mysqli_error());
   if(count($result)==1){

      $row = $result->fetch_array();
      $dish = $_POST['platillo'];
      $category = $_POST['categoria'];
      $status = $_POST['estado'];
      $price = $_POST['precio'];
      $cost = $_POST['costo'];
      $image = $_FILES['imagen']['name'];
      $desc = $_POST['descripcion'];
      $ext = $_POST['detalle'];
   //};


if(isset($_POST['update']) and $_SERVER['REQUEST_METHOD'] == "POST"){
  
  $new_target = "/Applications/MAMP/htdocs/PHP-Python/DataBites_app/admin/img_menu/".basename($_FILES['imagen']['name']);
  
      $new_dish = $_POST['platillo'];
      $new_category = $_POST['categoria'];
      $new_status = $_POST['estado'];
      $new_price = $_POST['precio'];
      $new_cost = $_POST['costo'];
      $new_image = empty($_FILES['imagen']['name']) ? $row['imagen'] : $_FILES['imagen']['name'];
      $new_desc = $_POST['descripcion'];
      $new_ext = $_POST['detalle'];
 
  $mysql = ("UPDATE platillos SET platillo= '$new_dish', categoria= '$new_category', estado= '$new_status', precio= '$new_price', costo= '$new_cost', imagen= '$new_images', descripcion= '$new_desc', detalle= '$new_ext' WHERE id_platillo='$id'");

  $res = mysqli_query($conn, $mysql) or die ("error en query $mysql".mysqli_error());
  
  if(move_uploaded_file($_FILES['imagen']['tmp_name'], $new_target)){
  echo "Success";
    }else{
  echo "<script>console.log('Error de carga')</script>";
    }

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
<h2 class="text-center">Crear Plato</h2>
<br>
<section class="container">
<form method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id_producto" value="<?php echo $id;?>">
  <div class="form-row">
    <label for="inputAddress2">Nombre del Plato:</label>
    <input type="text" class="form-control" id="inputAddress2" name="platillo" value="<?php echo $product;?>" placeholder="Introduce nombre">
  </div>
  <br>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Categoría:</label>
      <select id="inputState" class="form-control" name="categoria">
        <option value="<?php echo $category;?>"><?php echo $category;?></option>
        <option value="Bebidas">Bebidas</option>
        <option value="Entradas">Entradas</option>
        <option value="Platillos">Platillos</option>
        <option value="Especialidades">Especialidades</option>
        <option value="Postres">Postres</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Estado:</label>
      <select id="inputState" class="form-control" name="estado">
        <option value="<?php echo $estado;?>"><?php echo $estado;?></option>
        <option value="Existente">Existente</option>
        <option value="Agotado">Agotado</option>
      </select>
    </div>
  </div>
  <br>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Precio Venta:</label>
      <input type="number" step="0.01" min="0" max="100000" class="form-control"  name="precio" value="<?php echo $price;?>" id="inputCity" placeholder="$00.00">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Costo:</label>
      <input type="number" step="0.01" min="0" max="100000" class="form-control" name="costo" value="<?php echo $sku;?>" id="inputZip" placeholder="$00.00">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Imagen:</label>
      <input type="file" class="form-control" name="imagen" value="<?php echo $images;?>" id="inputZip">
    </div>
  </div>
  
  <?php if($update == true){?>
    <br>
    <label for="inputZip">Imagen Cargada:</label>
    <div class='card' style='width: 18rem;'>
        <img class='card-img-top' <?php echo "src='./images/".$row['imagen']."'";?> alt='Imagen de Producto'>
    </div>
    <br>
  <?php };?>
  
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Descripción</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="descripcion" rows="3"><?php echo $desc;?></textarea>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Especificaciones</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="detalle" rows="3"><?php echo $ext;?></textarea>
  </div>
  <div class="form-group">
  </div>
  <a href="menudb.php" class="btn btn-info">Regresar</a> <!--Cambio Variable GET-->
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