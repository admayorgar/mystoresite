<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Registrarme | My STORE Site </title>
    <link rel="stylesheet" href="./css/estilos.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./css/fontawesome/css/all.css ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand nav-link active" href=""> - My STORE Site - </a>
        <a class="btn btn-dark btn-sm btn-xs" href="../index.php"> VOLVER AL SITIO </a>

    </div>
    </div>
</nav>
<!--FIN HEADER-->
<div>

</div>
<br>
<div class="row alert-info">

</div>

<!-- REGISTRO -->

<div class="modal-dialog">
    <div class="container modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">REGISTRO </h5>
        </div>
        <form action="guardarRegistro.php" method="POST">
            <label for="Nombre" class="col-form-label" >Nombre: </label>
            <input type="text" class="form-control" id="Nombre" name="Nombre" required>
            <label for="Apellido" class="col-form-label">Apellido: </label>
            <input type="text" class="form-control" id="Apellido" name="Apellido" required>
            <label for="Cedula" class="col-form-label">C.C.: </label>
            <input type="tel" class="form-control" id="Cedula" name="Cedula" required>
            <label for="Telefono" class="col-form-label">Teléfono: </label>
            <input type="tel" class="form-control" id="Telefono" name="Telefono" required>
            <label for="Correo" class="col-form-label">E-mail: </label>
            <input type="email" class="form-control" id="Correo" name="Correo" required>
            <label for="Contraseña" class="col-form-label">Contraseña: </label>
            <input type="password" class="form-control" id="Contraseña" name="Contrasenia" required> <br>
            <input type="submit" value="Registrar" class="btn btn-dark"><br>
        </form>
        <br>
        <?php
            if(isset($_POST['Nombre'])&& isset($_POST['Apellido'])&& isset($_POST['Cedula'])&& isset($_POST['Telefono'])&& isset($_POST['Correo'])&& isset($_POST['Contraseña']))

                require_once "../admin/config/db.php";

        ?>

    </div>
</div>




<div class="container-fluid content-row">
    <p class="text-center">© 2022 My . S T O R E . Site - Andrea Mayorga. Todos los Derechos Reservados.</p>
</div>


</body>
</html>