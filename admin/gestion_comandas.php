<?php
session_start();
$USR = $_SESSION['admin'];

if($USR == null){
    header("location:../admin.php");
}
?>
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

//------------------PHP primera parte: Borrados ------------------------------------------------------------------------------------------

                    if(isset($_GET['delete'])){
                        $id = $_GET['delete'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE id_comanda = $id AND status = 'Cocina' AND mesa = 1");
                        header('Location:gestion_comandas.php');
                    }

                    if(isset($_GET['drop'])){
                        $id = $_GET['drop'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE mesa = $id AND status = 'Cocina' AND mesa = 1 AND DATE(registro) = CURDATE()");
                        header('Location:gestion_comandas.php');
                    }
                
 //------------------PHP segunda parte: Aceptar Comanda ------------------------------------------------------------------------------------------
                  
                    if(isset($_POST['aceptar_1'])){
                    
                        require_once('../z_connect.php');    
    
                        $mysql_1 = "UPDATE comandas SET status = 'Cuenta' WHERE mesa =1 AND DATE(registro) = CURDATE() AND status = 'Cocina'";
                        $res_1 = mysqli_query($conn, $mysql_1) or die ("error en query $mysql_1".mysqli_error());
                        
                        if($res_1){
                            //echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";
    
                            header('Location:gestion_comandas.php?orden="Exitosa"');
                        }else{
                            echo "Error";
                        };

                        mysqli_free_result($mysql_1);

                    }
//------------------PHP tercer parte: Render ------------------------------------------------------------------------------------------

                    $sql_1 = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas WHERE status = 'Cocina' AND mesa = 1 AND DATE(registro) = CURDATE() ORDER BY registro DESC";
                    $result_1 = $conn-> query($sql_1) or die ("error en query $sql_1".mysqli_error());

                    if($result_1-> num_rows > 0) {
                        while($row_1 = mysqli_fetch_assoc($result_1)){
                
                    ?>
                                    <tbody>
                                            <td><?php echo $row_1['usuario'] ?></td>
                                            <td class='producto'><?php echo $row_1['platillo'] ?></td>
                                            <td><?php echo $row_1['specs'] ?></td>
                                            <td>$<?php echo $row_1['costo'] ?>MXN</td>
                                            <td><?php echo $row_1['cantidad'] ?></td>
                                            <td><?php echo $row_1['size'] ?></td>
                                            <td><?php echo $row_1['registro'] ?></td>
                                            <td id='hidden'><?php echo $row_1['status'] ?></td>
                                            <td><a href='gestion_comandas.php?delete="<?php echo $row_1['id_comanda'] ?>"'><i class='fas fa-trash-alt'></i></a></td>
                            
                                    </tbody>
                      
                <?php
                            }
                        }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }
                            foreach($result_1 as $value){
                                $total_1 += $value["total"];
                            };

                            
                ?>
                  </table>
                    </div>
                        <span id="total" class="btn btn-light h4">Total: $<?php echo $total_1 ?></span>
                            <br>
                    <!--Termina area de editado Mesa 1-->
                                <div class="cantidad">
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar_1" class="btn btn-outline-info">Aceptar</button>
                                        <a href="gestion_comandas.php?drop='1'" class="btn btn-outline-danger position">Eliminar</a>
                                    </form>
                                </div>

                     <?php   
                       // mysqli_close($conn);
                     ?>           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Termina Mesa 1-->

<!--Comienza Mesa 2-->

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Mesa 2</h5>
            <div id="accordionTwo">
                <div class="card">
                    <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Ordenes #2
                        </button>
                    </h5>
                    </div>

                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionTwo">
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

//------------------PHP primera parte: Borrados ------------------------------------------------------------------------------------------

                    if(isset($_GET['delete'])){
                        $id = $_GET['delete'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE id_comanda = $id AND status = 'Cocina' AND mesa = 2");
                        header('Location:gestion_comandas.php');
                    }

                    if(isset($_GET['drop'])){
                        $id = $_GET['drop'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE mesa = $id AND status = 'Cocina' AND mesa = 2 AND DATE(registro) = CURDATE()");
                        header('Location:gestion_comandas.php');
                    }
                
 //------------------PHP segunda parte: Aceptar Comanda ------------------------------------------------------------------------------------------
                  
                    if(isset($_POST['aceptar_2'])){
                    
                        require_once('../z_connect.php');    
    
                        $mysql_2 = "UPDATE comandas SET status = 'Cuenta' WHERE mesa = 2 AND DATE(registro) = CURDATE() AND status = 'Cocina'";
                        $res_2 = mysqli_query($conn, $mysql_2) or die ("error en query $mysql_2".mysqli_error());
                        
                        if($res_2){
                            //echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";
    
                            header('Location:gestion_comandas.php?orden="Exitosa"');
                        }else{
                            echo "Error";
                        };

                        mysqli_free_result($mysql_2);

                    }
//------------------PHP tercer parte: Render ------------------------------------------------------------------------------------------

                    $sql_2 = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas WHERE status = 'Cocina' AND mesa = 2 AND DATE(registro) = CURDATE() ORDER BY registro DESC";
                    $result_2 = $conn-> query($sql_2) or die ("error en query $sql_2".mysqli_error());

                    if($result_2-> num_rows > 0) {
                        while($row_2 = mysqli_fetch_assoc($result_2)){

                    ?>
                                    <tbody>
                                            <td><?php echo $row_2['usuario'] ?></td>
                                            <td class='producto'><?php echo $row_2['platillo'] ?></td>
                                            <td><?php echo $row_2['specs'] ?></td>
                                            <td>$<?php echo $row_2['costo'] ?>MXN</td>
                                            <td><?php echo $row_2['cantidad'] ?></td>
                                            <td><?php echo $row_2['size'] ?></td>
                                            <td><?php echo $row_2['registro'] ?></td>
                                            <td id='hidden'><?php echo $row_2['status'] ?></td>
                                            <td><a href='gestion_comandas.php?delete="<?php echo $row_2['id_comanda'] ?>"'><i class='fas fa-trash-alt'></i></a></td>
                            
                                    </tbody>
                    
                    <?php
                            }
                        }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }
                            foreach($result_2 as $value){
                                $total_2 += $value["total"];
                            };

                            
                    ?>
                    </table>
                    </div>
                        <span id="total" class="btn btn-light h4">Total: $<?php echo $total_2 ?></span>
                            <br>
                    <!--Termina area de editado Mesa 2-->
                                <div class="cantidad">
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar_2" class="btn btn-outline-info">Aceptar</button>
                                        <a href="gestion_comandas.php?drop='2'" class="btn btn-outline-danger position">Eliminar</a>
                                    </form>
                                </div>

                     <?php   
                        //mysqli_close($conn);
                     ?>           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Termina Mesa 2-->

<!--Comienza Mesa 3-->

<div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Mesa 3</h5>
            <div id="accordionThree">
                <div class="card">
                    <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Ordenes #3
                        </button>
                    </h5>
                    </div>

                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionThree">
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

//------------------PHP primera parte: Borrados ------------------------------------------------------------------------------------------

                    if(isset($_GET['delete'])){
                        $id = $_GET['delete'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE id_comanda = $id AND status = 'Cocina' AND mesa = 3");
                        header('Location:gestion_comandas.php');
                    }

                    if(isset($_GET['drop'])){
                        $id = $_GET['drop'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE mesa = $id AND status = 'Cocina' AND mesa = 3 AND DATE(registro) = CURDATE()");
                        header('Location:gestion_comandas.php');
                    }
                
 //------------------PHP segunda parte: Aceptar Comanda ------------------------------------------------------------------------------------------
                  
                    if(isset($_POST['aceptar_3'])){
                    
                        require_once('../z_connect.php');    
    
                        $mysql_3 = "UPDATE comandas SET status = 'Cuenta' WHERE mesa = 3 AND DATE(registro) = CURDATE() AND status = 'Cocina'";
                        $res_3 = mysqli_query($conn, $mysql_3) or die ("error en query $mysql_3".mysqli_error());
                        
                        if($res_3){
                            //echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";
    
                            header('Location:gestion_comandas.php?orden="Exitosa"');
                        }else{
                            echo "Error";
                        };

                        mysqli_free_result($mysql_3);

                    }
//------------------PHP tercer parte: Render ------------------------------------------------------------------------------------------

                    $sql_3 = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas WHERE status = 'Cocina' AND mesa = 3 AND DATE(registro) = CURDATE() ORDER BY registro DESC";
                    $result_3= $conn-> query($sql_3) or die ("error en query $sql_3".mysqli_error());

                    if($result_3-> num_rows > 0) {
                        while($row_3 = mysqli_fetch_assoc($result_3)){
                
                    ?>
                                    <tbody>
                                            <td><?php echo $row_3['usuario'] ?></td>
                                            <td class='producto'><?php echo $row_3['platillo'] ?></td>
                                            <td><?php echo $row_3['specs'] ?></td>
                                            <td>$<?php echo $row_3['costo'] ?>MXN</td>
                                            <td><?php echo $row_3['cantidad'] ?></td>
                                            <td><?php echo $row_3['size'] ?></td>
                                            <td><?php echo $row_3['registro'] ?></td>
                                            <td id='hidden'><?php echo $row_3['status'] ?></td>
                                            <td><a href='gestion_comandas.php?delete="<?php echo $row_3['id_comanda'] ?>"'><i class='fas fa-trash-alt'></i></a></td>
                            
                                    </tbody>
                      
                <?php
                            }
                        }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }
                            foreach($result_3 as $value){
                                $total_3 += $value["total"];
                            };

                            
                ?>
                  </table>
                    </div>
                        <span id="total" class="btn btn-light h4">Total: $<?php echo $total_3 ?></span>
                            <br>
                    <!--Termina area de editado Mesa 3-->
                                <div class="cantidad">
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar_3" class="btn btn-outline-info">Aceptar</button>
                                        <a href="gestion_comandas.php?drop='3'" class="btn btn-outline-danger position">Eliminar</a>
                                    </form>
                                </div>

                     <?php   
                       // mysqli_close($conn);
                     ?>           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Termina Mesa 3-->

<!--Comienza Mesa 4-->

<div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Mesa 4</h5>
            <div id="accordionFour">
                <div class="card">
                    <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Ordenes #4
                        </button>
                    </h5>
                    </div>

                    <div id="collapseFour" class="collapse show" aria-labelledby="headingTFour" data-parent="#accordionFour">
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

//------------------PHP primera parte: Borrados ------------------------------------------------------------------------------------------

                    if(isset($_GET['delete'])){
                        $id = $_GET['delete'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE id_comanda = $id AND status = 'Cocina' AND mesa = 4");
                        header('Location:gestion_comandas.php');
                    }

                    if(isset($_GET['drop'])){
                        $id = $_GET['drop'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE mesa = $id AND status = 'Cocina' AND mesa = 4 AND DATE(registro) = CURDATE()");
                        header('Location:gestion_comandas.php');
                    }
                
 //------------------PHP segunda parte: Aceptar Comanda ------------------------------------------------------------------------------------------
                  
                    if(isset($_POST['aceptar_4'])){
                    
                        require_once('../z_connect.php');    
    
                        $mysql_4 = "UPDATE comandas SET status = 'Cuenta' WHERE mesa = 4 AND DATE(registro) = CURDATE() AND status = 'Cocina'";
                        $res_4 = mysqli_query($conn, $mysql_4) or die ("error en query $mysql_4".mysqli_error());
                        
                        if($res_4){
                            //echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";
    
                            header('Location:gestion_comandas.php?orden="Exitosa"');
                        }else{
                            echo "Error";
                        };

                        mysqli_free_result($mysql_4);

                    }
//------------------PHP tercer parte: Render ------------------------------------------------------------------------------------------

                    $sql_4 = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas WHERE status = 'Cocina' AND mesa = 4 AND DATE(registro) = CURDATE() ORDER BY registro DESC";
                    $result_4= $conn-> query($sql_4) or die ("error en query $sql_4".mysqli_error());

                    if($result_4-> num_rows > 0) {
                        while($row_4 = mysqli_fetch_assoc($result_4)){
                
                    ?>
                                    <tbody>
                                            <td><?php echo $row_4['usuario'] ?></td>
                                            <td class='producto'><?php echo $row_4['platillo'] ?></td>
                                            <td><?php echo $row_4['specs'] ?></td>
                                            <td>$<?php echo $row_4['costo'] ?>MXN</td>
                                            <td><?php echo $row_4['cantidad'] ?></td>
                                            <td><?php echo $row_4['size'] ?></td>
                                            <td><?php echo $row_4['registro'] ?></td>
                                            <td id='hidden'><?php echo $row_4['status'] ?></td>
                                            <td><a href='gestion_comandas.php?delete="<?php echo $row_4['id_comanda'] ?>"'><i class='fas fa-trash-alt'></i></a></td>
                            
                                    </tbody>
                      
                <?php
                            }
                        }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }
                            foreach($result_4 as $value){
                                $total_4 += $value["total"];
                            };

                            
                ?>
                  </table>
                    </div>
                        <span id="total" class="btn btn-light h4">Total: $<?php echo $total_4 ?></span>
                            <br>
                    <!--Termina area de editado Mesa 4-->
                                <div class="cantidad">
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar_4" class="btn btn-outline-info">Aceptar</button>
                                        <a href="gestion_comandas.php?drop='4'" class="btn btn-outline-danger position">Eliminar</a>
                                    </form>
                                </div>

                     <?php   
                       // mysqli_close($conn);
                     ?>           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Termina Mesa 4-->

<!--Comienza Mesa 5-->

<div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Mesa 5</h5>
            <div id="accordionFive">
                <div class="card">
                    <div class="card-header" id="headingFive">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Ordenes #5
                        </button>
                    </h5>
                    </div>

                    <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordionFive">
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

//------------------PHP primera parte: Borrados ------------------------------------------------------------------------------------------

                    if(isset($_GET['delete'])){
                        $id = $_GET['delete'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE id_comanda = $id AND status = 'Cocina' AND mesa = 5");
                        header('Location:gestion_comandas.php');
                    }

                    if(isset($_GET['drop'])){
                        $id = $_GET['drop'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE mesa = $id AND status = 'Cocina' AND mesa = 5 AND DATE(registro) = CURDATE()");
                        header('Location:gestion_comandas.php');
                    }
                
 //------------------PHP segunda parte: Aceptar Comanda ------------------------------------------------------------------------------------------
                  
                    if(isset($_POST['aceptar_5'])){
                    
                        require_once('../z_connect.php');    
    
                        $mysql_5 = "UPDATE comandas SET status = 'Cuenta' WHERE mesa = 5 AND DATE(registro) = CURDATE() AND status = 'Cocina'";
                        $res_5 = mysqli_query($conn, $mysql_5) or die ("error en query $mysql_5".mysqli_error());
                        
                        if($res_5){
                            //echo "<script> alert('Esta orden se debera de servir en aproximadamente 10 min') </script>";
    
                            header('Location:gestion_comandas.php?orden="Exitosa"');
                        }else{
                            echo "Error";
                        };

                        mysqli_free_result($mysql_5);

                    }
//------------------PHP tercer parte: Render ------------------------------------------------------------------------------------------

                    $sql_5 = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas WHERE status = 'Cocina' AND mesa = 4 AND DATE(registro) = CURDATE() ORDER BY registro DESC";
                    $result_5= $conn-> query($sql_5) or die ("error en query $sql_5".mysqli_error());

                    if($result_5-> num_rows > 0) {
                        while($row_5 = mysqli_fetch_assoc($result_5)){
                
                    ?>
                                    <tbody>
                                            <td><?php echo $row_5['usuario'] ?></td>
                                            <td class='producto'><?php echo $row_5['platillo'] ?></td>
                                            <td><?php echo $row_5['specs'] ?></td>
                                            <td>$<?php echo $row_5['costo'] ?>MXN</td>
                                            <td><?php echo $row_5['cantidad'] ?></td>
                                            <td><?php echo $row_5['size'] ?></td>
                                            <td><?php echo $row_5['registro'] ?></td>
                                            <td id='hidden'><?php echo $row_5['status'] ?></td>
                                            <td><a href='gestion_comandas.php?delete="<?php echo $row_5['id_comanda'] ?>"'><i class='fas fa-trash-alt'></i></a></td>
                            
                                    </tbody>
                      
                <?php
                            }
                        }
                            else {
                                echo "<div class='alert alert-warning' role='alert'>
                                No hay informacion por el momento.
                                    </div>";
                            }
                            foreach($result_5 as $value){
                                $total_5 += $value["total"];
                            };

                            
                ?>
                  </table>
                    </div>
                        <span id="total" class="btn btn-light h4">Total: $<?php echo $total_5 ?></span>
                            <br>
                    <!--Termina area de editado Mesa 5-->
                                <div class="cantidad">
                                    <form action="" method="POST">
                                        <button type="submit" name="aceptar_5" class="btn btn-outline-info">Aceptar</button>
                                        <a href="gestion_comandas.php?drop='5'" class="btn btn-outline-danger position">Eliminar</a>
                                    </form>
                                </div>

                     <?php   
                       // mysqli_close($conn);
                     ?>           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Termina Mesa 5-->

</section>

</body>


   

</html>