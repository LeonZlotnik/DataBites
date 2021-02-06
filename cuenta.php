<?php
    session_start();
    $USR = $_SESSION['usuario'];
    //$MSA = $_SESSINO['m'];

    if($USR == null){
        header("location:preferencias.php");
    }

if (isset($_POST['invitar'])) {
    require_once('z_connect.php');
    $users = implode(", ", $_POST['usuarios']);

    $sqlMesa= "update comandas c set c.invita='$USR', c.estatus_invitacion='PENDIENTE' where c.status='cuenta' and DATE(c.registro) = CURDATE() and c.mesa = (SELECT * FROM(SELECT distinct(cm.mesa) FROM comandas cm  where cm.usuario='$USR')mesa) and c.usuario in ('$users')";
    $res = mysqli_query($conn, $sqlMesa) or die ("error en query $sqlMesa".mysqli_error());

    if($res){
        echo "";
    }else{
        echo"Error";
    };
    header("Refresh:0");
//    echo"<script type=" . "text/javascript" . ">
//    alert('" . $users . "');
//    </script>";
}

if (isset($_POST['aceptar_invitacion'])) {
    require_once('z_connect.php');

    $sqlupdateComandasFinales= "update comandas c set c.estatus_invitacion='ACEPTADA' where c.status='cuenta' and DATE(c.registro) = CURDATE() and c.mesa = (SELECT * FROM(SELECT distinct(cm.mesa) FROM comandas cm  where cm.usuario='$USR')mesa) and c.usuario in ('$USR')";
    $res = mysqli_query($conn, $sqlupdateComandasFinales) or die ("error en query $sqlupdateComandasFinales".mysqli_error());

    if($res){
        echo "";
    }else{
        echo"Error";
    };
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
<form action="" method="POST">
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

                    $sql = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas WHERE usuario = '$USR' OR invita='$USR' AND estatus_invitacion='ACEPTADA' AND status = 'Cuenta' AND DATE(registro) = CURDATE()" ;
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
    <a href="cobro.php" class='btn btn-success btn-lg btn-block'>Pagar</a>
       
    <br>
    </section>

<section class="container">
    <?php
    require_once('z_connect.php');

    echo "
    <br>
    <br>
    <div class='row'>
    <div class='col-6'>
    

        <h5>Agrega los Usuario que quieres invitar</h5>
        <div class='table-responsive'>
        <table class='table table-hover'>
                    <thead>
                        <tr class='table-success'>
                            <th scope='col'>Usuario</th>
                            
                        </tr>
                    </thead>";

    $sql = "SELECT DISTINCT (usuario) FROM comandas where mesa = (select distinct(mesa) from comandas where usuario = '$USR' AND DATE(registro) = CURDATE()) and usuario not in ('$USR')" ;
    $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());

    if($result-> num_rows > 0) {
        $i=0;
        while($row = mysqli_fetch_assoc($result)){
            echo "
                            <tbody>
                            <td>
                                <label id=". row["usuario"] ." for=". "users" . ++$i .">
                                    " . $row["usuario"] . "
                                </label>
                             <input type='checkbox' id=". "user" . $i ." name=" . "usuarios[]" ."
                                value=".$row["usuario"].">  
                            </td>
                             ";

        }
        echo "
                        </tbody>
                    </table>
                </div>
                </div>
                <div class='col-6'>";

        $sqlInvita = "SELECT DISTINCT (invita) FROM comandas where mesa = (select distinct(mesa) from comandas where usuario = '$USR' AND DATE(registro) = CURDATE()) and usuario in ('$USR')" ;
        $resInvita= $conn-> query($sqlInvita) or die ("error en query $sqlInvita".mysqli_error());

        if($resInvita-> num_rows > 0) {
            while($invitacion = mysqli_fetch_assoc($resInvita)){
                if($invitacion['invita']!=null){
                    echo "<div class='alert alert-warning' role='alert'>
                        Tienes una invitación de parte de:". $invitacion['invita']. "
                    </div>
                         <input class=\"btn btn-success\" type=\"submit\" name=\"aceptar_invitacion\" value=\"Aceptar\" >
                        ";
                }
                else{
                    echo "<div class='alert alert-warning' role='alert'>
                    No hay información por el momento.
                          </div>";
                }
            }
        }
        echo"</div>
                ";
    }
    else {
        echo "<div class='alert alert-warning' role='alert'>
                    No hay información por el momento.
                          </div>";
    }
    "
        </div>
    </div>
    </form>
    "
    ?>
</section>

<section class="container">
    <div class="row">
        <div class="col-4">
        </div>
        <div class="col-4">
            <input class="btn btn-success" type="submit" name="invitar" value="Invitar" >
        </div>
        <div class="col-4">
        </div>
    </div>
    <br>
</section>


    <?php
        mysqli_close($conn);
    ?>
</body>
</html>