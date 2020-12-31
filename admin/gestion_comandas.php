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
    </style>
</head>
<body>
<?php include_once('admin_navbar.php') ?>

    <div class="container">
        <br>
        <h2 class="h2 title">Comandas Generadas</h2>
        <br>
        <div class="col text-center">
            <a class="btn btn-info btn-lg" href="panel.php">Atras</a>
        </div>
        <br>
            <div class="card-deck">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>

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
            <table class="table table-hover 'table-responsive'">
        <thead>
            <tr>
            <th scope="col">Plato</th>
            <th scope="col">Porción</th>
            <th scope="col">Specs</th>
            <th scope="col">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>Marki</td>
            <td>Chico</td>
            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id quod est consequatur.</td>
            <td>X</td>
            </tr>
            <tr>
            <td>Marki</td>
            <td>Chico</td>
            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id quod est consequatur.</td>
            <td>X</td>
            </tr>
            <tr>
            <td>Marki</td>
            <td>Chico</td>
            <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id quod est consequatur.</td>
            <td>X</td>
            </tr>
        </tbody>
        </table>
      </div>
    </div>
  </div>

                        <div class="cantidad">
                            
                            <a href="#" class="btn btn-outline-info">Aceptar</a>
                            <a href="#" class="btn btn-outline-danger position">Eliminar</a>
                        </div>
                    </div>
    </div>
</body>
</html>