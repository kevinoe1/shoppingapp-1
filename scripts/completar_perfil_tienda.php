<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include ("../global/config.php");
include ("../global/conexion.php");
session_start();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $correoPaypal = (isset($_POST['input_correoPaypal'])) ? $_POST['input_correoPaypal'] : "";
        $adomicilio = (isset($_POST['input_adomicilio'])) ? $_POST['input_adomicilio'] : "";
        $logo = (isset($_FILES['input_logo'])) ? $_FILES['input_logo'] : "";
        $portada = (isset($_FILES['input_portada'])) ? $_FILES['input_portada'] : "";
        
        print_r($_POST);
        print_r($_FILES);
        
        // boton
        $action = (isset($_POST['action'])) ? $_POST['action'] : "";
       
        switch($action){
            case "completar":

                $buscar_tienda = $pdo->prepare("SELECT * FROM Tiendas WHERE FK_Usuario = :FK_Usuario");
                $buscar_tienda->bindParam(':FK_Usuario', $_SESSION['login_user']);
                $buscar_tienda->execute();
                $tienda = $buscar_tienda->fetchAll(PDO::FETCH_ASSOC);
               
                // echo "<script>alert('".$cliente."')</script>";
                

                // actualizar logo
                if($logo != ""){
                    // echo "<script>alert('".$imagen."')</script>";
                    // Codigo para subir la imagen
                  
                    $nombre_archivo = ($logo!="")?"tienda_".$_SESSION['login_user']."_logo.jpg":"";
                    $tmp_foto = $_FILES['input_logo']['tmp_name'];

            
                    if ($_FILES["input_logo"]["size"] > 1000000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }elseif($tmp_foto != ""){
                        if(file_exists ('../uploads/img/logos/'.$nombre_archivo)){
                            unlink('../uploads/img/logos/'.$nombre_archivo);
                        }
                    move_uploaded_file($tmp_foto, '../uploads/img/logos/'.$nombre_archivo); 
                    }

                    // actualizar foto de perfil del usuario
                    $actualizar_usuario = $pdo->prepare("UPDATE `Usuarios` SET `Foto` = :Foto 
                                                        WHERE `Usuarios`.`PK_Usuario` = :PK_Usuario;");
                    $actualizar_usuario->bindParam(':Foto', $nombre_archivo); 
                    $actualizar_usuario->bindParam(':PK_Usuario', $_SESSION['login_user']); 

                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    try{
                        $actualizar_usuario->execute();
                    }catch(PDOException $e){
                        echo $e->getMessage();
                    }

                    // actualizar logo de la tienda
                    $actualizar_usuario = $pdo->prepare("UPDATE `Tiendas` SET `Logo` = :Logo 
                                                        WHERE `Tiendas`.`FK_Usuario` = :FK_Usuario;");
                    $actualizar_usuario->bindParam(':Logo', $nombre_archivo); 
                    $actualizar_usuario->bindParam(':FK_Usuario', $_SESSION['login_user']); 

                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    try{
                        $actualizar_usuario->execute();
                    }catch(PDOException $e){
                        echo $e->getMessage();
                    }
                }

                // actualizar portada
                if($portada != ""){
                    // echo "<script>alert('".$imagen."')</script>";
                    // Codigo para subir la imagen
                  
                    $nombre_archivo = ($portada!="")?"tienda_".$_SESSION['login_user']."_portada.jpg":"";
                    $tmp_foto = $_FILES['input_portada']['tmp_name'];

            
                    if ($_FILES["input_portada"]["size"] > 1000000) {
                        echo "Sorry, your file is too large.";
                        $uploadOk = 0;
                    }elseif($tmp_foto != ""){
                        if(file_exists ('../uploads/img/portadas/'.$nombre_archivo)){
                            unlink('../uploads/img/portadas/'.$nombre_archivo);
                        }
                    move_uploaded_file($tmp_foto, '../uploads/img/portadas/'.$nombre_archivo); 
                    }

                     // actualizar logo de la tienda
                     $actualizar_usuario = $pdo->prepare("UPDATE `Tiendas` SET `Portada` = :Portada 
                                                          WHERE `Tiendas`.`FK_Usuario` = :FK_Usuario;");
                    $actualizar_usuario->bindParam(':Portada', $nombre_archivo); 
                    $actualizar_usuario->bindParam(':FK_Usuario', $_SESSION['login_user']); 

                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    try{
                        $actualizar_usuario->execute();
                    }catch(PDOException $e){
                        echo $e->getMessage();
                    }                   
                }
               

                // actualizar cliente
                $actualizar_tienda = $pdo->prepare("UPDATE `Tiendas` SET `CorreoPaypal` = :CorreoPaypal, `Adomicilio` = :Adomicilio
                                                   WHERE `Tiendas`.`PK_Tienda` = :PK_Tienda AND `Tiendas`.`FK_Usuario` = :FK_Usuario;");
    
                $actualizar_tienda->bindParam(':CorreoPaypal', $correoPaypal);
                $actualizar_tienda->bindParam(':Adomicilio', $adomicilio);
                $actualizar_tienda->bindParam(':PK_Tienda', $tienda[0]['PK_Tienda']);
                $actualizar_tienda->bindParam(':FK_Usuario', $tienda[0]['FK_Usuario']);

                

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                try{
                    $actualizar_tienda->execute();
                    header('location: ../templates/home.php');
                }catch(PDOException $e){
                    echo $e->getMessage();
                }
               
    
            break;
        }
    
       
    }
?>