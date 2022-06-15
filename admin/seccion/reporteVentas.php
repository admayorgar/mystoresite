<?php
ob_start();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Reporte de Ventas</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<?php
    include("../config/db.php");

    //Consultar tabla ventas
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `tblventas` WHERE status = 'Aprobado';");
    $sentenciaSQL->execute();
    $listadoVentas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

    <table class="table table-bordered">
        <tr>
            <th scope="col">
                <h5 class="text-center display-4"> Reporte de Ventas </h5>
            </th>
            <th scope="col" >
                <img src="../../img/Index_img/outputLogo.png" class="img-fluid"><br>
                <h6 class="text-right">
                    <?php $time = time(); echo date("d-m-Y (H:i:s)", $time); ?>
                </h6>
            </th>
        </tr>
    </table>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Venta</th>
            <th>Cliente</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listadoVentas as $vendido) { ?>
            <tr>
                <td><?php echo $vendido['Fecha_Orden'];?> </td>
                <td><?php echo $vendido['ID_Orden'];?> </td>
                <td><?php echo $vendido['correo'];?> </td>
                <td><?php echo $vendido['total_orden'];?> </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
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
$dompdf->stream("reporte_de_ventas", array("Attachment" => false));


?>