<?php
include 'global/config.php';
include 'global/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoppingapp</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link href="static/css/styles.css" rel="stylesheet" type="text/css" media="all" />

		<script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

 
</head>
<body>

<!-- primer nav -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="row collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="row offset-md-2 col-md-10 navbar-nav ml-auto mt-2 mt-lg-0">
      <li class="offset-md-2 col-md-2 nav-item">
        <a class="nav-link border-right" href="#"><i class="fas fa-box mr-2"></i>Pedidos </a>
      </li>
      <li class="col-md-2 nav-item">
        <a class="nav-link border-right" href="#"><i class="fas fa-map-marker mr-2"></i>País</a>
      </li>
      <li class="col-md-2 nav-item">
        <a class="nav-link border-right" href="#"><i class="fas fa-phone mr-2"></i>2781 0000</a>
			</li>
			<li class="col-md-2 nav-item">
        <a class="nav-link border-right" href=""><i class="fas fa-sign-in-alt mr-2"></i>Log In</a>
			</li>
			<li class="col-md-2 nav-item">
        <a class="nav-link" href="#"><i class="fas fa-sign-out-alt mr-2"></i>Registrarse</a>
      </li>
		</ul>
  </div>
</nav>
<!-- // primer nav -->

<!-- segundo nav -->
<div class="row" style="width:100%;">
	<div class="col-md-4">
		<img src="static/img/Logo_shoppingapp_v2.png" class="col-md-10 offset-md-1" id="logo1" alt="">
	</div>
	<div class="col-md-6" >
			<form class="form-inline" id="search-form" action="#" method="post">
					<input class="input-flat col-md-9 form-control" type="search" placeholder="Search" aria-label="Search" required>
					<button class="col-md-2 btn-flat" type="submit">Search</button>
			</form>
	</div>
	<div class="col-md-2">
		<div style="display:flex;">
			<a id="lbl-carrito" href=""> <i class="fas fa-shopping-cart"></i> Carrito (0)</a>
		</div>
		
	</div>
</div>
<!-- // segundo nav -->
    

<?php
    
?>


