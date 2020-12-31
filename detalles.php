<?php
   session_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles</title>
    <style>
        .comanda{
            position:fixed; bottom:40px; right:20px;
            transform: translateX(-50%);
            background: linear-gradient(to top, #4ae7ff, #CFEEF9 );
            width: 50px;
            height: 50px;
            line-height: 55px;
            font-size: 22px;
            text-align: center;
            color: #fff;
            border-radius: 50%;
            cursor: pointer;
            z-index: 5;
        }
    
        .comanda a{
            color: white;
            position: relative; top: 1px;
        }

        .title {
            text-align: center;
        }
        
    </style>
</head>
<body>
<?php include_once('nav_bar.php') ?>

    <div class="comanda">
        <a href="comanda.php"><i class="fas fa-shopping-cart"></i></a>
    </div>

<?php

$db = mysqli_connect("localhost","root","root","H_tostada");
$db->set_charset("utf8");
    if($db->connect_error){
        die("La Conexion Fallo: ".$db->connect_error);
    }

if(isset($_GET['ID'])){

    $ID = mysqli_real_escape_string($db, $_GET['ID']);
    $N = mysqli_real_escape_string($db, $_GET['platillo']);

$sql = "SELECT * FROM platillos WHERE id_platillo = $ID";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result);

    /*if(isset($_POST['sum'])){
        $postid = $_POST['platillos_id'];
        $result = mysql_query("SELECT * FROM platillos WHERE id_platillo = $ID");
        $line = mysql_fetch_array($result);
        $n = $line['likes'];
        
        mysql_query("UPDATE platillos SET likes = $n+1 WHERE id_platillo = $ID");
        mysql_query("INSERT INTO likes(usuario_id,platillos_id) VALUES (2,$postid)");
        exit();
        }
    */

}else{
    echo "Error";
}

if(isset($_POST['add_to_cart'])){

    $db = mysqli_connect("localhost","root","root","H_tostada");
    $db->set_charset("utf8");
    if($db->connect_error){
        die("La Conexion Fallo: ".$db->connect_error);
    }

    $username = $_POST["usuario"];
    $product = $_POST["platillo"];
    $price = $_POST["costo"];
    $amount = $_POST["cantidad"];
    $specs = $_POST["specs"];
    $status = $_POST["status"];
    $size = $_POST["size"];
    
  
  $sql = "INSERT INTO comandas_iniciales (usuario, platillo, costo, cantidad, specs, status, size) VALUES ('$username','$product','$price','$amount','$specs','$status','$size')";
  
  $res = mysqli_query($db, $sql); //or die ("error en query $sql".mysqli_error());
  
  if($res){
    $success = "<div class='alert alert-success' role='alert'>
          El producto fue agregado exitosamente!
          </div>";
  }else{
    $error = "<div class='alert alert-danger' role='alert'>
    Verifique su nombre de ususario, revise en Preferencias.
    </div>";
  };
  
  mysqli_free_result($res);
  mysqli_close($db);
  
  
  }

?>
    <div class="container">
        <br>
        <h2 class="h2 title">Detalles</h2>
        <br>
            <div class="card-deck">
                <div class="card mb-3">
                    <img class="card-img-top" <?php echo "src='admin/img_menu/".$row['imagen']."'";?> alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['platillo'];?></h5>
                        <input type="submit" name="sum" value="Like" class="btn btn-info">
                        <br>
                        <br>
                        <div id="accordion">
                       
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Detalles del plato
                                    </button>
                                </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <?php echo $row['detalle'];?>
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="input-group-text" id="btnGroupAddon">$ <?php echo $row['precio']?> MXN</div>
                    
                        <br>
                        <div id="accordion">
        
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Ordenar
                                    </button>
                                </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <form action="" method="POST">
                        
                                        <div class="card-body">
                                            <p class="h5">Porciones:</p>
                                            <select class="custom-select" name="size" id="inputGroupSelect01">
                                                <option selected>...</option>
                                                <option value="grande">Grande</option>
                                                <option value="mediano">Mediano</option>
                                            </select>
                                            <br>
                                            <br>
                                            <div class="form-group">
                                            <p class="h5">Especificaciones:</p>
                                                <textarea class="form-control" name="specs" id="exampleFormControlTextarea1" rows="3" placeholder="Personalise su orden."></textarea>
                                            </div>
                                        
                                            <p class="h5">Cantidad:</p>
                                            <select class="custom-select" name="cantidad" id="inputGroupSelect01">
                                                <option selected value="null">...</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                            <input type="hidden" name="platillo" min="0" max="10" value="<?php echo $row['platillo']?>" class="form-control" id="inputCity" placeholder="0">
                                            <input type="hidden" name="usuario" value="<?php echo $_SESSION['usuario'] ?>" class="form-control" id="inputCity" placeholder="0">
                                            <input type="hidden" name="costo" min="0" max="10" value="<?php echo $row['precio']?>" class="form-control" id="inputCity" placeholder="0">
                                            <input type="hidden" name="status" min="0" max="10" value="Comanda" class="form-control" id="inputCity" placeholder="0">
                                            </div>  
                                            
                                            <button type="submit" name="add_to_cart" class="btn btn-outline-info">Agregar</button>      
                                    </form>
                                </div>
                                </div>
                            </div>
                            
                        </div>


                        </div>
                        <div class="container">
                            <?php echo $success ?>
                            <?php echo $error ?>
                        </div>
    </div>

</body>
</html>
