<?php
include("../template/header.php");
include("../config/db.php");

//Consultar tabla ventas
    $sentenciaSQL = $conexion->prepare("SELECT * FROM `tblventas` WHERE status = 'Aprobado';");
    $sentenciaSQL->execute();
    $listadoVentas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Botones IMPRIMIR -->
<div class="container">
    <div class="row">
        <div class="col-9">
        </div>
        <div class="col-3">
            <a href="reporteVentas.php" style="text-decoration: none; color: white; background-color: black; border-radius: 3px 3px 3px 3px; padding: 4px;" target="_blank"> - Imprimir Reporte de Ventas - </a>
        </div>
    </div>
</div>
<!-- LISTADO DE VENTAS -->
<div class="container">
    <h1 class="text-center display-3">MIS VENTAS</h1>
    <br>
    <div class="row">
        <div class="col">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Fecha</th>
                    <th>ID Orden</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Detalle</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach ($listadoVentas as $vendido) { ?>
                    <tr>
                        <td><?php echo $vendido['Fecha_Orden'];?> </td>
                        <td><?php echo $vendido['ID_Orden'];?> </td>
                        <td><?php echo $vendido['correo'];?> </td>
                        <td><?php echo $vendido['total_orden'];?> </td>
                        <td>
                            <form method="post" action="pedido.php">
                                <input type="hidden" name="txtIDventa" id="txtIDventa" value="<?php echo $vendido['ID_Orden'];?>"/>
                                <input type="hidden" name="txtCorreo" id="txtCorreo" value="<?php echo $vendido['correo'];?>"/>
                                <input type="hidden" name="txtfecha" id="txtfecha" value="<?php echo $vendido['Fecha_Orden'];?>"/>
                                <input type="submit" name="action" class="btn btn-dark btn-sm" value="Ver"/>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
