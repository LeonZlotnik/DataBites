<?php
    session_start();

    if(isset($_POST['crear'])){
        require_once('z_connect.php');

        $mail = $_POST['cliente'];
        $pw = $_POST['pw'];
        $birth = $_POST['cumple'];

        $sql = "INSERT INTO clientes (cliente, pw, cumple) VALUES ('$mail', '$pw', '$birth')";
        $result = mysqli_query($conn, $sql) or die ("error en query $sql".mysqli_error());

        if($result){
            $success = "<br><div class='alert alert-success' role='alert'>
            ¡Felicidades! Ahora es parte de nuestros clientes consentidos.
            </div><br>";
          }else{
            echo "<script type='text/javascript'>alert('Se ha generado un error');</script>";
          };
          
          mysqli_free_result($result);
          mysqli_close($conn);
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferencias</title>
    <style>
        .title {
            text-align: center;
            color:#D7627C; 
            text-shadow: 1.5px 1px 2px #000;
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
    </style>
</head>
<body>
<?php include_once('nav_bar.php') ?>

<div class="comanda">
        <a href="comanda.php"><i class="fas fa-utensils"></i></a>
    </div>

    <div class="container">
        <br>
        <h3 class="title">Preferencias</h3>
        <br>
        <div class="alert alert-primary" role="alert">
        <?php 
            echo "Usuario: ".$_SESSION['usuario'];
        ?>
        </div>
        <div class="alert alert-info" role="alert">
        <?php 
            echo "Mesa: ".$_SESSION['m'];
        ?>
        </div>
        <div class="container">
                        <?php echo $success ?>
        </div>
        <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Cliente Frecuente
                                </button>
                            </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                <br>
                                <br>
                                <form action="" method="POST">
                                    <label for="exampleFormControlInput1">Mail</label>
                                    <input type="email" name="cliente" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                    <br>
                                    <label for="exampleFormControlInput1">Cumpleaños</label>
                                    <input type="date" name="cumple" class="form-control" id="exampleFormControlInput1" placeholder="fecha de nacimiento">
                                    <br>
                                
                                    <label for="exampleFormControlInput1">Contraseña</label>
                                    <input type="password" name="pw" class="form-control" id="exampleFormControlInput1" placeholder="contraseña">
                                    <br>
                                    <button type="submit" name="crear" class="btn btn-primary btn-lg btn-block">Agregar</button>
                                </form>
       
                            </div>
                           
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Idioma
                                </button>
                            </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Español
                                        </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Ingles
                                        </label>
                                        <br>
                                        <br>
                                        <button type="button" class="btn btn-primary btn-lg btn-block">Cambiar</button>
                                </div>
                                <br>
                            </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Comentarios
                                </button>
                            </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                            <div class="card-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.
                                <br>
                                <br>
                                <div class="input-group">
                                    <textarea class="form-control" aria-label="With textarea"></textarea>
                            </div>
                                <br>
                                <button type="button" class="btn btn-primary btn-lg btn-block">Enviar</button>
                            </div>
                        </div>
                        </div>
                        </div>
                    
    </div>
</body>
</html>