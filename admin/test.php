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
        #hidden{
            display: none;
        }
    </style>
</head>
<body>
<?php include_once('admin_navbar.php') ?>

    <section class="container">
        <br>
        <h2 class="h2 title">Comandas Generadas</h2>
        <br>
        <div class="col text-center">
            <a class="btn btn-info btn-lg" href="panel.php">Atras</a>
        </div>
        <br>
        
<!--Comienza Mesa 1-->
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
                    require_once('../z_connect.php');
                //------------------------------------------------------------------------------------------------------------    
                    if(isset($_POST['aceptar'])){
                        
                    $mysql = "UPDATE comandas_generadas SET status = 'Cuenta' WHERE mesa ='1' AND DATE(registro) = CURDATE()";
                    $res = mysqli_query($conn, $mysql) or die ("error en query $mysql".mysqli_error());
                    
                    if($res){
                        echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";

                        header('Location:comanda.php?orden="Exitosa"');
                    }else{
                        $error = "<div class='alert alert-danger' role='alert'>
                                Lo sentimos hubo un error, verifique que su session siga activa. 
                                </div>";
                    };
                //------------------------------------------------------------------------------------------------------------
                    $copy = "INSERT INTO comandas_finales SELECT * FROM comandas_generadas WHERE status = 'Cuenta' AND mesa ='1'";
                    $paste = mysqli_query($conn, $copy) or die ("error en query $mysql".mysqli_error());

                    if($paste){
                        echo "Success";

                    }else{
                        echo "Error";
                    };
                    
                    mysqli_free_result($mysql);
                    mysqli_close($conn);

                    }
                //------------------------------------------------------------------------------------------------------------
                    echo "
                    <div class='table-responsive'>
                    <table class='table table-hover'>
                                <thead>
                                    <tr>
                                        <th scope='col'>Usuario</th>
                                        <th scope='col'>Plato</th>
                                        <th scope='col'>Specs</th>
                                        <th scope='col'>Precio</th>
                                        <th scope='col'>Cantidad</th>
                                        <th scope='col'>Tamaño</th>
                                        <th scope='col'>Orden Tomada</th>
                                        <th scope='col'>Eliminar</th>
                                    </tr>
                                </thead>";

                                $sql = "SELECT *,(costo*cantidad) AS total FROM comandas_generadas WHERE status = 'Cocina' AND mesa = '1' AND DATE(registro) = CURDATE() ORDER BY platillo ASC";
                                $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());

                                if($result-> num_rows > 0) {
                                
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo "
                                    <tbody>
                                        <td>".$row["usuario"]."</td>
                                        <td class='producto'>".$row["platillo"]."</td>
                                        <td>".$row["specs"]."</td>
                                        <td>$".$row["costo"]." MXN</td>
                                        <td>".$row["cantidad"]."</td>
                                        <td>".$row["size"]."</td>
                                        <td>".$row["registro"]."</td>
                                        <td id='hidden'>".$row["status"]."</td>
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
                    //------------------------------------------------------------------------------------------------------------
                            foreach($result as $value){
                                $total += $value["total"];
                            };

                            if(isset($_GET['delete'])){
                                $id = $_GET['delete'];
                                $conn->query("DELETE FROM platillos WHERE id_platillo = '$id'");
                            }
                
                ?>
                                    <span id="total" class="btn btn-light h4">Total: $<?php echo $total ?></span>
                                    <br>
                                    <div class="cantidad">
                                    
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar" class="btn btn-outline-info">Aceptar</button>
                                        <button class="btn btn-outline-danger position">Eliminar</button>
                                    </form>
                                    </div>
                                </div>
                                <?php
                                mysqli_close($conn);
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <br>



</section>








</body>


   

</html>