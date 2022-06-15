<?php
ob_start();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Reporte de Stock</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

<?php
    include("../config/db.php");
    //SCRIPT
    $sentenciaSQL = $conexion->prepare("SELECT * FROM producto");
    $sentenciaSQL->execute();
    $listadoProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    //--------------------------------
?>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th scope="col">
                <h5 class="text-center display-4"> Reporte de Stock </h5>
            </th>
            <th scope="col" >
                <img src="../../img/Index_img/outputLogo.png" class="img-fluid"><br>
                <h6 class="text-right">
                    <?php $time = time();
                    echo date("d-m-Y (H:i:s)", $time); ?>
                </h6>
            </th>
        </tr>
        </thead>
    </table>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Artículo</th>
            <th>Nombre</th>
            <th>Talle</th>
            <th>Precio</th>
            <th>Cant.</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($listadoProductos as $prenda) { ?>
            <tr>
                <td><?php echo $prenda['ID_Producto'];?> </td>
                <td><?php echo $prenda['Nombre_Producto'];?> </td>
                <td><?php echo $prenda['Talle'];?> </td>
                <td><?php echo $prenda['Precio_Unitario'];?> </td>
                <td><?php echo $prenda['Cant_Por_Unidad'];?> </td>

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
    $dompdf->stream("reporteDeStock_pdf", array("Attachment" => false));


?>