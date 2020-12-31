<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta</title>
    <style>
        .title {
            text-align: center;
        }

    </style>
</head>
<body>
<?php include_once('nav_bar.php') ?>

    <div class="container">
        <br>
        <h3 class="h2 title">Cuenta</h3>
        <br>

            <table class="table table-hover table-sm">
            <thead>
                <tr class="table-success">
                <th scope="col">#</th>
                <th scope="col">Imagen</th>
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
                </tr>
            </tbody>
            </table>
            <br>
            <button type="button" class="btn btn-success btn-lg btn-block">Pagar</button>
    </div>
</body>
</html>