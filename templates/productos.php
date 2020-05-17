<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../global/conexion.php';

session_start();

require ('../scripts/comprobaciones.php');

    $id = (isset($_GET['Tienda'])) ? $_GET['Tienda'] : 0;
	$sentenc = $pdo->prepare("SELECT PK_Producto,Imagen,NombreProducto,PrecioUnitario
								FROM productos
								WHERE FK_Tienda=".$id."");
	$sentenc->execute();
	$productos = $sentenc->fetchAll(PDO::FETCH_ASSOC);
?> 

<?php include 'header.php'; ?>

<div style="padding:50px 20px 50px 20px;" class="text-center ">

    <div class="container row col-md-10 offset-md-1">
    	<?php foreach($productos as $producto){ ?>
			<div class="col-md-4">
				<figure class="card card-product">
					<div class="img-wrap"><img src="../<?php echo $producto['Imagen'] ?>"></div>
						<figcaption class="info-wrap">
							<h4 class="title"><?php echo $producto['NombreProducto'] ?></h4>
							<p class="desc">Descripción del producto</p>
							<div class="rating-wrap">
								<div class="label-rating">132 reviews</div>
								<div class="label-rating">154 orders </div>
							</div> <!-- rating-wrap.// -->
						</figcaption>
					<div class="bottom-wrap">
						<a href="/shoppingapp/Producto-Detalle/?producto=<?php echo $producto['PK_Producto'] ?>" class="btn btn-sm btn-primary float-right">Ordenar</a>	
						<div class="price-wrap h5">
							<span class="price-new">$ <?php echo $producto['PrecioUnitario'] ?></span> <del class="price-old">$1980</del>
						</div> <!-- price-wrap.// -->
					</div> <!-- bottom-wrap.// -->
				</figure>
			</div> <!-- col // -->
		<?php } ?>
	</div>
</div>
<?php include 'footer.php'; ?>

