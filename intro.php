<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu principal</title>
    <style>
        .slider-h{
            height: 25vh;
        }

        .title {
            text-align: center;
            color:#D7627C; 
            text-shadow: 1.5px 1px 2px #000;
        }

        .contain{
            width:80%;
            min-height: 960px;
            background-color: #000;
            margin: 30px auto 0;
            display: felx;

        }

        .contain .box{
            position: relative; top:15px;
            width: 80%;
            height: 100px;
            background-color: yellow;
            margin: 0 10% 0 10%;
            box-sizing: border-box;
            display: inline-block;
        }

        .contain .box .imgBox{
            position: relative;
            overflow: hidden;
        }

        .contain .box .imgBox img{
            max-width: 100%;
            transition: transform 2s;
        }

        .contain .box:hover .imgBox img{
            transform: scale(1.2);
        }

        .contain .box .details{
            position: absolute; top: 10px; left:10px; bottom: 10px; right:10px;
            background-color: rgba(0,0,0,.8);
            height: 21vh;
        }

        .contain .box .details .content{
            position: absolute; top: 50%
            transform: translateY(-50%);
            text-align: center;
            color: #fff;
        }

        .contain .box .details .content h2{
            margin: 0;
            padding: 0;
            color: #4ae7ff;
        }

        .contain .box .details .content p{
            margin: 0;
            padding: 0;
            color: #fff;
        }

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

        @media only screen and (min-width: 500px){
            .slider-h{
            height: 40vh;
        }

        .contain{
            width:80%;
            min-height: 500px;
            background-color: #000;
            margin: 30px auto 0;
            display: felx;
        }

        .contain .box{
            position: relative; top:15px;
            width: 80%;
            height: 200px;
            background-color: yellow;
            margin: 0 10% 0 10%;
            box-sizing: border-box;
            display: inline-block;
        }

        .contain .box .imgBox{
            position: relative;
            overflow: hidden;
        }

        .contain .box .imgBox img{
            width: 100%;
            transition: transform 2s;
        }

        .contain .box:hover .imgBox img{
            transform: scale(1.2);
        }

        .contain .box .details{
            position: absolute; top: 10px; left:10px; bottom: 10px; right:10px;
            background-color: rgba(0,0,0,.8);
            height: 21vh;
        }

        .contain .box .details .content{
            position: absolute; top: 50%
            transform: translateY(-50%);
            text-align: center;
            color: #fff;
        }

        .contain .box .details .content h2{
            margin: 0;
            padding: 0;
            color: #4ae7ff;
        }

        .contain .box .details .content p{
            margin: 0;
            padding: 0;
            color: #fff;
        }
        }
    </style>
</head>
<body>
    <?php include_once('nav_bar.php') ?>
    <?php include_once('notificacion.php')?>
    <br>

    <div class="comanda">
        <a href="comanda.php"><i class="fas fa-shopping-cart"></i></a>
    </div>


        <h2 class="h2 title">Menu Principal</h2>
    <br>

    <div class="container" id="slider-cut">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 slider-h" src="img/Logo_black.png" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 slider-h" src="img/Logo_black.png" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100 slider-h" src="img/Logo_black.png" alt="Third slide">
    </div>
  </div>
</div>
    </div>
    <br>
    <div class="contain">
        <div class="box">
            <div class="imgBox">
                <img src="img/restaurante.jpeg" alt="">
            </div>
            <a href="bebidas.php">
            <div class="details">
                <div class="content">
                    <h2>Bebidas</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque unde tempore corrupti.</p>
                </div>
            </div>
            </a>
        </div>
        <br>
        <br>
        <div class="box">
            <div class="imgBox">
                <img src="img/restaurante.jpeg" alt="">
            </div>
            <a href="entradas.php">
            <div class="details">
                <div class="content">
                    <h2>Entradas</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque unde tempore corrupti.</p>
                </div>
            </div>
            </a>
        </div>
        <br>
        <br>
        <div class="box">
            <div class="imgBox">
                <img src="img/restaurante.jpeg" alt="">
            </div>
            <a href="platillos.php">
            <div class="details">
                <div class="content">
                    <h2>Platillos</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque unde tempore corrupti.</p>
                </div>
            </div>
            </a>
        </div>
        <br>
        <br>
        <div class="box">
            <div class="imgBox">
                <img src="img/restaurante.jpeg" alt="">
            </div>
            <a href="especialidades.php">
            <div class="details">
                <div class="content">
                    <h2>Especialidades</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque unde tempore corrupti.</p>
                </div>
            </div>
            </a>
        </div>
        <br>
        <br>
        <div class="box">
            <div class="imgBox">
                <img src="img/restaurante.jpeg" alt="">
            </div>
            <a href="postres.php">
            <div class="details">
                <div class="content">
                    <h2>Postres</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque unde tempore corrupti.</p>
                </div>
            </div>
            </a>
        </div>
    </div>
</body>
</html>