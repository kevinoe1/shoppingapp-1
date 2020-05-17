<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');

<<<<<<< HEAD

$select_usuario = $pdo->prepare("SELECT * FROM Usuarios
										                    WHERE PK_Usuario = :PK_Usuario;");
$select_usuario->bindParam(':PK_Usuario', $_SESSION['login_user']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$select_usuario->execute();
$usuario = $select_usuario->fetchAll(PDO::FETCH_ASSOC);

$select_paises = $pdo->prepare("SELECT * FROM Paises LIMIT 10");
$select_paises->bindParam(':PK_Usuario', $_SESSION['login_user']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$select_paises->execute();
$paises = $select_paises->fetchAll(PDO::FETCH_ASSOC);

?>



<footer >
  <div class="container">
    <div class="row">
      
      <div class="col-lg-4 col-md-6">
        <h3>Enlaces</h3>
        <ul class="list-unstyled three-column">
        <li><a href="<?php echo ($usuario[0]['FK_TipoUsuario']==2)?'./home_tienda.php':'./home.php'; ?>">Inicio</a> </li>
          <li>Servicios</li>
          <li>Compañía</li>
          <li>Ubicacion</li>
          <li>Contacto</li>
        </ul>
        <ul style="padding:0px;" class="">
          <a href="">
            <li style="font-size:40px;" class=" fa fa-facebook-square"></li>
          </a>
          <a href="">
            <li style="font-size:40px;margin-left:10px;" class=" fa fa-instagram"></li>
          </a>
          <a href="">
            <li style="font-size:40px;margin-left:10px;" class=" fa fa-twitter-square"></li>
          </a>
        </ul>
      </div>
      
      <div class="col-lg-4 col-md-6">
        <h3>Contáctanos</h3>

        <div class="media">
          <a href="#" class="pull-left">
            <i style="font-size:40px;" class="fa fa-phone-square-alt"></i>
          </a>
          <div class="media-body">
            <h6 class="media-heading" style="margin:10px 0px 0px 10px;">+504 89347854</h6>
          </div>
        </div>
      <br>
        <div class="media">
          <a href="#" class="pull-left">
            <i style="font-size:40px;" class="fa fa-envelope-square"></i>
          </a>
          <div class="media-body">
            <h6 class="media-heading" style="margin:10px 0px 0px 10px;">shoppingappworld@gmail.com</h6>
=======
  <footer style="position:relative;">
    <div class="container">
      <div class="row">
        
        <div class="col-lg-4 col-md-6">
          <h3>Site Map</h3>
          <ul class="list-unstyled three-column">
            <li>Home</li>
            <li>Services</li>
            <li>About</li>
            <li>Code</li>
            <li>Design</li>
            <li>Host</li>
            <li>Contact</li>
            <li>Company</li>
          </ul>
          <ul class="list-unstyled socila-list">
            <li><img src="http://placehold.it/48x48" alt="" /></li>
            <li><img src="http://placehold.it/48x48" alt="" /></li>
            <li><img src="http://placehold.it/48x48" alt="" /></li>
            <li><img src="http://placehold.it/48x48" alt="" /></li>
            <li><img src="http://placehold.it/48x48" alt="" /></li>
            <li><img src="http://placehold.it/48x48" alt="" /></li>
          </ul>
        </div>
        
        <div class="col-lg-4 col-md-6">
          <h3>latest Articles</h3>
          <div class="media">
            <a href="#" class="pull-left">
              <img src="http://placehold.it/64x64" alt="" class="media-object" />
            </a>
            <div class="media-body">
              <h4 class="media-heading">Programming</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
          </div>
          
          <div class="media">
            <a href="#" class="pull-left">
              <img src="http://placehold.it/64x64" alt="" class="media-object" />
            </a>
            <div class="media-body">
              <h4 class="media-heading">Coding</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3
          </div>
          
          <div class="media">
            <a href="#" class="pull-left">
              <img src="http://placehold.it/64x64" alt="" class="media-object" />
            </a>
            <div class="media-body">
              <h4 class="media-heading">Web Sesign</h4>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
          </div>
          
        </div>
<<<<<<< HEAD
      <br>
        <div class="media">
          <a href="#" class="pull-left">
            <i style="font-size:40px;" class="fa fa-whatsapp"></i>
          </a>
          <div class="media-body">
            <h6 class="media-heading" style="margin:10px 0px 0px 10px;">+504 89347854</h6>
          </div>
        </div>
        
      </div>
      
      <div class="col-lg-4">
        <h3>Paises</h3>
        <ul class="list-unstyled">
          <?php foreach($paises as $pais){ ?>
            <li><?php echo $pais['NombrePais'] ?></li>
          <?php } ?>
        </ul>
      </div>
      
    </div>
  </div>
  <div class="copyright text-center">
    Copyright &copy; 2020 <span>Shoppingapp</span>
  </div>
</footer>
=======
        
        <div class="col-lg-4">
          <h3>Our Work</h3>
          <img class="img-thumbnail" src="http://placehold.it/150x100" alt="" />
          <img class="img-thumbnail" src="http://placehold.it/150x100" alt="" />
          <img class="img-thumbnail" src="http://placehold.it/150x100" alt="" />
          <img class="img-thumbnail" src="http://placehold.it/150x100" alt="" />
        </div>
        
      </div>
    </div>
    <div class="copyright text-center">
      Copyright &copy; 2017 <span>Shoppingapp</span>
    </div>
  </footer>
</body>
</html>
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3
