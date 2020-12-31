
<?php

    if(isset($_POST['crear'])){
        $usuario = $_POST['usuario'];
        $cookie = $_POST['cookie'];

        $conn = mysqli_connect("localhost","root","root","H_tostada") or die("error en conexion ".mysqli_connect_error());
        mysqli_set_charset($conn, "utf8");

        $sql = "INSERT INTO usuarios (usuario, cookie) VALUES ('$usuario', '$cookie');";
        $result = mysqli_query($conn, $sql) or die ("error en query $sql".mysqli_error());

        if($result){
            session_start();
            $_SESSION['usuario'] = $usuario;
            header('Location:intro.php');
          }else{
            header('Location:validation.php');
          };
          
          mysqli_free_result($result);
          mysqli_close($conn); 

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Introducción</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--Captación de cookies-->
    <script>
        function clicked(){
            var usuario = escape(document.myForm.usuario.value + ";");
            console.log(usuario);
            document.cookie = "name = " + usuario;

            var allcookies = unescape(document.cookie);
            console.log(allcookies);

            var cookie = document.getElementById('hidden').value;
            cookie.innerHTML = allcookies;
        };
    </script>
    <style>
        .hidden{
            display: none;
            visibility: hidden;
        }
    </style>
</head>
<body>
<?php include_once('session.php') ?>
  <div class="container">
    <br>
    <div class="card mb-3">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img class="d-block w-100" src="..." alt="First slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="..." alt="Second slide">
                </div>
                <div class="carousel-item">
                <img class="d-block w-100" src="..." alt="Third slide">
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
        </div>
    </div>

        <!-- Button trigger modal -->
    <button type="button" class="btn btn-info btn-lg btn-block" data-toggle="modal" data-target="#exampleModal">
    Iniciar
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <!-- Comienza form -->
            <form action="" name="myForm" method="POST">
            <h5 class="modal-title" id="exampleModalLabel">Inicia tu sesión</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo quos officia eligendi veniam. Dolorem aspernatur quas laboriosam modi possimus corrupti!</p>
            <input type="text" name="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Introcude tu nombre de usuario">
            <input type="text" name="cookie" class="hidden" id="hidden" aria-describedby="emailHelp" placeholder="Introcude tu nombre de usuario">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
            <input type="submit" name="crear" onclick="clicked()" value="Crear" class="btn btn-info"></input>
        </div>
        </div>
        </form>
    </div>
    </div>
  </div>
</body>

</html>