<?php
include("../template/header.php");
include("../config/db.php");

//Recepciono en una variable el ID de la venta y correo enviados en el POST
    $txtIDventa=(isset($_POST['txtIDventa']))?$_POST['txtIDventa']:"";
    $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
    $txtfecha=(isset($_POST['txtfecha']))?$_POST['txtfecha']:"";

//Consultar Datos Cliente

        $sentenciaSQL = $conexion->prepare("
        SELECT ID_Usuario, Nombre, Apellido, Telefono FROM `usuario` WHERE Correo =:txtCorreo; ");
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

    <!-- Botones VOLVER e IMPRIMIR -->
    <div class="container">
        <div class="row">
            <div class="col-10">
                <form method="" action="misVentas.php">
                    <input type="submit" name="action" class="btn btn-danger btn-sm" value="Volver a mis Ventas"/>
                </form>
            </div>
            <div class="col-2">
                <form method="post" action="reportePedido.php">
                    <input type="hidden" name="txtIDventa" id="txtIDventa" value="<?php echo $txtIDventa;?>"/>
                    <input type="hidden" name="txtCorreo" id="txtCorreo" value="<?php echo $txtCorreo;?>"/>
                    <input type="hidden" name="txtfecha" id="txtfecha" value="<?php echo $txtfecha;?>"/>
                    <input type="submit" name="action" class="btn btn-dark btn-sm" value="Imprimir Pedido"/>
                </form>
            </div>
        </div>
    </div>


    <div class="container">
        <h3 class="text-center display-4">Venta # <?php echo $txtIDventa;?> </h3>
    <!-- INFORMACIÓN DEL CLIENTE-->
        <?php if(!empty($micliente)){ ?>
            <div class="row">
                <div class="col">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Codigo Cliente</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($micliente as $susdatos) { ?>
                            <tr>
                                <td colspan=""><?php echo $susdatos['ID_Usuario'];?> </td>
                                <td colspan=""><?php echo $susdatos['Nombre'];?> </td>
                                <td colspan=""><?php echo $susdatos['Apellido'];?> </td>
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
                        <td colspan="3"></a>Fecha y Hora: <?php echo $txtfecha;?></td>
                        <th colspan="1">Contacto cliente: </th>
                        <th colspan="1"><?php echo $txtCorreo;?></th>
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








