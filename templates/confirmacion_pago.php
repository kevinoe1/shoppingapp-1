<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../global/config.php';
include '../global/conexion.php';

session_start();

require ('../scripts/comprobaciones.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmación de pago</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../static/css/styles.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../static/css/confirmacion_pago.css" rel="stylesheet" type="text/css" media="all" />

	<script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

 
</head>
<body>

<?php include '../templates/header.php'; ?>

<!-- DIV temporal -->
<div class="text-center row col-md-12">
    <div class="card col-md-10 offset-md-1">
        <div class="card-body">
            <h5 class="card-title">Confirmación de pago</h5>
            <br>
            <br>
            <h6 class="card-subtitle mb-2 text-muted">Su pago se realizó de manera exitosa</h6>
            <p class="card-text">Ya puede pasar por sus productos en la tienda. Si escogió servicio a domicilio, Los productos llegarán al destinatario seleccinoado</p>
            <br>
            <a href="./home.php" class="card-link">Seguir comprando</a>
        </div>
    </div>
</div>
<!-- FIN DIV Temporal -->


<?php include '../templates/footer.php'; ?>

</body>
</html>