
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MyStoreSite</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../css/fontawesome/css/all.css ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <!--SDK MercadoPago.js V2-->
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <link rel="stylesheet" href="../css/estilos.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand nav-link active" href="">MyStoreSite</a>
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

<!-- INICIO SESION-->

<div class="modal-dialog">
    <div class="container modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">INICIAR SESIÓN </h5>
            <img src="../img/Index_img/login.png" alt="login" width="80" height="80">
        </div>
        <form action="login.php" method="post">
            <input type="email" class="form-control" id="Correo" name="Correo" placeholder="E-mail">
            <input type="password" class="form-control" id="Contraseña" name="Contraseña" placeholder="Contraseña"> <br>
            <input type="submit" value="INGRESAR" class="btn btn-dark"><br>
        </form>
        <br>
    </div>
</div>

<!-- ------------------------------------------------------- -->
<div>
    <?php
    if($_POST){
        session_start();
        require "../admin/config/db.php";

        $user = $_POST['Correo'];
        $pass = $_POST['Contraseña'];

        $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $conexion->prepare("SELECT * FROM usuario WHERE Correo= :user AND Contraseña= :pass");

        $query->bindParam(':user', $user);
        $query->bindParam(':pass', $pass);
        $query->execute();

        $usuario = $query->fetch(PDO::FETCH_ASSOC);

        if ($usuario){
            $_SESSION['usuario'] = $usuario['Correo'];
            header("location:paginaSegura.php");
        }else{
            echo "Usuario o Contraseña Inválidos";
        }


    }
    ?>
</div>
<hr>
<div class="container-fluid content-row">
    <p class="text-center">© 2022 My S T O R E Site - Andrea Mayorga. Todos los Derechos Reservados.</p>
</div>


</body>
</html>