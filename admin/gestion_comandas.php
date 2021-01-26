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
        <h3 class="title">Comandas Generadas</h3>
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
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Ordenes #1
                        </button>
                    </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">
                    <!--Comienza area de editado Mesa 1-->
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
                                    </thead>

                    <?php

                    require_once('../z_connect.php');
                //------------------PHP primera parte: Rendering ------------------------------------------------------------------------------------------
                    $sql = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas_generadas WHERE status = 'Cocina' AND mesa = '1' AND DATE(registro) = CURDATE() ORDER BY registro DESC";
                    $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());

                    if(isset($_GET['delete'])){
                        $id = $_GET['delete'];
                        $conn->query("DELETE FROM comandas_generadas WHERE platillo = '$id'");
                    }
                    if($result-> num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                
                    ?>
                                    <tbody>
                                            <td><?php echo $row['usuario'] ?></td>
                                            <td class='producto'><?php echo $row['platillo'] ?></td>
                                            <td><?php echo $row['specs'] ?></td>
                                            <td>$<?php echo $row['costo'] ?>MXN</td>
                                            <td><?php echo $row['cantidad'] ?></td>
                                            <td><?php echo $row['size'] ?></td>
                                            <td><?php echo $row['registro'] ?></td>
                                            <td id='hidden'><?php echo $row['status'] ?></td>
                                            <td><a href='gestion_comandas.php?delete="<?php echo $row['platillo'] ?>"' ><i class='fas fa-trash-alt'></i></a></td>
                            
                                    </tbody>
                      
                <?php
                            }
                        }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }
                            foreach($result as $value){
                                $total1 += $value["total"];
                            };

                            
                ?>
                  </table>
                    </div>
                        <span id="total" class="btn btn-light h4">Total: $<?php echo $total1 ?></span>
                            <br>

                            <?php 

                //----------------------PHP segunda parte: Update Status--------------------------------------------------------------------------------------    
                    if(isset($_POST['aceptar'])){
                    
                    require_once('../z_connect.php');    

                    $mysql = "UPDATE comandas_generadas SET status = 'Cuenta' WHERE mesa ='1' AND DATE(registro) = CURDATE()";
                    $res = mysqli_query($conn, $mysql) or die ("error en query $mysql".mysqli_error());
                    
                    if($res){
                        //echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";

                        header('Location:gestion_comandas.php?orden="Exitosa"');
                    }else{
                        echo "Error";
                    };
                //----------------------PHP tercer parte: Copy & Paste DB--------------------------------------------------------------------------------------
                    $copy = "INSERT INTO comandas_finales SELECT * FROM comandas_generadas WHERE status = 'Cuenta' AND mesa ='1'";
                    $paste = mysqli_query($conn, $copy) or die ("error en query $mysql".mysqli_error());

                    if($paste){
                        header('Location:gestion_comandas.php?orden="Exitosa"');

                    }else{
                        echo "Error";
                    };
                    
                    mysqli_free_result($mysql);
                    mysqli_close($conn);

                    }
                    ?>
                    <!--Termina area de editado Mesa 1-->
                                <div class="cantidad">
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar" class="btn btn-outline-info">Aceptar</button>
                                        <button class="btn btn-outline-danger position">Eliminar</button>
                                    </form>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <br> 
    <!--Comienza Mesa 2-->                
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Mesa 2</h5>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Ordenes #2
                        </button>
                    </h5>
                    </div>

                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                    <!--Comienza area de editado Mesa 2-->
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
                                    </thead>

                    <?php

                    require_once('../z_connect.php');
                //------------------------------------------------------------------------------------------------------------
                    $sql = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas_generadas WHERE status = 'Cocina' AND mesa = '2' AND DATE(registro) = CURDATE() ORDER BY registro DESC";
                    $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());
                    if(isset($_GET['delete'])){
                        $id = $_GET['delete'];
                        $conn->query("DELETE FROM comandas_generadas WHERE platillo = '$id'");
                    }
                    if($result-> num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                
                    ?>
                                    <tbody>
                                            <td><?php echo $row['usuario'] ?></td>
                                            <td class='producto'><?php echo $row['platillo'] ?></td>
                                            <td><?php echo $row['specs'] ?></td>
                                            <td>$<?php echo $row['costo'] ?>MXN</td>
                                            <td><?php echo $row['cantidad'] ?></td>
                                            <td><?php echo $row['size'] ?></td>
                                            <td><?php echo $row['registo'] ?></td>
                                            <td id='hidden'><?php echo $row['status'] ?></td>
                                            <td><a href='gestion_comandas.php?delete="<?php echo $row['platillo'] ?>"'><i class='fas fa-trash-alt'></i></a></td>
                            
                                    </tbody>
                      
                <?php
                            }
                        }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }
                            foreach($result as $value){
                                $total1 += $value["total"];
                            };
                          
                ?>
                  </table>
                    </div>
                        <span id="total" class="btn btn-light h4">Total: $<?php echo $total1 ?></span>
                            <br>

                            <?php 

                //------------------------------------------------------------------------------------------------------------    
                    if(isset($_POST['aceptar'])){
                    
                    require_once('../z_connect.php');    

                    $mysql = "UPDATE comandas_generadas SET status = 'Cuenta' WHERE mesa ='2' AND DATE(registro) = CURDATE()";
                    $res = mysqli_query($conn, $mysql) or die ("error en query $mysql".mysqli_error());
                    
                    if($res){
                        //echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";

                        header('Location:gestion_comandas.php?orden="Exitosa"');
                    }else{
                        echo "Error";
                    };
                //------------------------------------------------------------------------------------------------------------
                    $copy = "INSERT INTO comandas_finales SELECT * FROM comandas_generadas WHERE status = 'Cuenta' AND mesa ='2'";
                    $paste = mysqli_query($conn, $copy) or die ("error en query $mysql".mysqli_error());

                    if($paste){
                        header('Location:gestion_comandas.php?orden="Exitosa"');

                    }else{
                        echo "Error";
                    };
                    
                    mysqli_free_result($mysql);
                    mysqli_close($conn);

                    }
                    ?>
                    <!--Termina area de editado Mesa 2-->
                                <div class="cantidad">
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar" class="btn btn-outline-info">Aceptar</button>
                                        <button class="btn btn-outline-danger position">Eliminar</button>
                                    </form>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!--Comienza Mesa 3-->
<div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Mesa 3</h5>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="heading3">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                        Ordenes #3
                        </button>
                    </h5>
                    </div>

                    <div id="collapse3" class="collapse show" aria-labelledby="heading3" data-parent="#accordion">
                    <div class="card-body">
                    <!--Comienza area de editado Mesa 3-->
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
                                    </thead>

                    <?php

                    require_once('../z_connect.php');
                //------------------PHP primera parte: Rendering ------------------------------------------------------------------------------------------
                    $sql = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas_generadas WHERE status = 'Cocina' AND mesa = '1' AND DATE(registro) = CURDATE() ORDER BY registro DESC";
                    $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());
                    if(isset($_GET['delete'])){
                        $id = $_GET['delete'];
                        $conn->query("DELETE FROM platillos WHERE id_platillo = '$id'");
                    }
                    if($result-> num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                
                    ?>
                                    <tbody>
                                            <td><?php echo $row['usuario'] ?></td>
                                            <td class='producto'><?php echo $row['platillos'] ?></td>
                                            <td><?php echo $row['specs'] ?></td>
                                            <td>$<?php echo $row['costo'] ?>MXN</td>
                                            <td><?php echo $row['cantidad'] ?></td>
                                            <td><?php echo $row['size'] ?></td>
                                            <td><?php echo $row['registo'] ?></td>
                                            <td id='hidden'><?php echo $row['status'] ?></td>
                                            <td><a href='productsdb.php?delete="<?php echo $row['id_platillo'] ?>"' ><i class='fas fa-trash-alt'></i></a></td>
                            
                                    </tbody>
                      
                <?php
                            }
                        }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }
                            foreach($result as $value){
                                $total1 += $value["total"];
                            };

                ?>
                  </table>
                    </div>
                        <span id="total" class="btn btn-light h4">Total: $<?php echo $total1 ?></span>
                            <br>

                            <?php 

                //----------------------PHP segunda parte: Update Status--------------------------------------------------------------------------------------    
                    if(isset($_POST['aceptar'])){
                    
                    require_once('../z_connect.php');    

                    $mysql = "UPDATE comandas_generadas SET status = 'Cuenta' WHERE mesa ='1' AND DATE(registro) = CURDATE()";
                    $res = mysqli_query($conn, $mysql) or die ("error en query $mysql".mysqli_error());
                    
                    if($res){
                        //echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";

                        header('Location:gestion_comandas.php?orden="Exitosa"');
                    }else{
                        echo "Error";
                    };
                //----------------------PHP tercer parte: Copy & Paste DB--------------------------------------------------------------------------------------
                    $copy = "INSERT INTO comandas_finales SELECT * FROM comandas_generadas WHERE status = 'Cuenta' AND mesa ='1'";
                    $paste = mysqli_query($conn, $copy) or die ("error en query $mysql".mysqli_error());

                    if($paste){
                        header('Location:gestion_comandas.php?orden="Exitosa"');

                    }else{
                        echo "Error";
                    };
                    
                    mysqli_free_result($mysql);
                    mysqli_close($conn);

                    }
                    ?>
                    <!--Termina area de editado Mesa 3-->
                                <div class="cantidad">
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar" class="btn btn-outline-info">Aceptar</button>
                                        <button class="btn btn-outline-danger position">Eliminar</button>
                                    </form>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!--Comienza Mesa 4-->
<div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Mesa 4</h5>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="heading4">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                        Ordenes #4
                        </button>
                    </h5>
                    </div>

                    <div id="collapse4" class="collapse show" aria-labelledby="heading4" data-parent="#accordion">
                    <div class="card-body">
                    <!--Comienza area de editado Mesa 4-->
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
                                    </thead>

                    <?php

                    require_once('../z_connect.php');
                //------------------PHP primera parte: Rendering ------------------------------------------------------------------------------------------
                    $sql = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas_generadas WHERE status = 'Cocina' AND mesa = '1' AND DATE(registro) = CURDATE() ORDER BY registro DESC";
                    $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());
                    if(isset($_GET['delete'])){
                        $id = $_GET['delete'];
                        $conn->query("DELETE FROM platillos WHERE id_platillo = '$id'");
                    }
                    if($result-> num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                
                    ?>
                                    <tbody>
                                            <td><?php echo $row['usuario'] ?></td>
                                            <td class='producto'><?php echo $row['platillos'] ?></td>
                                            <td><?php echo $row['specs'] ?></td>
                                            <td>$<?php echo $row['costo'] ?>MXN</td>
                                            <td><?php echo $row['cantidad'] ?></td>
                                            <td><?php echo $row['size'] ?></td>
                                            <td><?php echo $row['registo'] ?></td>
                                            <td id='hidden'><?php echo $row['status'] ?></td>
                                            <td><a href='productsdb.php?delete="<?php echo $row['id_platillo'] ?>"' ><i class='fas fa-trash-alt'></i></a></td>
                            
                                    </tbody>
                      
                <?php
                            }
                        }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }
                            foreach($result as $value){
                                $total1 += $value["total"];
                            };

                ?>
                  </table>
                    </div>
                        <span id="total" class="btn btn-light h4">Total: $<?php echo $total1 ?></span>
                            <br>

                            <?php 

                //----------------------PHP segunda parte: Update Status--------------------------------------------------------------------------------------    
                    if(isset($_POST['aceptar'])){
                    
                    require_once('../z_connect.php');    

                    $mysql = "UPDATE comandas_generadas SET status = 'Cuenta' WHERE mesa ='1' AND DATE(registro) = CURDATE()";
                    $res = mysqli_query($conn, $mysql) or die ("error en query $mysql".mysqli_error());
                    
                    if($res){
                        //echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";

                        header('Location:gestion_comandas.php?orden="Exitosa"');
                    }else{
                        echo "Error";
                    };
                //----------------------PHP tercer parte: Copy & Paste DB--------------------------------------------------------------------------------------
                    $copy = "INSERT INTO comandas_finales SELECT * FROM comandas_generadas WHERE status = 'Cuenta' AND mesa ='1'";
                    $paste = mysqli_query($conn, $copy) or die ("error en query $mysql".mysqli_error());

                    if($paste){
                        header('Location:gestion_comandas.php?orden="Exitosa"');

                    }else{
                        echo "Error";
                    };
                    
                    mysqli_free_result($mysql);
                    mysqli_close($conn);

                    }
                    ?>
                    <!--Termina area de editado Mesa 4-->
                                <div class="cantidad">
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar" class="btn btn-outline-info">Aceptar</button>
                                        <button class="btn btn-outline-danger position">Eliminar</button>
                                    </form>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<!--Comienza Mesa 5-->
<div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Mesa 5</h5>
            <div id="accordion">
                <div class="card">
                    <div class="card-header" id="heading5">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                        Ordenes #5
                        </button>
                    </h5>
                    </div>

                    <div id="collapse5" class="collapse show" aria-labelledby="heading5" data-parent="#accordion">
                    <div class="card-body">
                    <!--Comienza area de editado Mesa 5-->
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
                                    </thead>

                    <?php

                    require_once('../z_connect.php');
                //------------------PHP primera parte: Rendering ------------------------------------------------------------------------------------------
                    $sql = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas_generadas WHERE status = 'Cocina' AND mesa = '1' AND DATE(registro) = CURDATE() ORDER BY registro DESC";
                    $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());
                    if(isset($_GET['delete'])){
                        $id = $_GET['delete'];
                        $conn->query("DELETE FROM platillos WHERE id_platillo = '$id'");
                    }
                    if($result-> num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                
                    ?>
                                    <tbody>
                                            <td><?php echo $row['usuario'] ?></td>
                                            <td class='producto'><?php echo $row['platillos'] ?></td>
                                            <td><?php echo $row['specs'] ?></td>
                                            <td>$<?php echo $row['costo'] ?>MXN</td>
                                            <td><?php echo $row['cantidad'] ?></td>
                                            <td><?php echo $row['size'] ?></td>
                                            <td><?php echo $row['registo'] ?></td>
                                            <td id='hidden'><?php echo $row['status'] ?></td>
                                            <td><a href='productsdb.php?delete="<?php echo $row['id_platillo'] ?>"' ><i class='fas fa-trash-alt'></i></a></td>
                            
                                    </tbody>
                      
                <?php
                            }
                        }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }
                            foreach($result as $value){
                                $total1 += $value["total"];
                            };

                ?>
                  </table>
                    </div>
                        <span id="total" class="btn btn-light h4">Total: $<?php echo $total1 ?></span>
                            <br>

                            <?php 

                //----------------------PHP segunda parte: Update Status--------------------------------------------------------------------------------------    
                    if(isset($_POST['aceptar'])){
                    
                    require_once('../z_connect.php');    

                    $mysql = "UPDATE comandas_generadas SET status = 'Cuenta' WHERE mesa ='1' AND DATE(registro) = CURDATE()";
                    $res = mysqli_query($conn, $mysql) or die ("error en query $mysql".mysqli_error());
                    
                    if($res){
                        //echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";

                        header('Location:gestion_comandas.php?orden="Exitosa"');
                    }else{
                        echo "Error";
                    };
                //----------------------PHP tercer parte: Copy & Paste DB--------------------------------------------------------------------------------------
                    $copy = "INSERT INTO comandas_finales SELECT * FROM comandas_generadas WHERE status = 'Cuenta' AND mesa ='1'";
                    $paste = mysqli_query($conn, $copy) or die ("error en query $mysql".mysqli_error());

                    if($paste){
                        header('Location:gestion_comandas.php?orden="Exitosa"');

                    }else{
                        echo "Error";
                    };
                    
                    mysqli_free_result($mysql);
                    mysqli_close($conn);

                    }
                    ?>
                    <!--Termina area de editado Mesa 5-->
                                <div class="cantidad">
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar" class="btn btn-outline-info">Aceptar</button>
                                        <button class="btn btn-outline-danger position">Eliminar</button>
                                    </form>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</section>








</body>


   

</html>