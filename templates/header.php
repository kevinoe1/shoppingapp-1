<?php

<<<<<<< HEAD

=======
include '../global/conexion.php';
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3
$buscar_carrito = $pdo->prepare("SELECT * FROM Carrito c INNER JOIN Clientes cli
                                    ON c.FK_Cliente = cli.PK_CLiente INNER JOIN Usuarios u
                                    ON cli.FK_Usuario = u.PK_Usuario 
                                    WHERE u.PK_Usuario = :PK_Usuario");
$buscar_carrito->bindParam('PK_Usuario', $_SESSION['login_user']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$buscar_carrito->execute();
$carrito = $buscar_carrito->fetchAll(PDO::FETCH_ASSOC);

$buscar_usuario = $pdo->prepare("SELECT * FROM Usuarios
                                WHERE PK_Usuario = :PK_Usuario");
$buscar_usuario->bindParam('PK_Usuario', $_SESSION['login_user']);
$buscar_usuario->execute();
$usuario = $buscar_usuario->fetchAll(PDO::FETCH_ASSOC);


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

<<<<<<< HEAD
<link href="<?php echo URL_SITIO ?>static/css/header.css" rel="stylesheet" type="text/css" media="all" />
=======
  <script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 
</head>
<body>
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3
<!-- primer nav -->
<nav class="navbar navbar-expand-lg navbar-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a id="lbl-carrito-movil" href="Carrito"> <i class="fas fa-shopping-cart"></i> ( <?php echo count($carrito) ?> )</a>

  <div class="row collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="row offset-md-2 col-md-10 navbar-nav ml-auto mt-2 mt-lg-0">
<<<<<<< HEAD
    
    <?php if($usuario[0]['FK_TipoUsuario'] == 1 ){ ?> 
        <li class="col-md-2 offset-md-1 nav-item">
            <a class="nav-link border-right" href="Home"><i class="fas fa-home mr-2"></i>Inicio</a>
          </li>
        <li   class="col-md-2  nav-item">
          <a class="nav-link border-right" href="Pedidos"><i class="fas fa-box mr-2"></i>Pedidos </a>
        </li>
        <li   class="col-md-2 nav-item">
          <a class="nav-link border-right" href="#"><i class="fas fa-map-marker mr-2"></i>País</a>
        </li>
        <li   class="col-md-2 nav-item">
          <a class="nav-link border-right" href="#"><i class="fas fa-phone mr-2"></i>2781 0000</a>
        </li>
    <?php } ?>
      <?php if(!isset($_SESSION['login_user'])){ ?>
        <li   class="col-md-2 nav-item">
          <a class="nav-link border-right" href="Login"><i class="fas fa-sign-in-alt mr-2"></i>Log In</a>
        </li>
        <li   class="col-md-2 nav-item">
          <a class="nav-link border-right" href="Registro-Usuario"><i class="fas fa-sign-out-alt mr-2"></i>Registrarse</a>
=======
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
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3
			</li>
      <?php }?>
      <?php if($usuario[0]['FK_TipoUsuario'] == 1 || $usuario[0]['FK_TipoUsuario'] == 3 ){ ?>
          <li class="col-md-2 nav-item dropdown ">
      <?php }else if($usuario[0]['FK_TipoUsuario'] == 2 ){ ?> 
          <li  class="col-md-2 offset-md-5 nav-item">
            <a class="nav-link border-right" href="Home"><i class="fas fa-home mr-2"></i>Inicio</a>
          </li>
          <li   class="col-md-2  nav-item">
            <a class="nav-link border-right" href="#"><i class="fas fa-store mr-2"></i>Mi tienda</a>
          </li>
          <li class="col-md-2  nav-item dropdown ">
      <?php } ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="row ">
              
            <?php if($usuario[0]['FK_TipoUsuario'] == 1 ){ ?>
                <div class=" containerI">
                    <img class="crop Im" src="<?php echo URL_SITIO?>uploads/img/perfiles/<?php echo $usuario[0]['Foto'] ?>" />
                </div>
            <?php }else if($usuario[0]['FK_TipoUsuario'] == 2 ){ ?> 
                <div class=" containerI">
                    <img class="crop Im" src="<?php echo URL_SITIO?>uploads/img/logos/<?php echo $usuario[0]['Foto'] ?>" />
                </div>
            <?php } ?>
              <div id="cont-nombre"><?php echo substr($usuario[0]['NombreUsuario'], 0, 15) ?></div>
              
            </div>
          
        </a>
<<<<<<< HEAD
        
        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
          
        <?php if($usuario[0]['FK_TipoUsuario'] == 1 ){ ?>
            <form action="Registro-Datos" method="POST">
              <input type="hidden" name="menu" value="perfil_usuario" />
              <a class="dropdown-item" href="#" value="category" name="menu" onclick="this.parentNode.submit()" >Mi cuenta</a>
            </form>
        <?php }else if($usuario[0]['FK_TipoUsuario'] == 2 ){ ?>
            <form action="Registro-Datos" method="POST">
              <input type="hidden" name="menu" value="perfil_tienda" />
              <a class="dropdown-item" href="#" value="category" name="menu" onclick="this.parentNode.submit()" >Mi cuenta</a>
            </form>
        <?php } ?>

          
=======
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
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3
          <div class="dropdown-divider"></div>

          <?php if($usuario[0]['FK_TipoUsuario'] == 1 || $usuario[0]['FK_TipoUsuario'] == 3 ){ ?>
            <form action="Login" method="POST">
              <input type="hidden" name="sesion" value="cerrar" />
              <a class="dropdown-item salir" href="#" value="salir" name="menu" onclick="this.parentNode.submit()" >Salir</a>
            </form>
          <?php }else if($usuario[0]['FK_TipoUsuario'] == 2 ){ ?>
            <form action="Login-Tienda" method="POST">
              <input type="hidden" name="sesion" value="cerrar" />
              <a class="dropdown-item salir" href="#" value="salir" name="menu" onclick="this.parentNode.submit()" >Salir</a>
            </form>
            <?php } ?>
        </div>
      </li>
			
		</ul>
  </div>
</nav>
<!-- // primer nav -->

<?php if($usuario[0]['FK_TipoUsuario'] == 1 || $usuario[0]['FK_TipoUsuario'] == 3 ){ ?>
<!-- segundo nav -->
<<<<<<< HEAD
<div class="row cont_segundo_nav" style="width:100%;">
	<div class="col-md-4 cont_imagen">
		<a href="Home"><div class="col-md-10 offset-md-1" id="logo1" alt=""></div></a>
=======
<div class="row" style="width:100%;">
	<div class="col-md-4">
		<a href="/shoppingapp/Home/"><div class="col-md-10 offset-md-1" id="logo1" alt=""></div></a>
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3
	</div>
	<div class="col-md-6" >
			<form class="form-inline" id="search-form" action="#" method="post">
					<input class="input-flat col-md-9 form-control" type="search" placeholder="Búsqueda" aria-label="Search" required>
					<button class="col-md-2 btn-flat" type="submit">Buscar</button>
			</form>
	</div>
	<div class="col-md-2">
    <div style="display:flex;">
<<<<<<< HEAD
      <a id="lbl-carrito" href="Carrito"> <i class="fas fa-shopping-cart"></i> Carrito ( <?php echo count($carrito) ?> )</a>
=======
      <a id="lbl-carrito" href="/shoppingapp/Carrito/"> <i class="fas fa-shopping-cart"></i> Carrito ( <?php echo count($carrito) ?> )</a>
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3
		</div>
		
	</div>
</div>
<!-- // segundo nav -->
<?php }else if($usuario[0]['FK_TipoUsuario'] == 2 ){ ?>
<!-- segundo nav -->
<div class="row cont_segundo_nav" style="width:100%;">
	<div class="col-md-4 cont_imagen">
		<a href="Home-Tienda"><div class="col-md-10 offset-md-1" id="logo1_tienda" alt=""></div></a>
	</div>
	<div class="col-md-6" >
		
	</div>

</div>
<!-- // segundo nav -->
<?php } ?>
    
    <script>
      if(<?php echo $usuario[0]['FK_TipoUsuario']?> == 3){
        $('.dropdown-toggle').hide();
      }
    </script>




