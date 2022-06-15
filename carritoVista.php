<?php
include("template/header.php");
?>
<div class="container-fluid"> <br>
        <div class="alert alert-secondary ">
            <h3> Mi carrito </h3> <br>
            <?php
                if (!empty($_SESSION['CARRITO'])){
            ?>
                <table class="table table-light table-bordered">
                    <tbody>
                    <tr>
                        <th width="40%">Descripción</th>
                        <th width="15%" class="text-center">Cantidad</th>
                        <th width="15%" class="text-center">Precio</th>
                        <th width="20%" class="text-center">Total</th>
                        <th width="10%">--</th>
                    </tr>
                    <?php $totalCarrito=0; ?>
                    <?php
                    foreach ($_SESSION['CARRITO'] as $indice=>$elProducto){
                    ?>
                    <tr>
                        <td width="40%"><?php echo $elProducto['nombreDes']?></td>
                        <td width="15%" class="text-center"><?php echo $elProducto['cantCartDes']?></td>
                        <td width="15%" class="text-center"><?php echo $elProducto['precioDes']?></td>
                        <td width="20%" class="text-center"><?php echo number_format($elProducto['precioDes']*$elProducto['cantCartDes'],2) ?></td>
                        <td width="10%">
                            <form action="" method="post">
                                <input type="hidden" name="txtID" id="txtID" value="<?php echo openssl_encrypt($elProducto['IDdes'], COD, KEY); ?>">
                                <button type="submit" class="btn-danger" name="btnAction" value="subtract">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                        <?php $totalCarrito=$totalCarrito+($elProducto['precioDes']*$elProducto['cantCartDes']); ?>
                    <?php } ?>
                    <tr>
                        <td colspan="3" align="right"></td>
                        <td align="right"><h3>$<?php echo number_format($totalCarrito,2);?></h3></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <?php if(isset($_SESSION['usuario'])){ ?>
                                <form action="pagar.php" method="post">
                                    <div class="d-grid gap-2">
                                        <input id="email" class="form-control" type="hidden" name="email" value="<?php echo $_SESSION['usuario']; ?>">
                                        <button class="btn btn-outline-success" type="submit" name="btnAction" value="proceder">Procesar Pedido</button>
                                    </div>
                                </form>
                            <?php }else { ?>
                                <form action="pagar.php" method="post">
                                    <div class="alert alert-light" role="alert">
                                        <div class="form-group">
                                            <label for="confirmaCorreo">Confirma tu correo</label>
                                            <input id="email" class="form-control" type="email" name="email" required>
                                        </div>
                                        <small id="emailHelp" class="form-text text-muted"> La información de tu pedido se enviará a este correo</small>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-success" type="submit" name="btnAction" value="proceder">Procesar Pedido</button>
                                    </div>
                                </form>
                            <?php } ?>
                        </td>

                    </tr>

                    </tbody>
                </table>
            <?php }else{ ?>
                <div class="alert alert-danger">
                    <p>No hay productos en el carrito</p>
                </div>
            <?php } ?>
        </div>
    </div>
<?php include("template/footer.php");?>