<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include ("../global/config.php");
include ("../global/conexion.php");



?>

<style>
    body{
        /* background: -webkit-linear-gradient(left, #e67e3d, #d45303);  */
        background-image: url('../static/img/mujer_compras.jpg');
        background-size: cover;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro de usuario</title>

    <!-- Imports -->
    <link href="../static/css/register.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../static/css/styles.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="../static/css/toasts.css" rel="stylesheet" type="text/css" media="all" />
    <script src="../static/js/jquery-3.5.0.min.js" ></script>
    <script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <!-- fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
<div role="alert" data-delay="5000" aria-live="assertive" aria-atomic="true" id="toast_mensaje" class="toast" data-autohide="true">
        
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        <div class="toast-body">
            
        </div>
        
</div> 
<!-- primer nav -->
<nav class="navbar navbar-expand-lg navbar-light ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="row collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="row col-md-12 navbar-nav ml-auto mt-2 mt-lg-0">
    <li class=" col-md-2 nav-item">
        <a id="a_logo" href="../index.php"><img id="logo" src="../static/img/Logo_shoppingapp_v2.png" alt="Logo Shoppingapp"></a>
      </li>
      <li class="offset-md-6 col-md-2 nav-item">
        <a class="nav-link border-right" href="#"><i class="fas fa-phone mr-2"></i>2781 0000</a>
			</li>
			<li class="col-md-2 nav-item">
        <a class="nav-link border-right" href="./login.php"><i class="fas fa-sign-in-alt mr-2"></i>Log In</a>
			</li>
		</ul>
  </div>
</nav>
<!-- // primer nav -->   
 
<div id="back row">
    <div id="cont-register" class="offset-md-3 col-md-6">
    <h2 class="text-center">Registro de usuarios</h2>
    <p>SI QUIERES REGISTRAR UNA TIENDA, HAZ CLIC AQUÍ:  <a href="./registro_tienda.php">Registro de tiendas</a> </p>
    <div class="alert alert-danger" id="mensaje_alert" class="alert-dismissible fade show"></div>
   
    <form lang="en" action="../scripts/registro_usuario.php" method="post" id="form_register">
        <div class="form-group">
                <label for="inputUsername">Nombre de usuario <span class="text_required">*</span> </label>
                <input type="text" class="form-control" name="input_username" id="inputUsername" placeholder="">
            </div>
            <div class="form-group">
                <label for="inputEmail">Correo <span class="text_required">*</span> </label>
                <input  type="text" class="form-control" name="input_email" id="inputEmail" placeholder="">
            </div>
            <div class="form-group">
                <label for="inputPassword4">Contraseña <span class="text_required">*</span> </label>
                <input  autocomplete="new-password" type="password" class="form-control" name="input_password" id="inputPassword" placeholder="">
            </div>
            <div class="form-group">
                <label for="inputSamePassword">Misma contraseña <span class="text_required">*</span> </label>
                <input  autocomplete="new-password" type="password" class="form-control" name="input_samePassword" id="inputSamePassword" placeholder="">
            </div>
        <br>
        <br>
        <input type="text" hidden name="action" value="register">
        <button type="submit" class="btn-flat col-md-8 offset-md-2">Registrarse</button>
    </form>

    </div>
</div>
    

</body>
</html>

<script type="text/javascript">
//  $("#mensaje_alert").css("visibility", "hidden");

        

	$(document).ready(function(){
		$('#inputCountry').change(function(){
		    recargarListaCiudad();
		});

       
        // validaciones para el formulario de registro
        $('#form_register').on('submit', function (event) {
            event.preventDefault();

            // consultar existencia de usuario
            var existe_usuario;
            $.ajax({
                    type:"POST",
                    async: false,
                    url:"../scripts/datos_ajax.php",
                    data: {"request" : "verificarUsuario", 
                            "NombreUsuario" : $('#inputUsername').val()},
                    success:function(r){
                        existe_usuario = r;
                    }
            });

            // consultar existencia de correo
            var existe_correo;
            $.ajax({
                    type:"POST",
                    async: false,
                    url:"../scripts/datos_ajax.php",
                    data: {"request" : "verificarCorreo", 
                            "Correo" : $('#inputEmail').val()},
                    success:function(r){
                        existe_correo = r;
                    }
            });

            
            $validate_mail = emailIsValid($('#inputEmail').val());
        
             if( $('#inputUsername').val() == '' || $('#inputEmail').val() == '' || $('#inputPassword').val() == '' || $('#inputSamePassword').val() == ''){
                 toast("Faltan uno o más campos.");
            }else if(existe_usuario == 1){
                toast("Ya existe ese nombre de usuario");
             }else if($validate_mail == false){
                toast("Debe ingresar una dirección de correo electrónico válida");
             }else if(existe_correo == 1){
                toast("Ya existe una cuenta con esa dirección de correo electrónico");
             }else if($('#inputPassword').val() != $('#inputSamePassword').val()){
                toast("Las contraseñas no coinciden");
             }else{
                $('#form_register').unbind('submit').submit();
             }
             
		});


        // function toast(msj){
        //     $("#mensaje_alert").css("visibility", "visible");
        //     $("#mensaje_alert").html(msj);
        // }

        // function ocultarMensaje(){
        //     $('.form-control').keypress(function(){
        //         $("#mensaje_alert").css("visibility", "hidden");
        //         $("#mensaje_alert").html("");
        //     });
        // }

        // $('#inputCountry').change(function(){
        //         $("#mensaje_alert").css("visibility", "hidden");
        //         $("#mensaje_alert").html("");
        // }) 
        // $('#inputCity').change(function(){
        //         $("#mensaje_alert").css("visibility", "hidden");
        //         $("#mensaje_alert").html("");
        // }) 

        function emailIsValid(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
        }
        
	})

	function recargarListaCiudad(){
		$.ajax({
			type:"POST",
			url:"../scripts/datos_ajax.php",
            data: {"request" : "selectCiudades", 
                    "FK_Pais" : $('#inputCountry').val()},
			success:function(r){
                //console.log(r);
				$('#cont_cbo_ciudad').html(r);
			}
		});
	}

    function toast(msj){
            $('.toast-body').html(msj);
            $('#toast_mensaje').toast('show');
    }
</script>


