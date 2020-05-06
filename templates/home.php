<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../global/conexion.php';

session_start();

require ('../scripts/comprobaciones.php');

	$sentenc = $pdo->prepare("SELECT PK_Pais,NombrePais,logo from paises Order by NombrePais asc");
	$sentenc->execute();
	$listaPaises = $sentenc->fetchAll(PDO::FETCH_ASSOC);
 
?> 

<?php include 'header.php'; ?>

<div class="container">
	<div class="row">

		<?php foreach ($listaPaises as $pais){?>
                                                 
            <div  class="col-xl-3 col-sm-6 mb-4 ">
                <div id="new" class="card text-white bg-muted o-hidden h-100">
                    <div class="card-body">
                    	<div class="card-body-icon">
                        	<img src="/shoppingapp/uploads/img/paises/<?php echo $pais["logo"] ?>" alt="<?php echo $pais["NombrePais"] ?>" style="border-radius: 7px;">
                      	</div>
                      	<div class="mr-5 text-center">
	                        <br>
	                        <br>
	                        <br>
                      	</div>  
                    </div>
                    <a class="card-footer  clearfix small z-1" href="/shoppingapp/Tiendas/?idPais=<?php echo $pais["PK_Pais"] ?>" >
	                    <span class="float-left" style="font-size: 1rem;">
	                        Ver las tiendas de <strong><?php echo $pais["NombrePais"] ?></strong>  
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

