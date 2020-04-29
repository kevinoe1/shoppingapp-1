<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include ("../global/config.php");
include ("../global/conexion.php");

// tipo de registro
$form = (isset($_REQUEST['menu']))? $_REQUEST['menu'] : "";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

     <!-- Imports -->
    <link href="../static/css/styles.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../static/css/registro_datos.css" rel="stylesheet" type="text/css" media="all" />
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../static/js/jquery-3.5.0.min.js" ></script>

</head>
<body>
    <?php include ("../templates/header.php"); ?>

    <div class="row" style="width:100%;margin:0px;">
        
        
        <?php 
            switch($form){
                case 'registro_categoria':
                    require ('./registro_categoria.php');
                break;
                case 'ver_categorias':
                    require ('./ver_categorias.php');
                break;
            }
        ?>
       
       
        <div class="col-md-3 bordered">
        <div class="card card-right" style="width">
                <div class="card-body">
                    <h5 class="card-title">Atajos</h5>
                </div>
                <ul class="">
                    <li class=""> <a href="">Usuarios</a> </li>
                    <li class=""> <a href="">Paises</a> </li>
                    <li class=""> <a href="">Ciudades</a> </li>
                </ul>
            </div>
        </div>
    </div>
    
    <?php include ("../templates/footer.php");?>
</body>
</html>

