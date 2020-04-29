<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "../global/config.php";
include "../global/conexion.php";

$request = $_POST['request']; 

switch($request){
	case "selectCiudades":
		selectCiudades(); 
	break;
	case "verificarUsuario":
		verificarUsuario();
	break;
	case "verificarCorreo":
		verificarCorreo();
	break;
	case "verificarLogin":
		verificarLogin();
	break;
	case "obtenerNombreDestinatario":
		obtenerNombreDestinatario();
	break;
}
	function selectCiudades(){
		global $pdo;

		$fk_pais=$_POST['FK_Pais'];

		$select_ciudades = $pdo->prepare("SELECT * FROM Ciudades WHERE FK_Pais = :fk_pais");
		$select_ciudades->bindparam(":fk_pais", $fk_pais);
		
		$select_ciudades->execute();
		$listaCiudades = $select_ciudades->fetchAll(PDO::FETCH_ASSOC);
	
		$cadena="<select id='inputCiudad' name='input_ciudad' class='form-control'>
				<option selected>- Seleccione -</option>";
	
		foreach ($listaCiudades as $ciudad) {
			$cadena=$cadena.'<option value='.$ciudad['PK_Ciudad'].'>'.utf8_encode($ciudad['NombreCiudad']).'</option>';
		}
	
		echo  $cadena."</select>";
	}

	function verificarUsuario(){
		global $pdo;
		// comprobar que el usuario no existe
        $buscar_usuario = $pdo->prepare("SELECT * FROM Usuarios WHERE NombreUsuario = :nombreUsuario");
        $buscar_usuario->bindParam(':nombreUsuario', $_POST['NombreUsuario']);
        $buscar_usuario->execute();
        $cuenta_usuario = $buscar_usuario->rowCount();

        if ($cuenta_usuario > 0){
            echo 1;
        }else{
			echo 0;
		}
	}

	function verificarLogin(){
		global $pdo;
		// comprobar que el usuario no existe
        $buscar_usuario = $pdo->prepare("SELECT * FROM Usuarios WHERE NombreUsuario = :nombreUsuario and Contrasena = :Contrasena ");
		$buscar_usuario->bindParam(':nombreUsuario', $_POST['NombreUsuario']);
		$buscar_usuario->bindParam(':Contrasena', $_POST['Contrasena']);
        $buscar_usuario->execute();
        $cuenta_usuario = $buscar_usuario->rowCount();

        if ($cuenta_usuario > 0){
            echo 1;
        }else{
			echo 0;
		}

		
	}

	
	function verificarCorreo(){
		global $pdo;

		// comprobar que el correo no existe
		$buscar_correo = $pdo->prepare("SELECT * FROM Usuarios WHERE Correo = :correo");
		$buscar_correo->bindParam(':correo', $_POST['Correo']);
		$buscar_correo->execute();
		$cuenta_correo = $buscar_correo->rowCount();

		if ($cuenta_correo > 0){
            echo 1;
        }else{
			echo 0;
		}
	}

	function obtenerNombreDestinatario(){
		global $pdo;

		// comprobar que el correo no existe
		$buscar_destinatario = $pdo->prepare("SELECT * 
										FROM Destinatarios 
										WHERE PK_Destinatario = :PK_Destinatario");
		$buscar_destinatario->bindParam(':PK_Destinatario', $_POST['PK_Destinatario']);
		$buscar_destinatario->execute();
		$destinatario = $buscar_destinatario->fetchAll(PDO::FETCH_ASSOC);

		echo $destinatario[0]['NombresDestinatario']."  ".$destinatario[0]['ApellidosDestinatario'];
	}
            



	

?>