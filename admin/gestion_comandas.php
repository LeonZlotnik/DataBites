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
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE id_comanda = $id AND status = 'Cocina'");
                        header('Location:gestion_comandas.php');
                    }

                    if(isset($_GET['drop'])){
                        $id = $_GET['drop'];
                        $conn->query("UPDATE comandas SET status = 'Cocina_Cancelada' WHERE mesa = $id AND status = 'Cocina' AND DATE(registro) = CURDATE()");
                        header('Location:gestion_comandas.php');
                    }
                
 //------------------PHP segunda parte: Aceptar Comanda ------------------------------------------------------------------------------------------
                  
                    if(isset($_POST['aceptar_1'])){
                    
                        require_once('../z_connect.php');    
    
                        $mysql_1 = "UPDATE comandas SET status = 'Cuenta' WHERE mesa ='1' AND DATE(registro) = CURDATE() AND status = 'Cocina'";
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

                    $sql_1 = "SELECT DISTINCT *,(costo*cantidad) AS total FROM comandas WHERE status = 'Cocina' AND mesa = '1' AND DATE(registro) = CURDATE() ORDER BY registro DESC";
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
                        mysqli_close($conn);
                     ?>           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Termina Mesa 1-->
  



</section>








</body>


   

</html>