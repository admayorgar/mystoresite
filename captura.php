<?php
    include("template/header.php");

    $payment = $_GET['payment_id'];
    $status = $_GET['status'];
    $payment_type = $_GET['payment_type'];
    $order_id = $_GET['merchant_order_id'];
    $id_Venta = $_GET['id_Venta'];



            $sentenciaSQL=$conexion->prepare("UPDATE `tblventas` 
                                                SET `MercadoP` = :MercadoP, `status` = 'Aprobado' 
                                                WHERE `tblventas`.`ID_Orden` = :ID_Orden;");
            $sentenciaSQL->bindParam(":ID_Orden", $id_Venta);
            $sentenciaSQL->bindParam(":MercadoP", $payment);
            $sentenciaSQL->execute();

            $sentenciaSQL = $conexion->prepare("
                    SELECT Cantidad, det_IDproducto FROM `tbldetalleventa`  WHERE ID_Venta = :ID_Venta;");
            $sentenciaSQL->bindParam(":ID_Venta", $id_Venta);
            $sentenciaSQL->execute();
            $editable=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

            foreach ($editable as $prod) {
                $sentenciaSQL=$conexion->prepare(
                    "UPDATE `producto` SET `Cant_Por_Unidad` = `Cant_Por_Unidad`-:Cantidad WHERE `producto`.`ID_Producto` = :det_IDproducto;"
                );
                $sentenciaSQL->bindParam(":Cantidad", $prod['Cantidad']);
                $sentenciaSQL->bindParam(":det_IDproducto", $prod['det_IDproducto']);
                $sentenciaSQL->execute();
            }


    unset($_SESSION['CARRITO']);

?>
    <div class="jumbotron text-center">
        <h1 class="display-4">¡Gracias por tu compra!</h1>
        <hr class="my-4">
        <p class="lead">Tu pago ha sido procesado correctamente. Recibirás el detalle a tu dirección de correo.
        </p>
        <div class="mis_pedidos-btn" href=""> </div>
    </div>
<?php include("template/footer.php"); ?>
