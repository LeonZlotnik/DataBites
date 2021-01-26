<?php include_once('navbar_slim.php');?>

<?php
            require_once('z_connect.php');
            
            $sql = "SELECT * FROM anuncios WHERE status = 'Activo'";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)){
?>

<div class="container">
<img class="card-img-top" <?php echo "src='admin/anuncios/".$row['imagen']."'";?> alt="Card image cap">
<h5 class="card-title"><?php echo $row['anuncio']?></h5>
<br>
<div class="container" id="slider-cut">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 slider-h" <?php echo "src='admin/anuncios/".$row['imagen']."'";?> alt="Z">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 slider-h" <?php echo "src='admin/anuncios/".$row['imagen']."'";?> alt="A">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 slider-h" <?php echo "src='admin/anuncios/".$row['imagen']."'";?> alt="B">
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>