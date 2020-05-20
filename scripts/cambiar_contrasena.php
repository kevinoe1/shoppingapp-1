<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include ("../global/config.php");
include ("../global/conexion.php");
include ("../global/const.php");

session_start();

$codigo = (isset($_REQUEST['codigo']))?$_REQUEST['codigo']:"";
$m = (isset($_REQUEST['m']))?$_REQUEST['m']:"";

// accion del registro
$accion = (isset($_POST['accion'])) ? $_POST['accion'] : "";

if($codigo != '' && $m != ''){
    $select_usuario = $pdo->prepare('SELECT * FROM Usuarios
                                    WHERE NombreUsuario = :UsuarioCorreo OR Correo = :UsuarioCorreo');

    $select_usuario->bindParam(':UsuarioCorreo', $m);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $select_usuario->execute();
    $usuario = $select_usuario->fetchAll(PDO::FETCH_ASSOC);

    if($usuario[0]['CodRestContrasena'] == $codigo){
        echo '
        <form id="form-post" action="../Cambiar_Cont" method="post">
            <input type="hidden" name="accion" value="rest">
            <input type="hidden" name="usuario" value="'. $usuario[0]['PK_Usuario'] .'">
        </form>
        <script src="'. URL_SITIO .'static/js/jquery-3.5.0.min.js" ></script>
        <script>
        $("#form-post").submit();
        </script>
        ';
    }
}



switch($accion){
    case "camb":
        $usuario_correo = (isset($_POST['input_usuarioCorreo'])) ? $_POST['input_usuarioCorreo'] : "";

        $select_usuario = $pdo->prepare('SELECT * FROM Usuarios
                                            WHERE NombreUsuario = :UsuarioCorreo OR Correo = :UsuarioCorreo');

        $select_usuario->bindParam(':UsuarioCorreo', $usuario_correo);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $select_usuario->execute();
        $usuario = $select_usuario->fetchAll(PDO::FETCH_ASSOC);

        $codigo_confirmacion = 'U'. $usuario[0]['PK_Usuario'] .'C' . DATE('His') .'d'. DATE('Ymd');

        $insertar_codigo = $pdo->prepare('UPDATE Usuarios
                                            SET CodRestContrasena = :Codigo
                                            WHERE NombreUsuario = :UsuarioCorreo OR Correo = :UsuarioCorreo');

        $insertar_codigo->bindParam(':Codigo', $codigo_confirmacion);
        $insertar_codigo->bindParam(':UsuarioCorreo', $usuario_correo);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $insertar_codigo->execute();

        
        $body_html = '

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
        
        <style>
            .logo{
                width: 50%;
            }
        
            .container{
                text-align: center;
            }
        
            .text-center{
                text-align: center;
            }
        
            
            .cont-logo{
                text-align: center;
                width: 100%;
            }
        
            .titulo{
                color: gray;
                font-family: "Lato", sans-serif;
            }
        
            .text-gray{
                color: gray;
            }
        
            .btn-primary{
                background-color: #E86713;
                border:0px;
                padding: 15px 35px 15px 35px;
                color: white!important;
                font-size: 20px;
                text-decoration:none;
            }
        
            .btn-primary:hover{
                background-color: #E86713;
                border:0px;
                padding: 15px 35px 15px 35px;
            }
        
            .cont-parrafo{
                width: 100%;
                text-align: center;
            }
        
            p{
                width: 80%;
                margin: auto;
            }
        
        
        </style>
        </head>
        <body>
            <div class="container">
                <br>
                <div class="col-md-12">
                    <div class="col-md-4 offset-md-4 cont-logo">
                    <div class="col-md-4 offset-md-4 cont-logo">
                        <img class="logo" src="data:image/png;base64,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" alt="">
                    </div>
                    </div>
                </div>
                <br>
                <h1 class="titulo text-center">Cambia tu contraseña</h1>
                <br>
                <br>
                <div class="cont-parrafo">
                <p class="text-gray  text-center">Se ha enviado este correo como peticion para el cambio de password.
                </p>
                </div>
                <br>
                <br>
                <p class="text-gray  text-center">
                    Para poder cambiar tu password haz clic aquí:
                </p>
                <br>
                <div class="col-md-12">
                        <a href="'. URL_SITIO .'scripts/cambiar_contrasena.php?accion=rest&codigo='.$codigo_confirmacion.'&m='.$usuario_correo.'" class="btn-primary">Cambiar password</a>
                    
                </div>
                <br>
                <br>
                <br>
            
            </div>
            
        </body>
        </html>';

        require("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
        require("../vendor/phpmailer/phpmailer/src/SMTP.php");

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port     = 587;  
        $mail->Username = "shoppingappworld@gmail.com";
        $mail->Password = "shoppingapp1234!";
        $mail->Host     = "smtp.gmail.com";
        $mail->Mailer   = "smtp";
        $mail->SetFrom("shoppingappworld@gmail.com", "Shoppingapp");
        $mail->AddAddress($usuario[0]['Correo']);
        $mail->Subject = "Cambiar password";
        $mail->WordWrap   = 80;
        $mail->MsgHTML($body_html);
        $mail->IsHTML(true);
        
        if(!$mail->Send()){
            echo "Problem sending email.";
        }else{ 
            echo "email sent.";
            header('location: ../Cambiar_Cont?accion=wait');
        } 
    break;
    case "rest":
        $nueva_contrasena = (isset($_POST['input_nuevaContrasena'])) ? $_POST['input_nuevaContrasena'] : "";

        $pk_usuario = (isset($_POST['pk_usuario'])) ? $_POST['pk_usuario'] : "";
        
        $actualizar_usuario = $pdo->prepare('UPDATE Usuarios
                                            SET Contrasena = :Contrasena
                                            WHERE PK_Usuario = :PK_Usuario');

        $actualizar_usuario->bindParam(':Contrasena', $nueva_contrasena);
        $actualizar_usuario->bindParam(':PK_Usuario', $pk_usuario);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $select_usuario = $pdo->prepare('SELECT * 
                                            FROM Usuarios
                                            WHERE PK_Usuario = :PK_Usuario');

        $select_usuario->bindParam(':PK_Usuario', $pk_usuario);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        if($actualizar_usuario->execute()){
            $select_usuario->execute();
            $usuario = $select_usuario->fetchAll(PDO::FETCH_ASSOC);
            if($usuario[0]['FK_TipoUsuario'] == 1){
                header('Location: ../Login?p=cf&u='.$usuario[0]['NombreUsuario']);
            }else{
                header('Location: ../Login-Tienda?p=cf&u='.$usuario[0]['Correo']);
            }
        }


    break;
    
}



?>