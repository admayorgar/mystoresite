<?php
include("../admin/config/db.php");
session_start();
if(isset($_SESSION['usuario'])){
?>
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

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand nav-link active" href="../index.php">
            <span class="visually-hidden">(current)</span>
            <img src="../img/Index_img/outputLogo.png" alt="MyStoreSite">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../mujer.php">MUJER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../hombre.php">HOMBRE</a>
                </li>
            </ul>
            <!-- HEADER INICIA SESIÓN USUARIO -->
            <?php
            if(isset($_SESSION['usuario'])){
                ?>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href=""><?php echo  "Hola! " .$_SESSION['usuario'];?></a>
                    </li>
                </ul>
                <ul class="nav justify-content-end">
                    <li>
                        <a class="btn btn-link mx-3 links" href="../clientes/mispedidos.php">Mis Pedidos</a>
                    </li>
                    <li>
                        <a class="btn btn-link mx-3 links" href="carritoVista.php" >Carrito(<?php
                            echo (empty($_SESSION['CARRITO']))?0:count($_SESSION['CARRITO']);
                            ?>)</a>
                    </li>
                    <li>
                        <a class="btn btn-link mx-3 links" href="../clientes/salir.php"> Cerrar Sesión </a>
                    </li>
                </ul>
                <?php }?>

            <!--Inicio Buscador-->
            <form class="d-flex text-center" action="buscador.php" method="POST">
                <input class="form-control form-control-sm " type="text" placeholder="Busca tu producto" name="PalabraClave" required>
                <button class="btn btn-dark btn-sm btn-xs" type="submit">BUSCAR</button>
            </form>
            <!--Fin Buscador-->
        </div>
    </div>
</nav>
<!--FIN HEADER-->

<div>
    <?php
    //Almacenar informacion obtenida de la consulta

    //Consultar Datos Cliente
    $sentenciaSQL = $conexion->prepare("
        SELECT ID_Usuario, Nombre, Apellido, Telefono FROM `usuario` WHERE Correo =:txtCorreo; ");
    $sentenciaSQL->bindParam(":txtCorreo",$_SESSION['usuario']);
    $sentenciaSQL->execute();
    $misdatos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <?php
    //Consultar detalle Venta
    //print_r($misdatos);
    ?>
</div>












    <div class="container-fluid content-row bg-fondo ">
        <p class="text-center">© 2022 - My . S T O R E . Site - Andrea Mayorga. Todos los Derechos Reservados.</p>
    </div>

</body>
</html>
<?php } ?>