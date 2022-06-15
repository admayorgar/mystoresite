<?php
//ENCRIPTACION
define("KEY", "adsi");
define("COD", "AES-128-ECB");

//CONEXION A LA BASE DE DATOS

$host="localhost";
$db="mystoresite";
$usuario="root";
$contrasenia="";

try {
    $conexion=new PDO("mysql:host=$host; dbname=$db", $usuario, $contrasenia);
} catch (Exception $ex) {
    echo $ex->getMessage();
}



