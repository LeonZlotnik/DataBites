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
            <h5 class="card-title">Mesa 1</h5>

            <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Ordenes 
                    </button>
                </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                
                <?php 
                    $conn = mysqli_connect("localhost","root","root","H_tostada");
                    $conn->set_charset("utf8");
                    if($conn -> connect_erro){
                        die("La Conexion Fallo: ".$conn-> connect_error);
                    }

                    echo "
                    <div class='table-responsive'>
                    <table class='table table-hover'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Plato</th>
                                        <th scope='col'>Specs</th>
                                        <th scope='col'>Precio</th>
                                        <th scope='col'>Cantidad</th>
                                        <th scope='col'>Tamaño</th>
                                        <th scope='col'>Eliminar</th>
                                    </tr>
                                </thead>";

                                $sql = "SELECT *,(costo*cantidad) AS total FROM comandas_iniciales ORDER BY platillo ASC";
                                $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());

                                if($result-> num_rows > 0) {
                                
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "
                                        <tbody>
                                        <td class='producto'>".$row["platillo"]."</td>
                                        <td>".$row["specs"]."</td>
                                        <td>$".$row["costo"]." MXN</td>
                                        <td>".$row["cantidad"]."</td>
                                        <td>".$row["size"]."</td>
                                        <td><a href='productsdb.php?delete=".$row["id_platillo"]."'><i class='fas fa-trash-alt'></i></a></td>";
                            }
                                echo "
                                    </tbody>
                                </table>
                            </div>";
                            }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }

                            foreach($result as $value){
                                $total += $value["total"];
                            };

                            if(isset($_GET['delete'])){
                                $id = $_GET['delete'];
                                $conn->query("DELETE FROM platillos WHERE id_platillo = '$id'");
                            }
                
                            //$connect-> close();
                
                ?>

                                    <span id="total" class="btn btn-light h4">Total: $<?php echo $total ?></span>
                                    <br>
                                    <div class="cantidad">
                                    
                                    <a href="#" class="btn btn-outline-info">Aceptar</a>
                                    <a href="#" class="btn btn-outline-danger position">Eliminar</a>
                                    </div>
                                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="card-deck">
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Mesa 2</h5>

            <div id="accordion">
            <div class="card">
                <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                    Ordenes 
                    </button>
                </h5>
                </div>

                <div id="collapseTwo" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                
                <?php 
                    $conn = mysqli_connect("localhost","root","root","H_tostada");
                    $conn->set_charset("utf8");
                    if($conn -> connect_erro){
                        die("La Conexion Fallo: ".$conn-> connect_error);
                    }

                    echo "
                    <div class='table-responsive'>
                    <table class='table table-hover'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Plato</th>
                                        <th scope='col'>Specs</th>
                                        <th scope='col'>Precio</th>
                                        <th scope='col'>Cantidad</th>
                                        <th scope='col'>Tamaño</th>
                                        <th scope='col'>Eliminar</th>
                                    </tr>
                                </thead>";

                                $sql = "SELECT *,(costo*cantidad) AS total FROM comandas_iniciales ORDER BY platillo ASC";
                                $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());

                                if($result-> num_rows > 0) {
                                
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "
                                        <tbody>
                                        <td class='producto'>".$row["platillo"]."</td>
                                        <td>".$row["specs"]."</td>
                                        <td>$".$row["costo"]." MXN</td>
                                        <td>".$row["cantidad"]."</td>
                                        <td>".$row["size"]."</td>
                                        <td><a href='productsdb.php?delete=".$row["id_platillo"]."'><i class='fas fa-trash-alt'></i></a></td>";
                            }
                                echo "
                                    </tbody>
                                </table>
                            </div>";
                            }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }

                            foreach($result as $value){
                                $total += $value["total"];
                            };

                            if(isset($_GET['delete'])){
                                $id = $_GET['delete'];
                                $conn->query("DELETE FROM platillos WHERE id_platillo = '$id'");
                            }
                
                            //$connect-> close();
                
                ?>

                                    <span id="total" class="btn btn-light h4">Total: $<?php echo $total ?></span>
                                    <br>
                                    <div class="cantidad">
                                    
                                    <a href="#" class="btn btn-outline-info">Aceptar</a>
                                    <a href="#" class="btn btn-outline-danger position">Eliminar</a>
                                    </div>
                                </div>
                </div>
</div>

</body>
</html>