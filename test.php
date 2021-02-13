<?php
    session_start();
    $USR = $_SESSION['usuario'];
    //$MSA = $_SESSINO['m'];

    if($USR == null){
        header("location:preferencias.php");
    }

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
            color:#D7627C; 
            text-shadow: 1.5px 1px 2px #000;
        }

        .comanda{
            position:fixed; bottom:40px; right:20px;
            transform: translateX(-50%);
            background: linear-gradient(to top, #4ae7ff, #CFEEF9);
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
        #hidden{
            display: none;
        }
    </style>
</head>
<body>
<?php include_once('nav_bar.php') ?>

<div class="comanda">
        <a href="comanda.php"><i class="fas fa-utensils"></i></a>
    </div>

    <section class="container">

    <br>
        <h3 class="title">Cuenta</h3>
    <br>

    <?php 
         require_once('z_connect.php');

        echo "
        <div class='table-responsive'>
        <table class='table table-hover'>
                    <thead>
                        <tr class='table-success'>
                            <th scope='col'>Usuario</th>
                            <th scope='col'>Plato</th>
                            <th scope='col'>Precio</th>
                            <th scope='col'>Cantidad</th>
                            <th scope='col'>Total</th>
                            <th scope='col'>Porción</th>
                            <th scope='col'>Tiempo</th>
                        </tr>
                    </thead>";

                    $sql = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas WHERE usuario = '$USR' AND status = 'Cuenta' AND DATE(registro) = CURDATE()" ;
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
                            <td>".$row["size"]."</td>
                            <td>".$row["registro"]."</td>
                            <td id='hidden'>".$row["status"]."</td>";
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
                    $subtotal += $value["total"];
                    $total = $subtotal*1.18;
                };
    
    ?>
    </section>

    <section class="container">
    <span id="total" class="btn btn-light h4"><strong>Total: $<?php echo $total ?></strong></span>
    <a href="cobro.php?Total='<?php echo $total ?>'" class='btn btn-success btn-lg btn-block'>Pagar</a>
       
    <br>
    </section>
    <?php
        mysqli_close($conn);
    ?>
</body>
</html>