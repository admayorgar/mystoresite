<?php
ob_start();
?>
    <!doctype html>
    <html lang="en">
        <head>
            <title>Pedido</title>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Bootstrap CSS -->

            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        </head>
    <body>

    <?php
    include("../config/db.php");

    //Recepciono en una variable el ID de la venta y correo enviados en el POST
    $txtIDventa=(isset($_POST['txtIDventa']))?$_POST['txtIDventa']:"";
    $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
    $txtfecha=(isset($_POST['txtfecha']))?$_POST['txtfecha']:"";

    //Consultar Datos Cliente

    $sentenciaSQL = $conexion->prepare("
        SELECT  Nombre, Apellido, Telefono FROM `usuario` WHERE Correo =:txtCorreo; ");
    $sentenciaSQL->bindParam(":txtCorreo",$txtCorreo);
    $sentenciaSQL->execute();
    $micliente=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);



    //Consultar detalle Venta
    if ($_POST){
        $sentenciaSQL = $conexion->prepare("
        SELECT Cantidad, det_IDproducto, Nombre_Producto, p.Precio_Unitario 
        FROM `producto` JOIN`tbldetalleventa` p  ON ID_producto = det_IDproducto 
        WHERE ID_Venta = :ID_Venta;");
        $sentenciaSQL->bindParam(":ID_Venta", $txtIDventa);
        $sentenciaSQL->execute();
        $detalleVenta=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <table class="table table-borderless">
                    <tr>
                        <th scope="col">
                            <h5 class="text-center display-4"> Pedido # <?php echo $txtIDventa;?> </h5>
                        </th>
                        <th scope="col" >
                            <img src="../../img/Index_img/outputLogo.png" class="img-fluid"><br>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
        <!-- INFORMACIÓN DEL CLIENTE-->
        <?php if(!empty($micliente)){ ?>
            <div class="row">
                <div class="col">
                    <table class="table table-borderless">
                        <thead>
                        <tr>DATOS DEL CLIENTE</tr>
                        <tr>
                            <th colspan="4">Cliente</th>
                            <th colspan="">Telefono</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($micliente as $susdatos) { ?>
                            <tr>
                                <td colspan="4"><?php echo $susdatos['Apellido'] ." "." ". $susdatos['Nombre'];?> </td>
                                <td colspan=""><?php echo $susdatos['Telefono'];?> </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php }else { ?>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th>Usuario No Registrado</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>

        <!-- DETALLE DE LA VENTA -->
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td colspan="2"></a>Fecha y Hora: <?php echo $txtfecha;?></td>
                        <td colspan="3">Correo: <?php echo $txtCorreo;?></td>
                    </tr>
                    <tr>
                        <th>Cantidad</th>
                        <th>Artículo</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Total</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $totalVenta=0; ?>
                    <?php foreach ($detalleVenta as $detalle) { ?>
                        <tr>
                            <td><?php echo $detalle['Cantidad'];?> </td>
                            <td><?php echo $detalle['det_IDproducto'];?> </td>
                            <td><?php echo $detalle['Nombre_Producto'];?></td>
                            <td><?php echo number_format($detalle['Precio_Unitario'], 2);?> </td>
                            <td><?php echo number_format($detalle['Precio_Unitario']*$detalle['Cantidad'],2) ?></td>
                        </tr>
                        <?php $totalVenta=$totalVenta+($detalle['Precio_Unitario']*$detalle['Cantidad']); ?>
                    <?php } ?>
                    <tr>
                        <td colspan="4" align="right"><h4>Total de la Venta</h4></td>
                        <td><h4>$<?php echo number_format($totalVenta,2);?></h4></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>

<?php
$html= ob_get_clean();
//echo $html;
//importo la libreria dompdf
require_once '../libreriaPDF/dompdf/autoload.inc.php';
//Objeto para utilizar las conversiones de html a pdf
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
//$dompdf->setPaper('A4', 'landscape');
//visualizar el archivo
$dompdf->render();
$dompdf->stream("pedido", array("Attachment" => false));


?>