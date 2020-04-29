<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../global/config.php';
include '../global/conexion.php';

session_start();

if (isset($_SESSION['login_user'])){ //Comprobar si ha iniciado sesión
    $user = $_SESSION['login_user'];
}else{
    header('Location: login.php');
    // header('Location: completar_perfil_tienda.php');
}

$is_carrito_page = 1;

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
 $select_carrito->bindParam(':FK_Usuario', $user);                           
 $select_carrito->execute();
 $lista_carrito = $select_carrito->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Complete profile</title>

   <!-- Imports -->
   
    <link href="../static/css/registro_datos.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../static/css/carrito.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../static/css/styles.css" rel="stylesheet" type="text/css" media="all" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../static/js/jquery-3.5.0.min.js" ></script>
 

</head>
<body>
<?php require ('header.php') ?>

 <div class="alert text-center alert-danger" id="mensaje_alert" class="alert-dismissible fade show"></div>
 <div class="row" style="width:100%;margin:0px;">


    <div style="height:100%;margin-bottom:60px;" class="col-md-9 bordered">
       
              
                        <?php foreach($lista_carrito as $carrito){ ?>
                            <div class="card">
                            <div class="card-body">
                                
                            <div class="row">
                            <div class="col-md-4 square container temp-border"> <img class="crop col-md-12" src="../uploads/img/productos/product.jpg" alt=""> </div>
                            <div class="col-md-8 temp-border">
                                <div class="detail_up col-md-12 temp-border">
                                    <h4><?php echo $carrito['NombreProducto'] ?></h4>
                                    <div class=" text-left row">
                                        <label class="  col-md-12" for="">Tienda : <a href=""><?php echo $carrito['NombreTienda'] ?></a> </label>
                                    </div>
                                    <div class="text-left row">
                                        <label class="  col-md-12" for="">Cantidad : <?php echo $carrito['Cantidad'] ?></label>
                                    </div>
                                    <div class="text-left row">
                                        <label class="  col-md-12" for="">Precio : $ <?php echo $carrito['PrecioUnitario'] ?></label>
                                    </div>
                                </div>
                                <div class="detail_down col-md-12 temp-border">
                                    <div class="text-right row">
                                        <label class="subtotal col-md-12" for="">Subtotal : $ <?php echo $carrito['Subtotal'] ?> </label>
                                    </div>
                                    <div class="text-right row">
                                        <label class="descuento col-md-12" for="">Descuento : <?php echo $carrito['Descuento'] ?>%</label>
                                    </div>
                                    <div class=" text-right row">
                                        <label class="total col-md-12" for="">Total : $ <?php echo $carrito['Total'] ?> </label>
                                    </div>
                                </div>
                            </div>
                                   
                            </div>
                        </div>
                    </div>
                        <br>
                    <?php }?>
                    
                    <br>
                    <br>
                    

            
    </div>

     <div class="col-md-3  bordered">
        <div class="card card_detail">
            <form action="pago.php" method="post">
                <div class="col-md-12">
                    <label for="" class="col-md-12 lbl-detail">
                        Articulos(<?php echo count($lista_carrito)?>):
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
                        Envio: 
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
                <input type="hidden" name="action" value="completar" >
                <button type="submit" class="btn-flat col-md-12">Completar</button>
            </form>
        </div>
    </div>
    
</div>    



<script type="text/javascript">
    $("#mensaje_alert").css("visibility", "hidden");



    $('#form_completar_cliente').on('submit', function (event) {
            event.preventDefault();

        if( $('#inputPrimerNombre').val() == '' || $('#inputPrimerApellido').val() == '' || $('#inputTelefono').val() == '' || $('#inputDireccion1').val() == '' || $('#inputDireccion2').val() == '' || $('#inputPais')[0].selectedIndex == 0 || $('#inputCiudad')[0].selectedIndex == 0 ){
            mostrarMensaje("One or more required field(s) are missing.");
            ocultarMensaje();
        }else{
            $('#form_completar_cliente').unbind('submit').submit();
        }

    });

    function mostrarMensaje(msj){
        $("#mensaje_alert").css("visibility", "visible");
        $("#mensaje_alert").html(msj);
    }

    function ocultarMensaje(){
        $('.form-control').keypress(function(){
            $("#mensaje_alert").css("visibility", "hidden");
            $("#mensaje_alert").html("");
        });
    }


</script>

<?php require ('footer.php') ?>
</body>
</html>