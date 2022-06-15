<?php
    session_start();
    if(!isset($_SESSION['usuario'])) {
        header("Location:index.php");
    }else{
        if($_SESSION['usuario']=="Administrador"){
            $nombreUsuario=$_SESSION['nombreUsuario'];
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <title>My STORE Site | MANAGER</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

    <?php $url="http://".$_SERVER['HTTP_HOST']."/mystoresite"?>

    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="nav navbar-nav">
            <a class="nav-item nav-link active" href="<?php echo $url;?>/admin/inicio.php">My STORE Site | MANAGER<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="<?php echo $url;?>">Catálogo Digital</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/admin/seccion/productos.php">Productos</a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/admin/seccion/misVentas.php">Ventas | Pedidos </a>
            <a class="nav-item nav-link" href="<?php echo $url;?>/admin/seccion/cerrar.php">Cerrar Sesión</a>
        </div>
    </nav>

    <div class="container">
        <br><br>
        <div class="row">
            