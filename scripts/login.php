<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include ("../global/conexion.php");

$firstName = (isset($_POST['input_fisrtName'])) ? $_POST['input_fisrtName'] : "";
$middleName = (isset($_POST['input_middleName'])) ? $_POST['input_middleName'] : "";
$firstSurname = (isset($_POST['input_fisrtSurname'])) ? $_POST['input_fisrtSurname'] : "";
$secondSurname = (isset($_POST['input_secondSurname'])) ? $_POST['input_secondSurname'] : "";
$email = (isset($_POST['input_email'])) ? $_POST['input_email'] : "";
$password = (isset($_POST['input_password'])) ? $_POST['input_password'] : "";
$telephone = (isset($_POST['input_telephone'])) ? $_POST['input_telephone'] : "";
$address = (isset($_POST['input_address'])) ? $_POST['input_address'] : "";
$cuntry = (isset($_POST['input_country'])) ? $_POST['input_country'] : "";
$city = (isset($_POST['input_city'])) ? $_POST['input_city'] : "";

// print_r($_POST);

$sentencia = $pdo->prepare("SELECT * FROM Paises");
$sentencia->execute();
$listaPaises = $sentencia->fetchAll(PDO::FETCH_ASSOC);

print_r($listaPaises);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="../static/css/login.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


	<script src="https://kit.fontawesome.com/b2dbb6a24d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Roboto&display=swap" rel="stylesheet">
</head>
<body >
    
<div id="back row">
    <div id="cont-register" class="offset-md-2 col-md-8">
    <h2 class="text-center">Registro</h2>
    <br>
    <br>
    <form action="" method="post" >
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputEmail4">Fisrt name</label>
            <input type="text" class="form-control" name="input_fisrtName" id="inputFisrtName" placeholder="">
            </div>
            <div class="form-group col-md-6">
            <label for="inputPassword4">Middle name</label>
            <input type="text" class="form-control" name="input_middleName" id="inputLastName" placeholder="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputEmail4">Fisrt surname</label>
            <input type="text" class="form-control" name="input_fisrtSurname" id="inputFisrtName" placeholder="">
            </div>
            <div class="form-group col-md-6">
            <label for="inputPassword4">Second surname</label>
            <input type="text" class="form-control" name="input_secondSurname"  id="inputLastName" placeholder="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" name="input_email" id="inputEmail4" placeholder="">
            </div>
            <div class="form-group col-md-6">
            <label for="inputPassword4">Password</label>
            <input type="password" class="form-control" name="input_password" id="inputPassword4" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputAddress">Telephone</label>
            <input type="phone" class="form-control" name="input_telephone" id="inputTelephone" placeholder="">
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" name="input_address" id="inputAddress" placeholder="">
        </div>
        <!-- <div class="form-group">
            <label for="inputAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
        </div> -->
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputCountry">Country</label>
            <select id="inputCountry" name="input_country" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
            </div>
            <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <select id="inputCity" name="input_city" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
            </select>
            </div>
            <!-- <div class="form-group col-md-2">
            <label for="inputZip">Zip</label>
            <input type="text" class="form-control" id="inputZip">
            </div> -->
        </div>
        <br>
        <br>
        <button type="submit" class="btn-flat col-md-8 offset-md-2">Sign in</button>
    </form>

    </div>
</div>
    

</body>
</html>



