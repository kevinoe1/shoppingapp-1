<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../global/config.php';
include '../global/conexion.php';

session_start();

 //Consulta seleccionar paises
 $select_destinatario = $pdo->prepare("SELECT d.NombresDestinatario, d.ApellidosDestinatario, d.Telefono, d.Departamento, d.Direccion1, d.Direccion2, d.CodigoPostal, ciu.NombreCiudad, p.NombrePais
                                    FROM Destinatarios d INNER JOIN Clientes c
                                    ON d.FK_Cliente = c.PK_Cliente INNER JOIN Usuarios u
                                    ON c.FK_Usuario = u.PK_Usuario INNER JOIN Ciudades ciu
                                    ON ciu.PK_Ciudad = d.FK_Ciudad INNER JOIN Paises p
                                    ON p.PK_Pais = ciu.FK_Pais
                                    WHERE u.PK_Usuario = :FK_Usuario");
 $select_destinatario->bindParam(':FK_Usuario', $_SESSION['login_user']);                           
 $select_destinatario->execute();
 $destinatario = $select_destinatario->fetchAll(PDO::FETCH_ASSOC);

  //Consulta seleccionar carrito
  $select_carrito = $pdo->prepare("SELECT p.NombreProducto, 
                                c.Cantidad, 
                                p.PrecioUnitario, 
                                p.Imagen, 
                                cl.Color,
                                t.Talla, 
                                p.Descuento, 
                                (p.PrecioUnitario * c.Cantidad) as 'Subtotal', 
                                (CAST(p.Descuento as DECIMAL(20,0)) ) as Descuento, 
                                (p.PrecioUnitario * c.Cantidad) - ((p.PrecioUnitario * c.Cantidad) * ((CAST(p.Descuento as DECIMAL(20,0)) )/100)) as 'Total',
                                ti.NombreTienda,
                                p.PrecioEnvio
                                FROM Carrito c INNER JOIN Productos p
                                ON c.FK_Producto = p.PK_Producto INNER JOIN Tallas t
                                ON c.FK_Talla = t.PK_Talla INNER JOIN Colores cl
                                ON c.FK_Color = cl.PK_Color INNER JOIN Clientes cli
                                ON c.FK_Cliente = cli.PK_Cliente INNER JOIN Usuarios u
                                ON cli.FK_Usuario = u.PK_Usuario INNER JOIN Tiendas ti
                                ON p.FK_Tienda = ti.PK_Tienda
                                WHERE cli.FK_Usuario = :FK_Usuario");
$select_carrito->bindParam(':FK_Usuario', $_SESSION['login_user']);                           
$select_carrito->execute();
$lista_carrito = $select_carrito->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>

     <!-- Imports -->
   
    <link href="../static/css/registro_datos.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../static/css/pago.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../static/css/styles.css" rel="stylesheet" type="text/css" media="all" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../static/js/jquery-3.5.0.min.js" ></script>

</head>
<body>



     <br>
<div class="col-md-12 ">
    <div class="row col-md-10 offset-md-1  ">
        <div class="row col-md-4">
            <a href="./home.php"><div class=" logo_content" alt=""></div></a>
        </div>
    </div>
</div>
<br>
    <div class="gray_back col-md-12 ">
        <div class="row gray_back col-md-10 offset-md-1  ">
            <div class=" gray_back col-md-8 ">
                <div class="card">
                    <fieldset class="form-group">
                        <label for="inputAddress2"><strong>Tipo de pago</strong> </label>
                        <hr>
                        <br>                                
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="input_estado" id="inputRadioActivo" value="1" checked>
                            <label class="form-check-label" for="inputRadioActivo">
                                <img width="100px" src="../static/img/PayPal-Logo.png" alt=""> 
                            </label>
                        </div>
                        <br>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="input_estado" id="inputRadioInactivo" value="0">
                            <label class="form-check-label" for="inputRadioInactivo">
                                Other
                            </label>
                        </div>
                    </fieldset>
                </div>
                <div style="height:20px;" class="col-md-12 gray_back"></div>
                <div class="card">
                    <div class=" form-group">
                        <label clas="row col-md-12" for="inputAddress2"><strong>Articulos no disponibles para envío</strong> </label>
                        <hr>                               
                        <div clas="row col-md-12" for=""><?php echo $destinatario[0]['NombresDestinatario']." ".$destinatario[0]['ApellidosDestinatario']  ?></div>
                        <div clas="row col-md-12" for=""><?php echo $destinatario[0]['NombreCiudad'].", ".$destinatario[0]['NombrePais'] ?></div>
                        <div clas="row col-md-12" for=""><?php echo $destinatario[0]['Direccion1'] ?></div>
                        <div clas="row col-md-12" for=""><?php echo $destinatario[0]['Direccion2'] ?></div>
                        <div clas="row col-md-12" for=""><?php echo $destinatario[0]['Telefono'] ?></div>
                    </div>
                    <a href="">Change</a>
                </div>
                <div style="height:20px;" class="col-md-12 gray_back"></div>
                <div class="card">
                    <div class=" form-group">
                        <label clas="row col-md-12" for="inputAddress2"><strong>Enviar a</strong> </label>
                        <hr>                               
                        <div clas="row col-md-12" for=""><?php echo $destinatario[0]['NombresDestinatario']." ".$destinatario[0]['ApellidosDestinatario']  ?></div>
                        <div clas="row col-md-12" for=""><?php echo $destinatario[0]['NombreCiudad'].", ".$destinatario[0]['NombrePais'] ?></div>
                        <div clas="row col-md-12" for=""><?php echo $destinatario[0]['Direccion1'] ?></div>
                        <div clas="row col-md-12" for=""><?php echo $destinatario[0]['Direccion2'] ?></div>
                        <div clas="row col-md-12" for=""><?php echo $destinatario[0]['Telefono'] ?></div>
                    </div>
                    <a href="">Change</a>
                </div>
                <div style="height:20px;" class="col-md-12 gray_back"></div>
                <div class="card">
                    <div class=" form-group">
                        <label clas="row col-md-12" for="inputAddress2"><strong>Review items</strong> </label>
                        <hr>                               
                        <?php foreach($lista_carrito as $carrito){ ?>
                            <div class="card">
                            <div class="card-body">
                                
                            <div class="row">
                            <div class="col-md-4 square container temp-border"> <img class="crop col-md-12" src="../uploads/img/productos/product.jpg" alt=""> </div>
                            <div class="col-md-8 temp-border">
                                <div class="detail_up col-md-12 temp-border">
                                    <h4><?php echo $carrito['NombreProducto'] ?></h4>
                                    <div class=" text-left row">
                                        <label class="  col-md-12" for="">Shop : <a href=""><?php echo $carrito['NombreTienda'] ?></a> </label>
                                    </div>
                                    <div class="text-left row">
                                        <label class="  col-md-12" for="">Quantity : <?php echo $carrito['Cantidad'] ?></label>
                                    </div>
                                    <div class="text-left row">
                                        <label class="  col-md-12" for="">Price : $ <?php echo $carrito['PrecioUnitario'] ?></label>
                                    </div>
                                </div>
                                <div class="detail_down col-md-12 temp-border">
                                    <div class="text-left row">
                                        <label class="subtotal col-md-12" for="">Subtotal : $ <?php echo $carrito['Subtotal'] ?> </label>
                                    </div>
                                    <div class="text-left row">
                                        <label class="descuento col-md-12" for="">Discount : <?php echo $carrito['Descuento'] ?>%</label>
                                    </div>
                                    <div class=" text-left row">
                                        <label class="total col-md-12" for="">Total : $ <?php echo $carrito['Total'] ?> </label>
                                    </div>
                                </div>
                            </div>
                                   
                            </div>
                        </div>
                    </div>
                        <hr>
                    <?php }?>
                </div>
            </div>
                    <br>
                    <br>
    </div>

 <div class=" gray_back col-md-4 ">
        <div class="card card_detail">
            <form action="pago_proceso.php" method="post">
                <div class="col-md-12">
                    <label for="" class="col-md-12 lbl-detail">
                        Items(<?php echo count($lista_carrito)?>):
                        <span class="text-right"> $
                        <?php
                        $total_todos = 0; 
                        foreach($lista_carrito as $carrito){ 
                            $total_todos+= $carrito['Total'] ;
                        } 
                        echo $total_todos;
                        ?>
                        </span>
                    </label>
                    <label for="" class="col-md-12 lbl-detail">
                        Shipping: 
                        <span class="text-right"> $
                        <?php
                        $total_envio = 0; 
                        foreach($lista_carrito as $carrito){ 
                            $total_envio+=$carrito['PrecioEnvio'];
                        } 
                        echo $total_envio;
                        ?>
                        </span>
                    </label>
                    <hr>
                    <label for="" class=" total col-md-12 Total">
                        Total:
                        <span class="text-right"> $
                        <?php
                        $total_todos = 0; 
                        foreach($lista_carrito as $carrito){ 
                            $total_todos+= $carrito['Total'] + $carrito['PrecioEnvio'];
                        } 
                        echo $total_todos;
                        ?>
                        </span>
                    </label>
                </div>

                <input type="hidden" name="total" value="<?PHP echo $total_todos; ?>" >

            
                <input type="hidden" name="action" value="completar" >
                <button type="submit" class="btn-flat col-md-12">Pagar</button>
            </form>



            
        </div>
    </div>  
    
   


        </div>
    </div>

<br>
<br>
<?php require ('footer.php') ?>
    
</body>
</html>