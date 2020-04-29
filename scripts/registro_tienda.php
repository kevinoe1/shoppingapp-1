<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include ("../global/config.php");
include ("../global/conexion.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $nombreTienda = (isset($_POST['input_nombreTienda'])) ? $_POST['input_nombreTienda'] : "";
        $nombreContacto = (isset($_POST['input_nombreContacto'])) ? $_POST['input_nombreContacto'] : "";
        $apellidoContacto = (isset($_POST['input_apellidoContacto'])) ? $_POST['input_apellidoContacto'] : "";
        $webSite = (isset($_POST['input_website'])) ? $_POST['input_website'] : "";
        $nombreUsuario = (isset($_POST['input_correo'])) ? $_POST['input_correo'] : "";
        $correo = (isset($_POST['input_correo'])) ? $_POST['input_correo'] : "";
        $contrasena = (isset($_POST['input_contrasena'])) ? $_POST['input_contrasena'] : "";
        $telefono = (isset($_POST['input_telefono'])) ? $_POST['input_telefono'] : "";
        $direccion1 = (isset($_POST['input_direccion1'])) ? $_POST['input_direccion1'] : "";
        $direccion2 = (isset($_POST['input_direccion2'])) ? $_POST['input_direccion2'] : "";
        $pais = (isset($_POST['input_pais'])) ? $_POST['input_pais'] : "";
        $ciudad = (isset($_POST['input_ciudad'])) ? $_POST['input_ciudad'] : "";
    
       
        // boton
        $action = (isset($_POST['action'])) ? $_POST['action'] : "";
       
        // FALTA
        $estado = 1;
        $tipoUsuario = 2;
        $idioma = 1;
        $foto = "";

        switch($action){
            case "register":
            
                $insert_usuario = $pdo->prepare("INSERT INTO Usuarios(NombreUsuario, Contrasena, Correo, Estado, FK_TipoUsuario, FK_Idioma, Foto)
                                                        VALUES(:NombreUsuario, :Contrasena, :Correo, :Estado, :FK_TipoUsuario, :FK_Idioma, :Foto)");
    
                $insert_usuario->bindParam(':NombreUsuario', $nombreUsuario);
                $insert_usuario->bindParam(':Contrasena', $contrasena);
                $insert_usuario->bindParam(':Correo', $correo);
                $insert_usuario->bindParam(':Estado', $estado);
                $insert_usuario->bindParam(':FK_TipoUsuario', $tipoUsuario);
                $insert_usuario->bindParam(':FK_Idioma', $idioma);
                $insert_usuario->bindParam(':Foto', $foto);
                
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                try{
                    // print_r($crear_usuario);
                    $insert_usuario->execute();
                    header('location: ../templates/login.php');
                }catch(PDOException $e){
                    echo $e->getMessage();
                    header('location: ../templates/login.php');
                }
               
                $buscar_usuario = $pdo->prepare("SELECT PK_Usuario FROM Usuarios WHERE NombreUsuario = :nombreUsuario");
                $buscar_usuario->bindParam(':nombreUsuario', $nombreUsuario);
                $buscar_usuario->execute();
                $usuario_creado = $buscar_usuario->fetchAll(PDO::FETCH_ASSOC);
                
                $correoPaypal = "";
                $logo = "";
                $adomicilio = 0;
                $portada = "";

                //Insertar Tienda
                $insert_tienda = $pdo->prepare("INSERT INTO `Tiendas` (`PK_Tienda`, `NombreTienda`, `NombreContacto`, `ApellidoContacto`, `Direccion1`, `Direccion2`, `SitioWeb`, `Correo`, `CorreoPaypal`, `Logo`, `Adomicilio`, `FK_Ciudad`, `FK_Usuario`, `Telefono`, `Portada`) 
                                                                 VALUES (NULL, :NombreTienda, :NombreContacto, :ApellidoContacto, :Direccion1, :Direccion2, :SitioWeb, :Correo, :CorreoPaypal, :Logo, :Adomicilio, :FK_Ciudad, :FK_Usuario, :Telefono, :Portada)");
                $insert_tienda->bindParam(':NombreTienda', $nombreTienda);
                $insert_tienda->bindParam(':NombreContacto', $nombreContacto);
                $insert_tienda->bindParam(':ApellidoContacto', $apellidoContacto);
                $insert_tienda->bindParam(':Direccion1', $direccion1);
                $insert_tienda->bindParam(':Direccion2', $direccion2);
                $insert_tienda->bindParam(':SitioWeb', $webSite);
                $insert_tienda->bindParam(':Correo', $correo);
                $insert_tienda->bindParam(':CorreoPaypal', $correoPaypal);
                $insert_tienda->bindParam(':Logo', $logo);
                $insert_tienda->bindParam(':Adomicilio', $adomicilio);
                $insert_tienda->bindParam(':FK_Ciudad', $ciudad);
                $insert_tienda->bindParam(':FK_Usuario', $usuario_creado[0]['PK_Usuario']);
                $insert_tienda->bindParam(':Telefono', $telefono);
                $insert_tienda->bindParam(':Portada', $portada);

                
                
                try{
                    $insert_tienda->execute();
                    header('location: ../templates/login_tienda.php');
                }catch(PDOException $e){
                    header('location: ../templates/login_tienda.php');
                    echo "Error ". $e->getMessage() . $e->errorInfo();
                }
    
            break;
        }
    
       
    }
?>