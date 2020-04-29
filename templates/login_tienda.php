<?php


session_start();

$sesion = (isset($_POST['sesion']))?$_POST['sesion']:"";


if ($sesion = "cerrar"){
    session_destroy();
}else{
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login shop</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="../static/css/styles.css" rel="stylesheet" type="text/css" media="all" />

	<script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../static/js/jquery-3.5.0.min.js" ></script>
 
    <link href="../static/css/login.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
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
        <a class="nav-link" href="./registro_usuario.php"><i class="fas fa-sign-out-alt mr-2"></i>Registrarse</a>
      </li>
		</ul>
  </div>
</nav>
<!-- // primer nav -->  


<div id="row">
    <div id="cont-login" class="offset-md-4 col-md-4">
    <h2 class="text-center">Login</h2>
    <div class="alert alert-danger" id="mensaje_alert" class="alert-dismissible fade show"></div>
    <br>
    <form lang="en" action="../scripts/login.php" method="post" id="form_login">
        
            <div class="form-group col-md-12">
                <label for="inputUsername">Email <span class="text_required">*</span> </label>
                <input type="text" class="form-control" name="input_username" id="inputUsername" placeholder="">
            </div>
            <div class="form-group col-md-12">
                <label for="inputPassword4">Password <span class="text_required">*</span> </label>
                <input  autocomplete="new-password" type="password" class="form-control" name="input_password" id="inputPassword" placeholder="">
            </div>
     
        <br>
        <br>
        <input type="text" hidden name="action" value="login">
        <button type="submit" class="btn-flat col-md-12">Login</button>
        <br>
        <br>
        <p  class="text-center"><a href="./login.php">Login for customers</a> </p>
    </form>

    </div>
</div>

</body>
</html>

<script type="text/javascript">
  

	$(document).ready(function(){
		$('#inputCountry').change(function(){
		    recargarListaCiudad();
		});

       
        // validaciones para el formulario de registro
        $('#form_login').on('submit', function (event) {
            event.preventDefault();
            
            // Verificar usuario
            var verificar_usuario;
            $.ajax({
                    type:"POST",
                    async: false,
                    url:"../scripts/datos_ajax.php",
                    data: {"request" : "verificarLogin", 
                            "Contrasena" : $('#inputPassword').val(),
                            "NombreUsuario" : $('#inputUsername').val()},
                    success:function(r){
                        verificar_usuario = r;
                    }
            });
            
            $validate_mail = emailIsValid($('#inputEmail').val());
        
             if($('#inputUsername').val() == '' || $('#inputPassword').val() == '' ){
                 mostrarMensaje("One or more required field(s) are missing.");
                 ocultarMensaje();
            }else if(verificar_usuario == 0){
                mostrarMensaje("Invalid username or password.");
                ocultarMensaje();
             }else{
                $('#form_login').unbind('submit').submit();
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

        $('#inputCountry').change(function(){
                $("#mensaje_alert").css("visibility", "hidden");
                $("#mensaje_alert").html("");
        }) 
        $('#inputCity').change(function(){
                $("#mensaje_alert").css("visibility", "hidden");
                $("#mensaje_alert").html("");
        }) 

        function emailIsValid(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
        }
        
	})


</script>