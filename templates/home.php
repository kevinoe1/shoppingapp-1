<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../global/conexion.php';
include '../global/const.php';

session_start();

require ('../scripts/comprobaciones.php');

<<<<<<< HEAD
$consulta_tipo_usuario = $pdo->prepare("SELECT * FROM Usuarios
										WHERE PK_Usuario = :PK_Usuario;");
$consulta_tipo_usuario->bindParam(':PK_Usuario', $_SESSION['login_user']);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$consulta_tipo_usuario->execute();
$usuario = $consulta_tipo_usuario->fetchAll(PDO::FETCH_ASSOC);

if($usuario[0]['FK_TipoUsuario'] == 2){
	header('Location: Home-Tienda');
}else if($usuario[0]['FK_TipoUsuario'] == 3){
    header('Location: Admin');
}


 //Consulta seleccionar carrito
 $select_productos = $pdo->prepare("SELECT * FROM Productos");                         
 $select_productos->execute();
 $productos = $select_productos->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" id="hl-viewport" content="width=device-width, initial-scale=1, user-scalable=yes, minimum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shoppingapp</title>

    <!-- Imports -->
   
    <link href="<?php echo URL_SITIO ?>static/css/registro_datos.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo URL_SITIO ?>static/css/pedidos.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo URL_SITIO ?>static/css/styles.css" rel="stylesheet" type="text/css" media="all" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="<?php echo URL_SITIO ?>static/js/jquery-3.5.0.min.js" ></script>
	<?php include 'iconos.php' ?>
=======
	$sentenc = $pdo->prepare("SELECT PK_Pais,NombrePais,logo from paises Order by NombrePais asc");
	$sentenc->execute();
	$listaPaises = $sentenc->fetchAll(PDO::FETCH_ASSOC);
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3
 
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



<<<<<<< HEAD
    <div class="container row col-md-12 ">
    <?php foreach($productos as $producto){ ?>
<div class="col-md-3">
	<form id="product_<?php echo $producto['PK_Producto'] ?>" method="get" action="Detalle-Producto">
	<input type="hidden" value="<?php echo $producto['PK_Producto'] ?>" name="producto">
	<figure onclick="verDetalle(<?php echo $producto['PK_Producto'] ?>)" class="text-left card card-product">
		<div class="img-wrap"><img src="<?php echo URL_SITIO.$producto['Imagen'] ?>"></div>
		<figcaption class="info-wrap">
				<h4 class="title"><?php echo $producto['NombreProducto'] ?></h4>
				
				<div id="form" class="">
                        <p class="valoracion">
                            <?php 
                            $cont = 1;
                            $ranking = $producto['Ranking'];

                            
                            for($i = 1; $i <= 5; $i++){ 
                                if($cont <= $ranking){
                                ?>
                                    <label for="radio1" class="orange">★</label>
                                <?php 
                                $cont+=1;
                                }else{?>
                                    <label for="radio1" class="">★</label>
                                <?php }
                                
                            } ?>


                        </p>
                    </div>
				<div class="rating-wrap">
					<div style="font-size:13px;" class="label-rating"><?php echo $producto['UnidadesDisponibles'] ?> Unidades disponibles</div>
					<div style="font-size:13px;" class="label-rating"><?php echo $producto['UnidadesVendidas'] ?>  Unidades compradas </div>
				</div> <!-- rating-wrap.// -->
		</figcaption>
		<div class="bottom-wrap">
			<!-- <a href="detalle_producto.php?producto=<?php echo $producto['PK_Producto'] ?>" class="btn btn-sm btn-primary float-right">Ordenar</a>	 -->
			<div class="price-wrap h5">
				<span class="price-new">$ <?php echo $producto['PrecioUnitario'] ?></span> <del class="price-old">$19</del>
			</div> <!-- price-wrap.// -->
		</div> <!-- bottom-wrap.// -->
	</figure>
	</form>

</div> <!-- col // -->
<?php } ?>
=======
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3

</div> <!-- row.// -->
</div>
<!-- FIN DIV Temporal -->


<?php include 'footer.php'; ?>

<<<<<<< HEAD
</body>
</html>

<script type="text/javascript">
	function verDetalle(pk_producto){
		console.log('#product_'+pk_producto);
		$('#product_'+pk_producto).submit();
	}
</script>
=======
>>>>>>> 557c47d0325bc2e7beffc0721774dab9b7e52cb3
