<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Anuncios</title>
    <style>
        .title {
            text-align: center;
            color:#D7627C; 
            text-shadow: 1.5px 1px 2px #000;
        }
        .center {
            margin: 0 10% 0 10%;
        }
        @media only screen and (min-width: 500px){
            .center{
                margin: 0 25% 0 25%;
            }
        }
    </style>
</head>
<body>
<?php include_once('admin_navbar.php') ?>

    <div class="container">
        <br>
        <h3 class="title">Dashboard</h3>
        <br>
            <div class="btn-group center" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-info">Negocio</button>
                <button type="button" class="btn btn-info">Clientes</button>
                <button type="button" class="btn btn-info">Mercado</button>
            </div>
            <br>
            <br>
            <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
      <div class="card-body">
        
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
      <div class="card-body">
        
      </div>
    </div>
  </div>
</div>
<br>
<a href="panel.php" class="btn btn-info btn-lg btn-block">Atras</a>
    </div>
</body>
</html>