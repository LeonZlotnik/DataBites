<!DOCTYPE html>
<html lang="en">
<head><meta charset="gb18030">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Controll de Administradores</title>
    <link rel="shorcut icon" type="img/png" href="img/favicon.png">
    <link rel="stylesheet" type="text/css" href="admin_controll.css">
</head>
<body>
    <?php require_once('admin_navbar.php')?>
    <br>
    
    <div class="col text-center">
        <a class="btn btn-info btn-lg" href="panel.php">Atras</a>
      <a href="crearadmin.php" class="btn btn-default btn btn-info btn-lg">Crear Administrador</a>
    </div>
    <br>

    <section class="container">
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
                            <th scope='col'>#</th>
                            <th scope='col'>Usuario</th>
                            <th scope='col'>Contraseña</th>
                            <th scope='col'>Acceso</th>
                            <th scope='col'>Registro</th>
                            <th scope='col'>Eliminar</th>
                        </tr>
                    </thead>";

                    $sql = "SELECT * FROM administradores";
                    $result = $conn-> query($sql) or die ("error en query $sql".mysqli_error());

                    if($result-> num_rows > 0) {
                    
                        while($row = mysqli_fetch_assoc($result)){
                            echo "
                            <tbody>
                            <th scope='row'>".$row["id_admin"]."</th>
                            <td>".$row["usuario"]."</td>
                            <td>".$row["password"]."</td>
                            <td>".$row["acceso"]."</td>
                            <td>".$row["registro"]."</td>
                            <td><a href='control_admin.php?delete=".$row["id_admin"]."'><i class='fas fa-trash-alt'></i></a></td>";
                }
                    echo "
                        </tbody>
                    </table>
                </div>";
                }
                else {
                    echo "<div class='alert alert-warning' role='alert'>
                    No hay informaci贸n por el momento.
                          </div>";
                }

                if(isset($_GET['delete'])){
                    $id = $_GET['delete'];
                    $conn->query("DELETE FROM administradores WHERE id_administrador = '$id'");
                }
    
                $connect-> close();
    
    ?>
    </section>
</body>
</html>

