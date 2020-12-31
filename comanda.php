<?php
    session_start();
    $USR = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comanda</title>
    <style>
        .title {
            text-align: center;
        }

        .comanda{
            position:fixed; bottom:40px; right:20px;
            transform: translateX(-50%);
            background: linear-gradient(to top, #7DB085, #E6F5DD);
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
        #total{
            position:fixed; bottom:35px; left:20px;
            /*color: 16327F;*/
        }
    </style>
</head>
<body>
<?php include_once('nav_bar.php') ?>

    <div class="comanda">
        <a href="cuenta.php"><i class="fas fa-shopping-cart"></i></a>
    </div>

    <section class="container">

    <br>
        <h3 class="h2 title">Comanda</h3>
    <br>

    <?php 
         $conn = mysqli_connect("localhost","root","root","H_tostada");
         $conn->set_charset("utf8");
         if($conn -> connect_erro){
             die("La Conexion Fallo: ".$conn-> connect_error);
         }

        echo "
        <div class='table-responsive'>
        <table class='table table-hover'>
                    <thead>
                        <tr class='table-info'>
                            <th scope='col'>Usuario</th>
                            <th scope='col'>Plato</th>
                            <th scope='col'>Precio</th>
                            <th scope='col'>Cantidad</th>
                            <th scope='col'>Total</th>
                            <th scope='col'>Especificación</th>
                            <th scope='col'>Porción</th>
                            <th scope='col'>Tiempo</th>
                            <th scope='col'>Eliminar</th>
                        </tr>
                    </thead>";

                    $sql = "SELECT *,(costo*cantidad) AS total FROM comandas_iniciales WHERE usuario = '$USR' AND DATE(registro) = CURDATE()";
                    $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());

                    if($result-> num_rows > 0) {
                    
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                            <tbody>
                            <th scope='row'>".$row["usuario"]."</th>
                            <td>".$row["platillo"]."</td>
                            <td>$".$row["costo"]."</td>
                            <td>".$row["cantidad"]."</td>
                            <td>$".$row["total"]."</td>
                            <td>".$row["specs"]."</td>
                            <td>".$row["size"]."</td>
                            <td>".$row["registro"]."</td>
                            <td><a href='comandas.php?delete=".$row["platillo"]."'><i class='fas fa-trash-alt'></i></a></td>";
                }
                    echo "
                        </tbody>
                    </table>
                </div>";
                }
                else {
                    echo "<div class='alert alert-warning' role='alert'>
                    No hay información por el momento.
                          </div>";
                }

                foreach($result as $value){
                    $total += $value["total"];
                };

                if(isset($_GET['delete'])){
                    $id = $_GET['delete'];
                    $conn->query("DELETE FROM comandas_iniciales WHERE platillo = '$id'");
                };
    
                //$connect-> close();
    
    ?>
    </section>

    <section class="container">
    <span id="total" class="btn btn-light h4">Total: $<?php echo $total ?></span>
    <?php  echo "<a href='cuenta.php?Total={$total}' class='btn btn-info btn-lg btn-block' id='boton-pago'><i class='fas fa-dollar-sign'></i>Ordenar</a>"; ?>
    </section>
</body>
</html>