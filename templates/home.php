<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../global/config.php';
include '../global/conexion.php';

session_start();

require ('../scripts/comprobaciones.php');


 //Consulta seleccionar carrito
 $select_productos = $pdo->prepare("SELECT * FROM Productos");                         
 $select_productos->execute();
 $productos = $select_productos->fetchAll(PDO::FETCH_ASSOC);

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

<?php include '../templates/header.php'; ?>

<!-- DIV temporal -->
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
			<a href="detalle_producto.php?producto=<?php echo $producto['PK_Producto'] ?>" class="btn btn-sm btn-primary float-right">Ordenar</a>	
			<div class="price-wrap h5">
				<span class="price-new">$ <?php echo $producto['PrecioUnitario'] ?></span> <del class="price-old">$1980</del>
			</div> <!-- price-wrap.// -->
		</div> <!-- bottom-wrap.// -->
	</figure>
</div> <!-- col // -->
<?php } ?>

</div> <!-- row.// -->
</div>
<!-- FIN DIV Temporal -->


<?php include '../templates/footer.php'; ?>

</body>
</html>