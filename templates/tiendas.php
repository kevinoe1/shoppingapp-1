<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../global/conexion.php';

session_start();

require ('../scripts/comprobaciones.php');

   
    $id = (isset($_GET['idPais'])) ? $_GET['idPais'] : 0;
    $sentenc = $pdo->prepare("SELECT t.PK_Tienda, t.NombreTienda,t.logo, c.PK_Ciudad,c.NombreCiudad,p.PK_Pais,p.NombrePais
                              FROM tiendas t INNER JOIN ciudades c
                              ON t.FK_Ciudad=c.PK_Ciudad INNER JOIN paises p
                              ON c.FK_Pais=p.PK_Pais
                              WHERE p.PK_Pais=".$id."");
    $sentenc->execute();
    $listaPaises = $sentenc->fetchAll(PDO::FETCH_ASSOC);
  ?> 
<?php include 'header.php'; ?>

<div class="container">
	<div class="row">

    <?php if($listaPaises>0){ ?>
            <?php foreach ($listaPaises as $pais){?>
                                                 
                <div  class="col-xl-4 col-sm-6 mb-3 ">
                  <div id="new" class="card text-white bg-muted o-hidden h-100">
                    <div class="card-body">

                      <div class="card-body-icon">
                        <img src="/shoppingapp/uploads/img/logos/<?php echo $pais["logo"] ?>" alt="" style="border-radius: 7px; width: 70%; float: right;">
                      </div>
                      <div class="mr-5 text-center">
                        <br>
                        <br>
                        <br>
                      </div>  
                    </div>
                    <a class="card-footer  clearfix small z-1" href="/shoppingapp/Productos/?Tienda=<?php echo $pais["PK_Tienda"] ?>" >
                      <span class="float-left" style="font-size: 1rem;">
                       Comprar dentro de <?php echo $pais["NombreTienda"] ?></strong>  
                      </span>
                      <span class="float-right">
                        <i class="fas fa-angle-right"></i>
                      </span>
                    </a>
                  </div>
                </div>
             <?php } ?>
      <?php }else{ 
       echo "<script>alert('Conectado...')</script>";
      }?>
       
    
	</div>	
</div>

<?php include 'footer.php'; ?>
</body>
</html>
