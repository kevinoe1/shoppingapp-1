<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include ("../global/config.php");
include ("../global/conexion.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    global $form;
    
    // accion del registro
    $action = (isset($_POST['action'])) ? $_POST['action'] : "";

    switch($action){
        case "registrar_categoria":
            // variables categoria

            // print_r($_POST);

            $nombreCategoria = (isset($_POST['input_nombreCategoria'])) ? $_POST['input_nombreCategoria'] : "";
            $descripcionCategoria = (isset($_POST['input_descripcion'])) ? $_POST['input_descripcion'] : "";
            $imagen = (isset($_FILES['input_imagen']['name'])) ? $_FILES['input_imagen']['name'] : "";
            $estado = (isset($_POST['input_estado'])) ? $_POST['input_estado'] : "";


            // Codigo para subir la imagen
            $fecha = new DateTime();
            $nombre_archivo = ($imagen!="")?$nombreCategoria."_".$fecha->getTimestamp()."_".$_FILES['input_imagen']['name']:"";
            $tmp_foto = $_FILES['input_imagen']['tmp_name'];

    
            if ($_FILES["input_imagen"]["size"] > 1000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }elseif($tmp_foto != ""){
                move_uploaded_file($tmp_foto, '../uploads/img/categorias/'.$nombre_archivo);
            }


           
            $insert_categoria = $pdo->prepare("INSERT INTO Categorias(PK_Categoria, NombreCategoria, Descripcion, Imagen, Estado) 
                                                                VALUES (NULL, :NombreCategoria, :Descripcion, :Imagen, :Estado)");

            $insert_categoria->bindParam(':NombreCategoria', $nombreCategoria);
            $insert_categoria->bindParam(':Descripcion', $descripcionCategoria);
            $insert_categoria->bindParam(':Imagen', $nombre_archivo);
            $insert_categoria->bindParam(':Estado', $estado);

            try{
                
                $insert_categoria->execute();
                header('location: ../templates/registro_datos.php?menu=registro_categoria');
            }catch(PDOException $e){
                echo "Error ". $e->getMessage() . $e->errorInfo();
                header('location: ../templates/registro_datos.php?menu=registro_categoria');
            }

        break;
    }

}
?>