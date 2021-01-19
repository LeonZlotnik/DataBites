<?php
    //INSERT INTO tests (plato, guarniciones) VALUES ('molletes', '{"ingredientes":"tocino, cebolla", "Precio":"15, 12"}');
    
    include_once('admin_navbar.php'); 

    //$sql = 'SELECT JSON_OBJECT("Precio",15,"Ingredientes","tocino") From tests';
    //$result = mysqli_query($conn, $sql) or die ("error en query $sql".mysqli_error());
    
    $jsonobj = '{"Precio": "15, 12", 
                "Ingredientes": "tocino, cebolla"}';

$obj = json_decode($jsonobj);

$precios = $obj->Precio;
$ings = $obj->Ingredientes;

print_r($ings);



    //$row = mysqli_fetch_array($result);

    /*if(isset($_POST['add'])){
        $plate = $_POST['plato'];
        $sides = $_POST['guarniciones'];

        $query ="INSERT INTO tests (plato, guarniciones) VALUES ('$plate','$sides')";

        $res = mysqli_query($conn, $query) or die ("error en query $sql".mysqli_error());
  
  if($res){
    echo "Success";
  }else{
    echo "Error";
  };
  
  mysqli_free_result($res);
  mysqli_close($conn);
  

    }*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
<?php include_once('admin_navbar.php') ?>
<section class="container">
<form method="POST">
<br>
  <div class="form-group">
    <label for="exampleInputEmail1">Plato</label>
    <input type="text" name="plato" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter dish name">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Guarniciones</label>
    <textarea class="form-control" name="guarniciones" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
    <select class="form-control form-control-lg">
        <option><?php echo $row['ingredientes']?></option>
    </select>
    <br>
  <button type="submit" name="add" class="btn btn-primary">Submit</button>
</form>

</section>
</body>
</html>