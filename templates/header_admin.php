<?php 
error_reporting(E_ALL);
ini_set('display_errors', '0');

if(!isset($pdo)){
  include '../global/config.php';
  include '../global/conexion.php';
  include '../global/const.php';
  session_start();
}





$buscar_usuario = $pdo->prepare("SELECT * FROM Usuarios
                                WHERE PK_Usuario = :PK_Usuario");
$buscar_usuario->bindParam('PK_Usuario', $_SESSION['login_user']);
$buscar_usuario->execute();
$usuario = $buscar_usuario->fetchAll(PDO::FETCH_ASSOC);  

if($usuario[0]['FK_TipoUsuario']!=3){
  header('Location: Home');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Administración</title>



     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="
   sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

   <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
   <link href="<?php echo URL_SITIO ?>static/css/header_admin.css"rel="stylesheet">

    <script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"rel="stylesheet">


</head>

<body>

  <!-- Navigation navbar-dark bg-dark -->
  <nav class="navbar navbar-expand-lg static-top navbar-dark bg-per" >
    
      <a  class="navbar-brand" href="#">
        <img style="width:180px;" src="<?php echo URL_SITIO ?>static/img/Logo_shoppingapp_v2_trazado.png" alt="">
        <span class="text-modulo"> Módulo Administrativo</span> 
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item " id="paises">
            <a class="nav-link " href="<?php echo URL_SITIO?>Admin" >Inicio
            </a>
          </li>
          <li class="nav-item " id="paises">
            <a class="nav-link " href="<?php echo URL_SITIO?>Paises" >Paises
            </a>
          </li>
          <li class="nav-item" id="ciudades">
            <a class="nav-link" href="<?php echo URL_SITIO ?>Ciudades" >Ciudades</a>
          </li>
          <li class="nav-item" id="ciudades">
            <form action="Registro-Datos" method="POST">
              <input type="hidden" name="menu" value="registro_categoria" />
              <a class="nav-link" href="#" value="category" name="menu" onclick="this.parentNode.submit()" >Gestión de categoría</a>
            </form>
          </li>
          <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tienda
          </a>
          <div class="dropdown-menu dropdown-menu-right bg-warning" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/shoppingapp/Producto/">Registro de Producto</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Zonas de Envío</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Tipos de Pago</a>
          </div>
        </li> -->
      </ul>
      </div>
    
  </nav>
  <div class="container-fluid">
  <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item text-center" >
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              <div class="containerImg ">
                    <img class="crop img_p" src="<?php echo URL_SITIO ?>uploads/img/perfiles/<?php echo $usuario[0]['Foto'] ?>" />
              </div>
            </a>
            <span><?php echo $usuario[0]['NombreUsuario'] ?></span>
            <br>
            <form action="Registro-Datos" method="POST">
              <input type="hidden" name="menu" value="perfil_usuario" />
              <a style="color:white;font-size:13px;" class="" href="#" value="category" name="menu" onclick="this.parentNode.submit()" >Editar pefil</a>
            </form>
            <br>
            <br>
            <a style="color:white;font-size:13px;" href="<?php echo URL_SITIO ?>Login">Cerrar Sesión</a>
            <br>
            <br>
          </li>
        </ul>
      </div>
    </nav>
  
  

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
  

  