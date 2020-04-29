<?php



$buscar_carrito = $pdo->prepare("SELECT * FROM Carrito c INNER JOIN Clientes cli
                                    ON c.FK_Cliente = cli.PK_CLiente INNER JOIN Usuarios u
                                    ON cli.FK_Usuario = u.PK_Usuario 
                                    WHERE u.PK_Usuario = :PK_Usuario");
$buscar_carrito->bindParam('PK_Usuario', $_SESSION['login_user']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$buscar_carrito->execute();
$carrito = $buscar_carrito->fetchAll(PDO::FETCH_ASSOC);


?>

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
        <a class="nav-link border-right" href="./login.php"><i class="fas fa-sign-in-alt mr-2"></i>Log In</a>
			</li>
			<li class="col-md-2 nav-item">
        <a class="nav-link border-right" href="./registro_usuario.php"><i class="fas fa-sign-out-alt mr-2"></i>Registrarse</a>
			</li>
			<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Configuración
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<form action="./registro_datos.php" method="POST">
						<input type="hidden" name="menu" value="registro_categoria" />
						<a class="dropdown-item" href="#" value="category" name="menu" onclick="this.parentNode.submit()" >Gestión de categoría</a>
          </form>
          <form action="./login.php" method="POST">
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
		<a href="./home.php"><div class="col-md-10 offset-md-1" id="logo1" alt=""></div></a>
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
    




