<?php
include("template/header.php");
?>
<?php
    if ($_POST){

        $totalCart=0;
        $SID=session_id();
        $correo=$_POST['email'];

        foreach ($_SESSION['CARRITO'] as $indice=>$elProducto ){
            $totalCart=$totalCart+($elProducto['precioDes']*$elProducto['cantCartDes']);
        }
        $sentenciaSQL=$conexion->prepare(
        "INSERT INTO `tblventas` (`ID_Orden`, `clave_trans`, `MercadoP`, `Fecha_Orden`, `correo`, `total_orden`, `status`) VALUES
        (NULL, :clave_trans, '', NOW(), :correo, :total_orden, 'pendiente');");
        $sentenciaSQL->bindParam(":clave_trans", $SID);
        $sentenciaSQL->bindParam(":correo", $correo);
        $sentenciaSQL->bindParam(":total_orden", $totalCart);

        $sentenciaSQL->execute();
        $idVenta=$conexion->lastInsertId();

        foreach ($_SESSION['CARRITO'] as $indice=>$elProducto ){
            $sentenciaSQL=$conexion->prepare("INSERT INTO `tbldetalleventa` 
                                        (`ID_Detalle`, `ID_Venta`, `det_IDproducto`, `Precio_Unitario`, `Cantidad`) 
                                    VALUES (NULL, :ID_Venta, :det_IDproducto, :Precio_Unitario, :Cantidad);");

            $sentenciaSQL->bindParam(":ID_Venta", $idVenta);
            $sentenciaSQL->bindParam(":det_IDproducto", $elProducto['IDdes']);
            $sentenciaSQL->bindParam(":Precio_Unitario", $elProducto['precioDes']);
            $sentenciaSQL->bindParam(":Cantidad", $elProducto['cantCartDes']);

            $sentenciaSQL->execute();
        }
    }
?>
<div class="jumbotron text-center">
    <h1 class="display-4">¡Paso Final!</h1>
    <hr class="my-4">
    <p class="lead">Estás a punto de Pagar la cantidad de:
    <h4>$ <?php echo number_format($totalCart,2); ?> </h4>
    </p>
    <div class="checkout-btn"></div>
    <hr class="my-4">
</div>
<?php
require __DIR__ .  '/vendor/autoload.php';// SDK de Mercado Pago
MercadoPago\SDK::setAccessToken('TEST-6346413588381366-052518-e34c4ae22fef1c741ffb9143b0198e65-232808566');// Agrega credenciales
?>

<?php
$preference = new MercadoPago\Preference();// Crea un objeto de preferencia
$item = new MercadoPago\Item(); // Crea un ítem en la preferencia
$item->id = '001';
$item->title = 'Total de la compra';
$item->quantity = 1;
$item->unit_price = $totalCart;
$preference->items = array($item);
//$preference->metadata = $idVenta;
$preference->back_urls = array(
    "success" => "http://localhost:63342/index.php/captura.php?id_Venta=".$idVenta,
    "failure" => "http://localhost:63342/index.php/fallo.php",
);
$preference->auto_return = "approved";
$preference->binary_mode = true;
$preference->save();


?>
<script>
    // Agrega credenciales de SDK
    const mp = new MercadoPago("TEST-8212fd88-cad0-4e0f-8369-11dd95a2fb8f", {
        locale: "es-AR",
    });

    // Inicializa el checkout
    mp.checkout({
        preference: {
            id: '<?php echo $preference->id; ?>'
        },
        render: {
            container: '.checkout-btn', // Indica el nombre de la clase donde se mostrará el botón de pago
            label: "Pagar con MP", // Cambia el texto del botón de pago (opcional)
        },
    });
</script>
<?php
include("template/footer.php");
?>
