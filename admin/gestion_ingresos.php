<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control de Clientes</title>
    <link rel="shorcut icon" type="img/png" href="img/favicon.png">
    <link rel="stylesheet" type="text/css" href="admin_controll.css">
    <style>
        .title {
            text-align: center;
            color:#D7627C; 
            text-shadow: 1.5px 1px 2px #000;
        } 
    </style>
</head>
<body>
    <?php require_once('admin_navbar.php')?>
    <br>
    <br>
        <h3 class="title">Gestión Ventas</h3>
    <br>
    <form class="container">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" id="search" placeholder="Buscar...">
        </div>
    </form>
    <br>
    <div class="col text-center">
        <a class="btn btn-info btn-lg" href="gestion_ventas.php">Atras</a>
        <a href="xport_ventas.php" class="btn btn-default btn btn-success btn-lg">Exportar</a>
    </div>
    <br>

    <section class="container">
    <?php 
         require_once('../z_connect.php');
                    
            mysqli_free_result($mysql);

        echo "
        <div class='table-responsive'>
        <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th scope='col'>Usuario</th>
                            <th scope='col'>No. Mesa</th>
                            <th scope='col'>Plato</th>
                            <th scope='col'>Costo</th>
                            <th scope='col'>Cantidad</th>
                            <th scope='col'>Subtotal</th>
                            <th scope='col'>IVA</th>
                            <th scope='col'>Fee</th>
                            <th scope='col'>Ingreso</th>
                            <th scope='col'>Especificaciones</th>
                            <th scope='col'>Tamaño</th>
                            <th scope='col'>Registro</th>
                        </tr>
                    </thead>";

                    $sql = "SELECT *, (costo*cantidad) AS subtotal, ((costo*cantidad)*0.16) AS iva, ((costo*cantidad)*0.02) AS fee, ((costo*cantidad)/1.18) AS total FROM comandas_finales";
                    $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());

                    if($result-> num_rows > 0) {
                    
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                            <tbody>
                            <th scope='row' class='user'>".$row["usuario"]."</th>
                            <td>#".$row["mesa"]."</td>
                            <td>".$row["platillo"]."</td>
                            <td>$".$row["costo"]."</td>
                            <td>".$row["cantidad"]."</td>
                            <td>$".$row["subtotal"]."</td>
                            <td>$".$row["iva"]."</td>
                            <td>$".$row["fee"]."</td>
                            <td>$".$row["total"]."</td>
                            <td>".$row["specs"]."</td>
                            <td>".$row["size"]."</td>
                            <td>".$row["registro"]."</td>";
                }
                    echo "
                        </tbody>
                    </table>
                </div>";
                }
                else {
                    echo "<div class='alert alert-warning' role='alert'>
                    No hay información por el momento.
                          </div>";
                }
    
                $connect-> close();
    
    ?>
    </section>
    </section>
    <script type='text/javascript'>
            let search_input = document.getElementById('search')
            
            search_input.addEventListener('keyup',function(e){
                let search_item = e.target.value.toLowerCase();
                let td_item = document.querySelectorAll("table tbody .user");
                console.log(td_item);
                
                td_item.forEach(function(item){
                    if(item.textContent.toLowerCase().indexOf(search_item)!=-1){
                        item.closest("table tr").style.display = "block";
                    }else{
                        item.closest("table tr").style.display = "none";
                    }
                });
            });
    </script>
</body>
</html>