<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="shorcut icon" type="img/png" href="img/favicon.png">
    <style>
        .title {
            text-align: center;
            color:#D7627C; 
            text-shadow: 1.5px 1px 2px #000;
        }
        .sesion {
            text-align: center;
            color: blue; 
            text-shadow: 1px 1px 1px #000;
        }
    </style>
</head>
<body>
<?php require_once('admin_navbar.php')?>

<div class="container">
    <br>
    <h3 class="text-center h1 title">Panel de Control</h3>
    <h6 class="text-center h5 sesion">Admin: <?php echo $_SESSION['admin'];?></h6>
    <br>
<div class="card">
  <div class="card-header">
  <i class="fas fa-database"></i>
  </div>
  <div class="card-body">
    <h5 class="card-title">Control de Administradores</h5>
    <p class="card-text">Encuentre toda la información de los usuarios que se han registrado a su tienda. Podrá visualizar sus datos y eliminar los registros de compradores que considere una amenaza.</p>
    <a href="contol_admin.php" class="btn btn-info">Revisar</a>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
  <i class="fas fa-boxes"></i>
  </div>
  <div class="card-body">
    <h5 class="card-title">Gestión de Menu</h5>
    <p class="card-text">Crear, editar y borrar los productos a su conveniencia, con el fin de facilitarle su gestión de ventas. Procure ser lo más especifico en las descripciones, imagenes mayores a 30 KB posiblemente no cargarán.</p>
    <a href="menudb.php" class="btn btn-info">Revisar</a>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
  <i class="fas fa-database"></i>
  </div>
  <div class="card-body">
    <h5 class="card-title">Gestión de Inventario</h5>
    <p class="card-text">De de alta los prooductos que requiere para elaborar los platillos para. De esta forma será más facil saber cuanto del inventario se esta consumiendo al día.</p>
    <a href="inventariodb.php" class="btn btn-info">Revisar</a>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
  <i class="fas fa-comment-dollar"></i>
  </div>
  <div class="card-body">
    <h5 class="card-title">Gestión de Comandas</h5>
    <p class="card-text">Con la finalidad de actualizar los precios de forma inmediata el menejador de precios le permitirá gestionar mejor los cambios. Recuerde eliminar la base que ha subido al terminar el ejercicio.</p>
    <a href="gestion_comandas.php" class="btn btn-info">Revisar</a>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
  <i class="fas fa-user-lock"></i>
  </div>
  <div class="card-body">
    <h5 class="card-title">Centro de Anucios</h5>
    <p class="card-text">Para tener un mejor manejo del panel de control, aquí puede dar de alta a nuevos administradores o eliminar a usuarios que ya no vayan a partisipar en dicha gestión.</p>
    <a href="centro_ads.php" class="btn btn-info">Revisar</a>
  </div>
  </div>
  <br>
  <div class="card">
  <div class="card-header">
  <i class="fas fa-user-lock"></i>
  </div>
  <div class="card-body">
    <h5 class="card-title">Ventas</h5>
    <p class="card-text">Vea el número de comandas cerradas, a manera que saber cuanto esta generando por cliente. </p>
    <a href="centro_ads.php" class="btn btn-info">Revisar</a>
  </div>
  </div>
  <br>
  <div class="card">
  <div class="card-header">
  <i class="fas fa-tags"></i>
  </div>
  <div class="card-body">
    <h5 class="card-title">Visualización de Data</h5>
    <p class="card-text">Mantenga el registro de todas las ventas generadas, visualize los usuarios que más compras le han realizado y exporte la información a su excel.</p>
    <a href="dashboards.php" class="btn btn-info">Revisar</a>
  </div>
</div>
<br>

<?php
 session_start();
 if(isset($_SESSION['admin'])){
   echo "<a href='logout.php?salir' class='btn btn-warning btn-lg btn-block'>Salir</a>";
 }
?>
</div>
<br>

</div>
</body>

<script>

  var b = localStorage.getItem(a);
  alert("Asistencia Requerida" + b);
  var resetValue = 0;
  localStorage.setItem(b, resetValue);
</script>
</html>

