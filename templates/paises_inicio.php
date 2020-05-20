<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../global/config.php';
include '../global/conexion.php';
include '../global/const.php';

session_start();

require ('../scripts/comprobaciones.php');

	// $sentenc = $pdo->prepare("SELECT p.PK_Pais,p.NombrePais,p.Logo
	// 						FROM Paises p inner JOIN Ciudades c
	// 						ON p.PK_Pais=c.FK_Pais INNER JOIN Tiendas t
	// 						ON c.PK_Ciudad=t.FK_Ciudad
	// 						ORDER BY p.NombrePais asc");
	$sentenc = $pdo->prepare("SELECT p.PK_Pais,p.NombrePais,p.Logo
							FROM Paises p
							ORDER BY p.NombrePais asc");
	$sentenc->execute();
	$listaPaises = $sentenc->fetchAll(PDO::FETCH_ASSOC);

 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Inicio</title>

	 <!-- Imports -->
	 <link href="<?php echo URL_SITIO ?>static/css/styles.css" rel="stylesheet" type="text/css" media="all" />
	 <link href="<?php echo URL_SITIO ?>static/css/paises_inicio.css" rel="stylesheet" type="text/css" media="all" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="<?php echo URL_SITIO ?>static/js/jquery-3.5.0.min.js" ></script>
	<?php include 'iconos.php' ?>
	<!-- Imports -->

</head>
<body>
	<?php include './header.php'; ?>

	<div class="container height-full">
		<div class="row">

			<?php foreach ($listaPaises as $pais){?>
													
				<div  class="col-xl-3 col-sm-6 mb-4 ">
					<div id="new" class="card text-white bg-muted o-hidden h-100">
						<div class="card-body">
							<div class="card-body-icon">
								<img src="<?php echo URL_SITIO ?>uploads/img/paises/<?php echo $pais["logo"] ?>" alt="<?php echo $pais["NombrePais"] ?>" style="border-radius: 7px;">
							</div>
							<div class="mr-5 text-center">
							
							</div>  
						</div>
						<a class="card-footer  clearfix small z-1" href="<?php echo URL_SITIO ?>Tiendas?idPais=<?php echo $pais["PK_Pais"] ?>" >
							<span class="float-left" style="font-size: 1rem;">
								Tiendas de <strong class="text-uppercase"><?php echo $pais["NombrePais"] ?></strong>  
							</span>
							<span class="float-right">
								<i class="fas fa-angle-right"></i>
							</span>
						</a>
					</div>
				</div>
			<?php } ?> 
		</div>	
	</div>




	</div> <!-- row.// -->
	</div>
	<!-- FIN DIV Temporal -->

	<?php include 'footer.php'; ?>
</body>
</html>


