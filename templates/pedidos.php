<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
include '../global/config.php';
include '../global/conexion.php';
include ('../global/const.php');

session_start();

if (isset($_SESSION['login_user'])){ //Comprobar si ha iniciado sesión
    $user = $_SESSION['login_user'];
}else{
    header('Location: Login');
    // header('Location: completar_perfil_tienda.php');
}

// seleccionar tipos de pedidos
$buscar_tipo_pedidos = $pdo->prepare('SELECT * FROM TiposPedido');
$buscar_tipo_pedidos->bindParam('FK_Usuario', $user);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$buscar_tipo_pedidos->execute();
$tipo_pedidos = $buscar_tipo_pedidos->fetchAll(PDO::FETCH_ASSOC);

// Búsqueda
$busqueda = (isset($_POST['input_busqueda']))?$_POST['input_busqueda']:"";

// filtros
$filtro_tipo_pedido = (isset($_POST['input_tipoPedido']))?$_POST['input_tipoPedido']:"";
$filtro_desde = (isset($_POST['input_desde']))?$_POST['input_desde']:"";
$filtro_hasta = (isset($_POST['input_hasta']))?$_POST['input_hasta']:"";

$str_filtro_tipo_pedido = ($filtro_tipo_pedido == 1 || $filtro_tipo_pedido == 2)?" AND c.FK_TipoPedido = :FK_TipoPedido":"" . "";
$str_filtro_desde_hasta = ($filtro_desde != '' && $filtro_hasta != '')?" AND pe.FechaHoraCompra BETWEEN :FechaHoraDesde AND :FechaHoraHasta":"";
$str_busqueda = ($busqueda != '')?" AND (p.NombreProducto LIKE '%" . $busqueda . "%'
                                    OR ti.NombreTienda LIKE '%" . $busqueda . "%'
                                    OR pe.NumeroPedido LIKE '%" . $busqueda . "%'
                                    OR c.CodigoDetallePedido LIKE '%" . $busqueda . "%') ":"";

date_default_timezone_set('America/Tegucigalpa');
$fecha_actual = date("Y-m-d H:i:s");
$default_desde = date("Y-m-d",strtotime($fecha_actual." - 15 days")) . 'T08:00'; 
$default_hasta = date("Y-m-d",strtotime($fecha_actual." + 15 days")) . 'T08:00'; 

$pagina = false;
$items_por_pagina = 4;
 
//examino la pagina a mostrar y el inicio del registro a mostrar
if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $items_por_pagina;
}

// consulta para contar el total de los pedidos
$select_detalle_pedidos_total = $pdo->prepare("SELECT c.PK_DetallePedido
                                        FROM DetallePedidos c INNER JOIN Productos p
                                        ON c.FK_Producto = p.PK_Producto INNER JOIN Clientes cli
                                        ON c.FK_Cliente = cli.PK_Cliente INNER JOIN Usuarios u
                                        ON cli.FK_Usuario = u.PK_Usuario INNER JOIN Tiendas ti
                                        ON p.FK_Tienda = ti.PK_Tienda INNER JOIN Pedidos pe
                                        ON pe.PK_Pedido = c.FK_Pedido 
                                        WHERE cli.FK_Usuario = :FK_Usuario AND c.Estado = 0
                                        ". $str_filtro_tipo_pedido . $str_filtro_desde_hasta . $str_busqueda ."");
 
 $select_detalle_pedidos_total->bindParam(':FK_Usuario', $user);  
 if($filtro_tipo_pedido == 1 ){
    $fk = 1;
    $select_detalle_pedidos_total->bindParam(':FK_TipoPedido', $fk); 
 }elseif($filtro_tipo_pedido == 2 ){
    $fk = 2;
    $select_detalle_pedidos_total->bindParam(':FK_TipoPedido', $fk); 
 }
 if($filtro_desde != '' && $filtro_hasta != ''){
    $select_detalle_pedidos_total->bindParam(':FechaHoraDesde', $filtro_desde); 
    $select_detalle_pedidos_total->bindParam(':FechaHoraHasta', $filtro_hasta); 
 }
 $select_detalle_pedidos_total->execute();
 $lista_pedidos_total = $select_detalle_pedidos_total->fetchAll(PDO::FETCH_ASSOC);

 // Consulta para obtener pedidos por paginación
$select_detalle_pedidos = $pdo->prepare("SELECT p.NombreProducto, 
                                        c.Cantidad, 
                                        p.PrecioUnitario, 
                                        p.Imagen, 

                                        (SELECT Color From Colores WHERE PK_Color = c.FK_Color) as 'Color',
                                        (SELECT Talla From Tallas WHERE PK_Talla = c.FK_Talla) as 'Talla',

                                        p.Descuento, 
                                        (p.PrecioUnitario * c.Cantidad) as 'Subtotal', 
                                        (CAST(p.Descuento as DECIMAL(20,0)) ) as DescuentoDecimal, 
                                        (p.PrecioUnitario * c.Cantidad) - ((p.PrecioUnitario * c.Cantidad) * ((CAST(p.Descuento as DECIMAL(20,0)) )/100)) as 'Total',
                                        ti.NombreTienda,
                                        p.PrecioEnvio,
                                        c.FK_TipoPedido,
                                        c.PK_DetallePedido,
                                        c.FK_Pedido,
                                        c.Estado,
                                        pe.NumeroPedido,
                                        c.CodigoDetallePedido,
                                        (SELECT NombresDestinatario FROM Destinatarios WHERE PK_Destinatario = c.FK_Destinatario) as 'NombresDestinatario',
                                        (SELECT ApellidosDestinatario FROM Destinatarios WHERE PK_Destinatario = c.FK_Destinatario) as 'ApellidosDestinatario',
                                        DATE_FORMAT(pe.FechaHoraCompra, '%d %m %Y ') as 'FechaCompra',
                                        DATE_FORMAT(pe.FechaHoraCompra, '%H:%i ') as 'HoraCompra'

                                        FROM DetallePedidos c INNER JOIN Productos p
                                        ON c.FK_Producto = p.PK_Producto INNER JOIN Clientes cli
                                        ON c.FK_Cliente = cli.PK_Cliente INNER JOIN Usuarios u
                                        ON cli.FK_Usuario = u.PK_Usuario INNER JOIN Tiendas ti
                                        ON p.FK_Tienda = ti.PK_Tienda INNER JOIN Pedidos pe
                                        ON pe.PK_Pedido = c.FK_Pedido 
                                        WHERE cli.FK_Usuario = :FK_Usuario AND c.Estado = 0
                                        ". $str_filtro_tipo_pedido . $str_filtro_desde_hasta . $str_busqueda ."
                                        ORDER BY c.PK_DetallePedido DESC LIMIT ". $inicio .", " . $items_por_pagina . "");
 $select_detalle_pedidos->bindParam(':FK_Usuario', $user); 
                                        
 
 if($filtro_tipo_pedido == 1 ){
    $fk = 1;
    $select_detalle_pedidos->bindParam(':FK_TipoPedido', $fk); 
 }elseif($filtro_tipo_pedido == 2 ){
    $fk = 2;
    $select_detalle_pedidos->bindParam(':FK_TipoPedido', $fk); 
 }

 if($filtro_desde != '' && $filtro_hasta != ''){
    $select_detalle_pedidos->bindParam(':FechaHoraDesde', $filtro_desde); 
    $select_detalle_pedidos->bindParam(':FechaHoraHasta', $filtro_hasta); 
 }

 $select_detalle_pedidos->execute();
 $lista_pedidos = $select_detalle_pedidos->fetchAll(PDO::FETCH_ASSOC);

//calculo el total de paginas
$total_pages = ceil(count($lista_pedidos_total) / $items_por_pagina);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedidos</title>

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

</head>
<body>
   
<?php require ('header.php') ?>
<div class="alert alert-secondary">Inicio / Pedidos</div>
 <div class="row" style="width:100%;margin:0px;">

 <div class="col-md-2 ">
            <div class="card card-left">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form action="Pedidos" method="POST">
                            <button type="submit" class="col-md-12 btn btn-primary">Pendientes</button>
                        </form>
                    </li>
                    <li class="list-group-item">
                        <form action="Pedidos-Completados" method="POST">
                            <button type="submit" class="col-md-12 btn btn-primary">Completados</button>
                        </form>
                    </li>
                </ul>
         </div>
         <br>
</div>

    <div style="height:100%;margin-bottom:60px;" class="col-md-9 ">
    <div id="mensaje-success" class="alert alert-success" role="alert"></div>
    <div id="mensaje-error" class="alert alert-danger" role="alert"></div>
    <div class="cont-filtros">
    <form action="Pedidos" method="post">
        <div class="row col-md-12">
            
                <div class="col-md-10">
                    <input class="form-control" style="width:100%" type="text" placeholder="Búsqueda" value="<?php echo $busqueda ?>" name="input_busqueda">
                </div>
                <div class="col-md-2">
                    <input class="btn btn-primary btn-flat" style="width:100%" type="submit" value="Buscar" name="action">
                </div>
          
        </div>
    </form>
    <br>
        <form action="Pedidos" method="post">
        <div class="row col-md-12">
            
            <div class="col-md-2">
                Tipo de pedido
                <select class="form-control" name="input_tipoPedido" id="inputTipoPedido">
                <option value="0">Todos</option>
                    <?php foreach($tipo_pedidos as $tipo_pedido){ ?>
                    <option <?php echo ($filtro_tipo_pedido == $tipo_pedido['PK_TipoPedido'])?"selected":""; ?> value="<?php echo $tipo_pedido['PK_TipoPedido'] ?>"><?php echo $tipo_pedido['TipoPedido'] ?></option>
                    <?php } ?>
                </select>
                </div>
                <div class="col-md-4">
                    Desde
                    <input id="party" type="datetime-local" class="form-control" name="input_desde" value="<?php echo ($filtro_desde != '')?$filtro_desde:$default_desde; ?>">
                </div>
                <div class="col-md-4">
                    Hasta
                    <input id="party" type="datetime-local" class="form-control" name="input_hasta" value="<?php echo ($filtro_hasta != '')?$filtro_hasta:$default_hasta; ?>">
                </div>
                <div class="col-md-2">
                    <input class="btn btn-primary btn-filtrar" style="width:100%" type="submit" value="Filtrar" name="action">
                </div>
          
        </div>
        </form>
    </div>
        <div class="text-center" ><?php echo (count($lista_pedidos) == 0) ? 'No hay productos pedidos.': ""; ?> </div>
   
              
                        <?php foreach($lista_pedidos as $detalle_pedido){ ?>
                            <?php if($detalle_pedido['Estado'] == 0){ ?>
                            <div class="card">
                            <div class="card-body">
                                
                            <div class="row">
                            <div class="col-md-4 square container temp-border"> <img class="crop col-md-12" src="<?php echo URL_SITIO.$detalle_pedido['Imagen'] ?>" alt=""> </div>
                            <div class="col-md-8 temp-border">
                                <div class="detail_up col-md-12 temp-border">
                                    
                                    <h4 class=""><?php echo $detalle_pedido['NombreProducto'] ?>  
                                        <?php if($detalle_pedido['FK_TipoPedido']==2){ ?>
                                            <img src="<?php echo URL_SITIO ?>static/img/icon_adomicilio.png" class="info_tipo" alt=""><span class="info_tipo_letras">Adomicilio</span>
                                        <?php }else{ ?>
                                            <img src="<?php echo URL_SITIO ?>static/img/icon_entienda.png" class="info_tipo" alt=""><span class="info_tipo_letras">En tienda</span>
                                        <?php } ?>
                                    </h4>
                                    <div class=" text-left row">
                                        <label class="  col-md-12" for="">Tienda &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <a href=""><?php echo $detalle_pedido['NombreTienda'] ?></a> </label>
                                    </div>
                                    <div class="text-left row">
                                        <label class="  col-md-12" for="">Cantidad &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $detalle_pedido['Cantidad'] ?></label>
                                    </div>
                                    <div class="text-left row">
                                        <label class="  col-md-12" for="">Precio &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: $ <?php echo $detalle_pedido['PrecioUnitario'] ?></label>
                                    </div>
                                        <div class="text-left row">
                                            <label class="subtotal col-md-12" for="">Subtotal  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: $ <?php echo $detalle_pedido['Subtotal'] ?> </label>
                                        </div>
                                        <div class="text-left row">
                                            <label class="descuento  col-md-12" for="">Descuento  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:<?php echo (isset($detalle_pedido['DescuentoDecimal']))?"-&nbsp$ ".(($detalle_pedido['Subtotal'])/$detalle_pedido['DescuentoDecimal']):'&nbsp&nbsp N/A';  ?></label>
                                        </div>
                                        <?php if($detalle_pedido['FK_TipoPedido']==2){ ?>
                                            <div class="text-left row">
                                                <label class=" subtotal col-md-12" for="">Precio envío &nbsp&nbsp&nbsp: $ <?php echo (($detalle_pedido['FK_TipoPedido']==2)?$detalle_pedido['PrecioEnvio']:'N/A') ?></label>
                                            </div>
                                        <?php } ?>
                                        <div class=" text-left row">
                                            <label class="total text-bold col-md-12" for="">Total  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: $ <?php echo ($detalle_pedido['Subtotal']) - ((isset($detalle_pedido['DescuentoDecimal']))?(($detalle_pedido['Subtotal'])/$detalle_pedido['DescuentoDecimal']):0) + (($detalle_pedido['FK_TipoPedido']==2)?$detalle_pedido['PrecioEnvio']:0)  ?> </label>
                                        </div>
                                        <hr>
                                        <div class="text-left row">
                                            <label class="descuento  col-md-12" for="">Fecha de compra  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:&nbsp<?php echo $detalle_pedido['FechaCompra'] . 'a las ' . $detalle_pedido['HoraCompra']; ?></label>
                                        </div>
                                        <div class="text-left row">
                                            <label class="descuento  col-md-12" for="">Estado de pedido  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:
                                                <?php 
                                                    if($detalle_pedido['Estado'] == 0){
                                                        if($detalle_pedido['FK_TipoPedido']==1){
                                                            echo 'No reclamado (aún en tienda)';
                                                        }elseif($detalle_pedido['FK_TipoPedido']==2){
                                                            echo 'Enviado, no recibido';
                                                        }
                                                    }
                                                ?>
                                            </label>
                                        </div>
                                        <?php if($detalle_pedido['FK_TipoPedido']==2){ ?>
                                            <div class="text-left row">
                                                <label class=" subtotal col-md-12" for="">Enviado a <span class="text-gray"><?php echo $detalle_pedido['NombresDestinatario'] . ' ' . $detalle_pedido['ApellidosDestinatario'] ?></span></label>
                                            </div>
                                        <?php } ?>
                                        <br>
                                        <div class="text-left row">
                                                <label style="font-size:13px;color:gray;" class=" subtotal col-md-12" for="">ID de pago: <span class="text-bold"><?php echo $detalle_pedido['CodigoDetallePedido'] ?></span></label>
                                        </div>
                                        <div class="text-left row">
                                                <label style="font-size:13px;color:gray;" class=" subtotal col-md-12" for="">Pago PayPal: <span class="text-bold"><?php echo $detalle_pedido['NumeroPedido'] ?></span></label>
                                        </div>
                                        

                                </div>
                               
                               
                            </div>
                            
                            </div>
                        </div>
                        <?php if($detalle_pedido['FK_TipoPedido']==2){ ?>
                            <h4 class="col-md-2 offset-md-10">
                                <button data-toggle="modal" data-target=".modal-confirmar" onClick="confirmar(<?php echo $detalle_pedido['PK_DetallePedido'] ?>)" type="button" class="btn btn_completado" > Recibido </button>
                            </h4> 
                        <?php } ?>
                        <br> 
                    </div>
                        <br>
                        <?php } ?>
                    <?php }?>
                    
<?php 

echo '<nav class="col-md-12">';
echo '<ul class="pagination" >';

if ($total_pages > 1) {
    if ($pagina != 1) {
        echo '<li class="page-item"><a class="page-link" href="Pedidos?pagina='.($pagina-1).'"><span aria-hidden="true">&laquo;</span></a></li>';
    }

    for ($i=1;$i<=$total_pages;$i++) {
        if ($pagina == $i) {
            echo '<li class="page-item active"><a class="page-link" href="#">'.$pagina.'</a></li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="Pedidos?pagina='.$i.'">'.$i.'</a></li>';
        }
    }

    if ($pagina != $total_pages) {
        echo '<li class="page-item"><a class="page-link" href="Pedidos?pagina='.($pagina+1).'"><span aria-hidden="true">&raquo;</span></a></li>';
    }
}
echo '</ul>';
echo '</nav>';

?>   
    </div>

    
</div>    

<!-- modal para confirmar -->
<div class="modal fade modal-confirmar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class=" md-content col-md-12">
                <br>
                <label class="text-center col-md-12" for=""><strong>Confirmar</strong></label>
          
            <div style="height:100%;margin-bottom:60px;" class="col-md-12 offset-md-0 bordered">
                <div class="card">
                <div class="card-body">
                    <form id="form-confirmar" action="<?php echo URL_SITIO ?>scripts/pedidos.php" method="post" enctype="multipart/form-data">
                      
                        <label for="">¿Desea confirmar la recepción del pedido?</label>

                        <br>
                        <br>
                        <br>
                        <br>

                        <input type="hidden" id="PK_DetallePedido" name="pk_detallePedido">
                        <input type="hidden" value="confirmar_pedido" name="action">

                        <div class="text-center col-md-12">
                        <button id="btnAceptar" type="submit" data-dismiss="modal" class=" btn-modal btn btn-primary col-md-5">Aceptar</button>&nbsp&nbsp&nbsp
                        <button id="btnCancelar" type="" data-dismiss="modal" class=" btn-modal btn btn-secondary col-md-5">Cancelar</button>
                        </div>
                        
                    </form>

                </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $("#mensaje_alert").css("visibility", "hidden");

    $('#mensaje-success').hide();
    $('#mensaje-error').hide();

    <?php 
        $msj = (isset($_GET['msj']))?$_GET['msj']:"";
        if( $msj == 'pedido_confirmado'){ 
    ?>
        $('#mensaje-success').html('<i class="fa fa-check"></i>Recepción confirmada.');
        $('#mensaje-success').show();
    <?php } ?>


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

    function confirmar(pk_detallePedido){
         $('#PK_DetallePedido').val(pk_detallePedido);
     }

    $('#btnAceptar').click(function(e){
        e.preventDefault();
        
        $('#form-confirmar').submit();
    })


</script>

<?php require ('footer.php') ?>
</body>
</html>