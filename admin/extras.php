<?php
require '../z_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
    
<head><meta charset="gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión de extras</title>
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
        <h3 class="title">Gestión de extras</h3>
        <br>
     <div class="col text-center">
            <a class="btn btn-info btn-lg" href="panel.php">Atras</a>
        <?php if($change == true){?>
            <a class="btn btn-warning btn-lg" href="#">Concluir</a>
        <p><?php echo $sql;?></p>
        <?php }else{?>
            <a href="crearextra.php" class="btn btn-default btn btn-info btn-lg">Introducir extra</a>
        <?php }?> 
    </div>
    <br>
    <form class="container">
        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control" id="search" placeholder="Buscar...">
        </div>
    </form>
    <br>
  
    <section class="container">
    <?php 
        

        echo "
        <div class='table-responsive'>
        <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th scope='col'>Condimento</th>
                            <th scope='col'>Valor</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>";

                    $sql = "SELECT * FROM extras ORDER BY condimento ASC";
                    $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());
                    echo "
                    <tbody>";
                    if($result-> num_rows > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                         echo "  
                         <tr>
                            <td class='producto'>".$row["condimento"]."</td>
                            <td>".$row["valor"]."</td>
                            <td><a href='#'><i class='fas fa-trash-alt'></i></a></td>
                            <td><a href='crearextra.php?edit=".$row["id_condimento"]."'><i class='fas fa-edit'></i></a></td>
                        </tr>";

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

                if(isset($_GET['delete'])){
                    $id = $_GET['delete'];
                    $conn->query("DELETE FROM platillos WHERE id_platillo = '$id'");
                }
    
                //$connect-> close();
    
    ?>
   
    </section>
    <script type='text/javascript'>
            let search_input = document.getElementById('search')
            
            search_input.addEventListener('keyup',function(e){
                let search_item = e.target.value.toLowerCase();
                let td_item = document.querySelectorAll("table tbody .producto");
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