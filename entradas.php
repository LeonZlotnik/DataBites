<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entradas</title>
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
        <a href="comanda.php"><i class="fas fa-utensils"></i></a>
    </div>

    <section class="container">
        <br>
        <h2 class="title">Entradas</h2>
        <br>
       

        <?php
            $db = mysqli_connect("localhost","root","root","H_tostada");

            $db->set_charset("utf8");
            if($db->connect_error){
                die("La Conexion Fallo: ".$db->connect_error);
            }

            $sql = "SELECT * FROM platillos WHERE categoria = 'entradas' ORDER BY 'estado' ASC, 'platillo' DESC";
            $result = mysqli_query($db, $sql);
            while ($row = mysqli_fetch_array($result)){
        ?>

            <div class="card-deck">
                <div class="card mb-3">
                    <img class="card-img-top" <?php echo "src='admin/img_menu/".$row['imagen']."'";?> alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['platillo']?></h5>
                        <div class="btn btn-light">
                            Likes <span class="badge badge-light"><?php echo $row['likes']?></span>
                        </div>
                        <br>
                        <br>
                        <p class="card-text"><?php echo $row['descripcion']?></p>
                        <div class="input-group-text" id="btnGroupAddon">$ <?php echo $row['precio']?> MXN</div>
                        <br>
                        <div class="cantidad">
                            <?php echo "<a href='detalles.php?ID={$row['id_platillo']}&plato={$row['platillo']}' class='btn btn-outline-info'>Detalles</a>" ?>
                        </div>
                    </div>
                <?php
            }
                ?>
    </section>
</body>
</html>

