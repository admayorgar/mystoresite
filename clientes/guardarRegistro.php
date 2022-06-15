<?php

include "../admin/config/db.php";


//recepcionar datos del form de registro

$Cedula = $_POST['Cedula'];
$NombreUsu = $_POST['Nombre'];
$ApellidoUsu = $_POST['Apellido'];
$CorreoUsu = $_POST['Correo'];
$PassUsu = $_POST['Contrasenia'];
$TelefonoUsu = $_POST['Telefono'];

$regUsu = $conexion->prepare("INSERT INTO usuario (Cedula, Nombre, Apellido, Correo, Contraseña, Telefono) VALUES (:Cedula, :Nombre, :Apellido, :Correo, :Contrasenia, :Telefono)");

$regUsu->bindParam(':Cedula', $Cedula);
$regUsu->bindParam(':Nombre', $NombreUsu);
$regUsu->bindParam(':Apellido', $ApellidoUsu);
$regUsu->bindParam(':Correo', $CorreoUsu);
$regUsu->bindParam(':Contrasenia', $PassUsu);
$regUsu->bindParam(':Telefono', $TelefonoUsu);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bienvenido</title>
    <link rel="stylesheet" href="/css/estilos.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/fontawesome/css/all.css ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand nav-link active" href="../index.php"> - My STORE Site - </a>
    </div>
    </div>
</nav>
<!--FIN HEADER-->
<div class="container-fluid registro">
    <div class="col-md-12  ">
        <img src="../img/index_img/checkmark-png-5.png">
        <div class="jumbotron ">
            <?php
            if($regUsu->execute()){ ?>
                <h2 class="display-3"> ¡Registro Exitoso! </h2>
                <p class="lead">Ya puedes iniciar sesión </p>
                <hr class="my-2">
                <p></p><br>
                <div class="contenido-interno d-flex align-items-center justify-content-center  ">
                    <form method="" action="login.php">
                        <input type="submit" name="action" class="btn btn-success btn-sm " value=" CLICK AQUÍ "/>
                    </form><br>
                </div>
            <?php }else{ ?>
                <h2 class="display-3"> Oops..! Error. </h2>
                <p class="lead">Intenta Nuevamente.</p>
                <hr class="my-2">
                <p></p>
            <?php }?>
        </div>
    </div>
</div>
<div class= "container-fluid bg-fondo">
    <div class="col-md-12 ">
    </div>
</div>
<div class= "container-fluid bg-fondo">
    <div class="col-md-12 ">
    </div>
</div> <br>


<div class="container-fluid content-row ">
    <br><p class="text-center">© 2022 - My . S T O R E . Site - Andrea Mayorga. Todos los Derechos Reservados.</p>
</div>


</body>
</html>

