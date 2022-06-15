<?php
?>

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