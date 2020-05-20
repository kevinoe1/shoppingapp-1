<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../global/config.php';
include '../global/conexion.php';
include '../global/const.php';

session_start();

require ('../scripts/comprobaciones.php');

   
    $id = (isset($_GET['idPais'])) ? $_GET['idPais'] : 0;
    $sentenc = $pdo->prepare("SELECT t.PK_Tienda, t.NombreTienda,t.logo, c.PK_Ciudad,c.NombreCiudad,p.PK_Pais,p.NombrePais
                              FROM Tiendas t INNER JOIN Ciudades c
                              ON t.FK_Ciudad=c.PK_Ciudad INNER JOIN Paises p
                              ON c.FK_Pais=p.PK_Pais
                              WHERE p.PK_Pais=".$id."");
    $sentenc->execute();
    $listaPaises = $sentenc->fetchAll(PDO::FETCH_ASSOC);
  ?> 

 
 
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tiendas</title>

    <!-- Imports -->
    <link href="<?php echo URL_SITIO ?>static/css/styles.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo URL_SITIO ?>static/css/tiendas.css" rel="stylesheet" type="text/css" media="all" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="<?php echo URL_SITIO ?>static/js/jquery-3.5.0.min.js" ></script>
	<?php include 'iconos.php' ?>
  </head>
  <body>
  <?php include 'header.php'; ?>
<div class="container">
	<div class="row">

    <?php if(count($listaPaises)>0){ ?>
            <?php foreach ($listaPaises as $pais){?>
                                                 
                <div  class="col-xl-4 col-sm-6 mb-3 ">
                  <div id="new" class="card text-white bg-muted o-hidden h-100">
                    <div class="card-body">

                      <div class="card-body-icon">
                        <img src="<?php echo URL_SITIO ?>uploads/img/logos/<?php echo $pais["logo"] ?>" alt="" style="border-radius: 7px; width: 70%; float: right;">
                      </div>
                      <div class="mr-5 text-center">
                        <br>
                        <br>
                        <br>
                      </div>  
                    </div>
                    <a class="card-footer  clearfix small z-1" href="<?php echo URL_SITIO ?>Home?Tienda=<?php echo $pais["PK_Tienda"] ?>" >
                      <span class="float-left" style="font-size: 1rem;">
                       Comprar dentro de <strong class="text-uppercase"><?php echo $pais["NombreTienda"] ?></strong>  
                      </span>
                      <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </div>
             <?php } ?>
      <?php }else{ ?>
        <div style="margin-bottom:50px;" class="text-center col-md-10 offset-md-1 card-msj">
            <img class="col-md-6 " width="100%" src="<?php echo URL_SITIO?>static/img/no_tiendas.png" alt="">
            <br>
            <br>
            <br>
            <p>Lo sentimos, pero aun no hay tiendas registradas dentro este País.
            <span>Favor revise la sección principal, para más opciones</span></p>            
            <br>
            <a class="btn-flat" href="<?php echo URL_SITIO?>Inicio">Otros paises</a>        
        </div>
      <?php } ?>
       
    
	</div>	
</div>

<?php include 'footer.php'; ?>
  </body>
  </html>


