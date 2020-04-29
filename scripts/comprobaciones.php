<?php 
$perfil_completo = "";
$tipo_usuario = "";



if (isset($_SESSION['login_user'])){ //Comprobar si ha iniciado sesión

    global $perfil_completo;
    global $tipo_usuario;

    $consulta_tipo_usuario = $pdo->prepare("SELECT * FROM Usuarios
                                            WHERE PK_Usuario = :PK_Usuario;");
    $consulta_tipo_usuario->bindParam(':PK_Usuario', $_SESSION['login_user']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $consulta_tipo_usuario->execute();
    $usuario = $consulta_tipo_usuario->fetchAll(PDO::FETCH_ASSOC);
   


    if($usuario[0]['FK_TipoUsuario'] == 1){

        // consultar si el cliente ha completado su peril    
        $buscar_perfil = $pdo->prepare("SELECT PrimerNombre FROM Clientes
                                            WHERE FK_Usuario = :FK_Usuario;");

        $buscar_perfil->bindParam(':FK_Usuario', $_SESSION['login_user']);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $buscar_perfil->execute();
        $estado_perfil = $buscar_perfil->fetchAll(PDO::FETCH_ASSOC);

        // comprobar si el perfil esta completo
        if($estado_perfil[0]['PrimerNombre'] == ""){
            $perfil_completo = 0;
        }else{
            $perfil_completo = 1;
        }

    }elseif($usuario[0]['FK_TipoUsuario'] == 2){

        // consultar si la tienda ha completado su peril    
        $buscar_perfil = $pdo->prepare("SELECT CorreoPaypal FROM Tiendas
                                        WHERE FK_Usuario = :FK_Usuario;");

        $buscar_perfil->bindParam(':FK_Usuario', $_SESSION['login_user']);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $buscar_perfil->execute();
        $estado_perfil = $buscar_perfil->fetchAll(PDO::FETCH_ASSOC);

        // comprobar si el perfil esta completo
        if($estado_perfil[0]['CorreoPaypal'] == ""){
            $perfil_completo = 0;
        }else{
            $perfil_completo = 1;
        }

    }
    

    

    // print_r($estado_perfil);

    // asignar tipo de usuario 
    $tipo_usuario = $usuario[0]['FK_TipoUsuario'];

    // header('Location: ./home.php');
    if($perfil_completo == 0 && $tipo_usuario == 1){
        $_SESSION['perfil_incompleto'] = 1; 
        header('Location: completar_perfil_cliente.php');
        
    }elseif ($perfil_completo == 0 && $tipo_usuario == 2){
        $_SESSION['perfil_incompleto'] = 1; 
        header('Location: completar_perfil_tienda.php');
        
    }
    
}else{
    header('Location: login.php');
    // header('Location: completar_perfil_tienda.php');
}
?>