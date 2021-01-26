<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Anuncios</title>
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
        .margin{
            margin-left: 2%;
            margin-right:2%;
        }
    </style>
</head>
<body>
<?php include_once('admin_navbar.php') ?>

    <div class="container">
        <br>
        <h3 class="title">Control de Anuncios</h3>
        <br>
        <div class="col text-center">
            <a class="btn btn-info btn-lg" href="panel.php">Atras</a>
        
            <a href="crear_anuncio.php" class="btn btn-default btn btn-info btn-lg">Crear Anuncio</a>
        </div>
        <br>

            <?php

            require_once('../z_connect.php');
            $sql = "SELECT * FROM anuncios ORDER BY 'numero' ASC";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)){
          ?>

           <div class="card-deck">
                <div class="card mb-3">
                    <img class="card-img-top" <?php echo "src='anuncios/".$row['imagen']."'";?> alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['anuncio']?></h5>
                        <p><i>Status: <?php echo $row['status']?></i></p>
                        <br>
                        <div class="cantidad">
                            <a href="centro_ads.php?start=<?php echo $row['id_anuncio']?>" class="btn btn-outline-success">Publicar</a>
                            <a href="centro_ads.php?pause=<?php echo $row['id_anuncio']?>" class="btn btn-outline-warning margin">Detener</a>
                            <a href="centro_ads.php?delete=<?php echo $row['id_anuncio']?>" class="btn btn-outline-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
           
            <?php
            
                }
                if(isset($_GET['start'])){
                    $id = $_GET['start'];
                    $conn->query("UPDATE anuncios SET status ='Activo' WHERE id_anuncio = '$id'");
                }
                if(isset($_GET['pause'])){
                    $id = $_GET['pause'];
                    $conn->query("UPDATE anuncios SET status ='Detenido' WHERE id_anuncio = '$id'");
                }
                if(isset($_GET['delete'])){
                    $id = $_GET['delete'];
                    $conn->query("DELETE FROM anuncios WHERE id_anuncio = '$id'");
                }
                mysqli_close($conn); 
            ?>
    </div>       
</body>
</html>