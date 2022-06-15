<?php
    include("template/header.php");


    $payment = $_GET['payment_id'];
    $status = $_GET['status'];
    $payment_type = $_GET['payment_type'];
    $order_id = $_GET['merchant_order_id'];
    $id_Venta = $_GET['id_Venta'];

            $sentenciaSQL=$conexion->prepare("UPDATE `tblventas` 
                                                            SET `status` = 'Rechazado' 
                                                            WHERE `tblventas`.`ID_Orden` = :ID_Orden;");
            $sentenciaSQL->bindParam(":ID_Orden", $id_Venta);
            $sentenciaSQL->execute();

?>
    <div class="jumbotron text-center">
        <h1 class="display-4">Oops.. ha ocurrido un error.</h1>
        <hr class="my-4">
        <p class="lead">Inténtalo nuevamente.
        </p>
        <div class="mis_pedidos-btn" href=""> </div>
    </div>
<?php include("template/footer.php"); ?>
