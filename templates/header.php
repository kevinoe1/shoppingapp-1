<?php

include '../global/conexion.php';
$buscar_carrito = $pdo->prepare("SELECT * FROM Carrito c INNER JOIN Clientes cli
                                    ON c.FK_Cliente = cli.PK_CLiente INNER JOIN Usuarios u
                                    ON cli.FK_Usuario = u.PK_Usuario 
                                    WHERE u.PK_Usuario = :PK_Usuario");
$buscar_carrito->bindParam('PK_Usuario', $_SESSION['login_user']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$buscar_carrito->execute();
$carrito = $buscar_carrito->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoppingapp</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="../static/css/styles.css" rel="stylesheet" type="text/css" media="all" />

  <script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 
</head>
<body>
<!-- primer nav -->
<nav class="navbar navbar-expand-lg navbar-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="row collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="row offset-md-2 col-md-10 navbar-nav ml-auto mt-2 mt-lg-0">
      <li class=" col-md-2 nav-item">
        <a class="nav-link border-right" href="#"><i class="fas fa-box mr-2"></i>Pedidos </a>
      </li>
      <li class="col-md-2 nav-item">
        <a class="nav-link border-right" href="#"><i class="fas fa-map-marker mr-2"></i>País</a>
      </li>
      <li class="col-md-2 nav-item">
        <a class="nav-link border-right" href="#"><i class="fas fa-phone mr-2"></i>2781 0000</a>
			</li>
			<li class="col-md-2 nav-item">
        <a class="nav-link border-right" href="/shoppingapp/Login/"><i class="fas fa-sign-in-alt mr-2"></i>Log In</a>
			</li>
			<li class="col-md-2 nav-item">
        <a class="nav-link border-right" href="/shoppingapp/Registro-Usuario/"><i class="fas fa-sign-out-alt mr-2"></i>Registrarse</a>
			</li>
			<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Configuración
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<form action="/shoppingapp/Admin/" method="POST">
						<input type="hidden" name="menu" value="registro_categoria" />
						<a class="dropdown-item" href="#" value="category" name="menu" onclick="this.parentNode.submit()" >Gestión de categoría</a>
          </form>
          <form action="/shoppingapp/Login/" method="POST">
						<input type="hidden" name="sesion" value="cerrar" />
						<a class="dropdown-item" href="#" value="salir" name="menu" onclick="this.parentNode.submit()" >Salir</a>
					</form>
          <a class="dropdown-item" href="#">algo más</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">algo más</a>
        </div>
      </li>
		</ul>
  </div>
</nav>
<!-- // primer nav -->

<!-- segundo nav -->
<div class="row" style="width:100%;">
	<div class="col-md-4">
		<a href="/shoppingapp/Home/"><div class="col-md-10 offset-md-1" id="logo1" alt=""></div></a>
	</div>
	<div class="col-md-6" >
			<form class="form-inline" id="search-form" action="#" method="post">
					<input class="input-flat col-md-9 form-control" type="search" placeholder="Búsqueda" aria-label="Search" required>
					<button class="col-md-2 btn-flat" type="submit">Buscar</button>
			</form>
	</div>
	<div class="col-md-2">
    <div style="display:flex;">
      <a id="lbl-carrito" href="./carrito.php"> <i class="fas fa-shopping-cart"></i> Carrito ( <?php echo count($carrito) ?> )</a>
		</div>
		
	</div>
</div>
<!-- // segundo nav -->
    




