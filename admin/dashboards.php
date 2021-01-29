<?php
require_once('../z_connect.php');

//Grafica Uno

$sql_one = "SELECT Date(registro ) as fecha, Sum(Costo*cantidad )as total From comandas_finales Group by 1 Order by 1" ;
$result = mysqli_query($conn, $sql_one) or die ("error en query $sql_one".mysqli_error());
$valoresY = array();
$valoresX= array();

while($ver= mysqli_fetch_row($result)){
  $valoresY[] = $ver[1];
  $valoresX[]= $ver[0];
  
}

$datosY = json_encode($valoresY);
$datosX = json_encode($valoresX);

//Grafica Dos
$sql_two = "SELECT mesa, Sum(Costo*cantidad )as total FROM comandas_finales Group by 1 Order by 1" ;
$result_two = mysqli_query($conn, $sql_two) or die ("error en query $sql_two".mysqli_error());
$barValorY = array();
$barValorX = array();

while($row= mysqli_fetch_row($result_two)){
  $barValorY[] = $row[1];
  $barValorX[]= $row[0];
  
}

$datos_dosY = json_encode($barValorY);
$datos_dosX = json_encode($barValorX);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Anuncios</title>
    <style>
        .title {
            text-align: center;
            color:#D7627C; 
            text-shadow: 1.5px 1px 2px #000;
        }

       .border{
        box-shadow: 5px 10px #0000;
       }
        
        @media only screen and (min-width: 500px){
            
        }
    </style>
</head>
<body>
<?php include_once('admin_navbar.php') ?>

    <section class="container">
        <br>
        <h3 class="title">Dashboard</h3>
        <br>
            
        <div class="col text-center">
            <a class="btn btn-info btn-lg" href="panel.php">Atras</a>
        </div>
        <br>
    </section>
    <!--Primera sección-->
    <section class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-primary">

                <div class="table-danger">
                    <h5 class="h2 text-center">Graficas de Actividad</h5>
                </div>
                
              <div class="panel panel-body border" >
                  <div class="row">
                    <div class=col-sm-6>
                      <div id="graficaLineal"></div>
                    </div>
                    <div class=col-sm-6>
                      <div id="graficaBarras"></div>
                    </div>
                  </div>              
              </div>
            </div>
          </div>
        </div>
       
    </section>
    <!--Segunda sección-->
    <section class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel panel-primary">

                <div class="table-danger">
                    <h5 class="h2 text-center">Graficas de Actividad</h5>
                </div>
                
              <div class="panel panel-body border" >
                  <div class="row">
                    <div class=col-sm-6>
                      <div id="graficaLineal"></div>
                    </div>
                    <div class=col-sm-6>
                      <div id="graficaBarras"></div>
                    </div>
                  </div>              
              </div>
            </div>
          </div>
        </div>
       
    </section>
</body>
</html>

<script src="graficas.js" type="text/javascript"></script>
<script type="text/javascript">

//Grafica Uno
datosX = crearGrafica('<?php echo $datosX ?>');
datosY = crearGrafica('<?php echo $datosY ?>');
//fechas = datosX.map(String);

var trace1 = {
  x: datosX,
  y: datosY,
  type: 'scatter',
  marker: {
      color: 'rgb(242, 95, 151)', 
    }
};

var data = [trace1];

var layout = {
  title: 'Ingresos al día',
  font:{
    family: 'Raleway, sans-serif'
  },
  xaxis: {
    title: "Días",
    font:{
    family: 'Raleway, sans-serif'
    },
    tickangle: -45
  },
  yaxis: {
    title: "Ingresos",
    font:{
    family: 'Raleway, sans-serif'
    },
    zeroline: false,
    gridwidth: 2
  },
  bargap :0.05
};

Plotly.newPlot('graficaLineal', data, layout);

//Grafica Dos

datos_dosX = crearGraficaBar('<?php echo $datos_dosX ?>');
datos_dosY = crearGraficaBar('<?php echo $datos_dosY ?>');

var data_dos = [
  {
    x: datos_dosX,
    y: datos_dosY,
    type: 'bar',
    marker: {
      color: 'rgb(113, 202, 213)',
    }
  }
];

var layout_dos = {
  title: 'Ingresos por mesa',
  font:{
    family: 'Raleway, sans-serif'
  },
  xaxis: {
    title: "Mesas",
    font:{
    family: 'Raleway, sans-serif'
    },
    tickangle: -45
  },
  yaxis: {
    title: "Ingresos",
    font:{
    family: 'Raleway, sans-serif'
    },
    zeroline: false,
    gridwidth: 2
  },
  bargap :0.05
};

Plotly.newPlot('graficaBarras', data_dos, layout_dos );
	
</script>