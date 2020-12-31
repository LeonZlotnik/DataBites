<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platillos</title>
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
            color:#D7627C; 
            text-shadow: 1.5px 1px 2px #000;
        }
        .cantidad{
            display: flex;
        }

        .position{
            position: relative; left: 10%;
        }
    </style>
</head>
<body>
<?php include_once('nav_bar.php') ?>

    <div class="comanda">
        <a href="comanda.php"><i class="fas fa-shopping-cart"></i></a>
    </div>

    <section class="container">
        <br>
        <h2 class="h2 title">Platos</h2>
        <br>
       

        <?php
            $db = mysqli_connect("localhost","root","root","H_tostada");
            $db->set_charset("utf8");
            if($db->connect_error){
                die("La Conexion Fallo: ".$db->connect_error);
            }
            $sql = "SELECT * FROM platillos WHERE categoria = 'platos' ORDER BY 'estado' ASC, 'platillo' DESC";
            $result = mysqli_query($db, $sql);
            while ($row = mysqli_fetch_array($result)){
        ?>

            <div class="card-deck">
                <div class="card mb-3">
                    <img class="card-img-top" <?php echo "src='admin/img_menu/".$row['imagen']."'";?> alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['platillo']?></h5>
                        <p class="card-text"><?php echo $row['descripcion']?></p>
                        <div class="input-group-text" id="btnGroupAddon">$ <?php echo $row['precio']?> MXN</div>
                        <br>
                        <div class="cantidad">
                            <a href="detalles.php" class="btn btn-outline-info">Agregar</a>
                            <a href="detalles.php" class="btn btn-outline-info position">Detalles</a>
                        </div>
                        <br>
                        <select class="custom-select" id="inputGroupSelect01">
                                <option selected>...</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                        </select>   
                    </div>
                <?php
            }
                ?>
    </section>
</body>
</html>