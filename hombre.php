<?php
    include("template/header.php");

    //MOSTRAR MIS PRODUCTOS EN LA TABLA
    $sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE ID_Categoria = 'Hombre'");
    $sentenciaSQL->execute();
    $listadoProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>


<?php

    foreach($listadoProductos as $prenda){
    ?>
        <div class="col-12 col-md-6 col-lg-3 mb-3"> <br>
            <div class="card card-img-top align-items-center bgcolorcsstemp">
                <img class="card-img-top rounded " width="100px" src="./img/<?php echo $prenda['Foto'];?>" alt="<?php echo$prenda['Foto']?>">
                <h4 class="card-title"><?php echo $prenda['Nombre_Producto'];?></h4>
                <p> <span>Artículo <?php echo $prenda['ID_Producto'];?></span> </p>
                <h5> $<?php echo $prenda['Precio_Unitario'];?></h5>
                <p> <?php echo $prenda['Descripcion_Producto'];?></p>
                <form action="" method="post">
                    <input type="hidden" name="txtID" id="txtID" value="<?php echo openssl_encrypt($prenda['ID_Producto'],COD,KEY);?>">
                    <input type="hidden" name="txtNombre" id="txtNombre" value="<?php echo openssl_encrypt($prenda['Nombre_Producto'],COD,KEY);?>">
                    <input type="hidden" name="txtPrecio" id="txtPrecio" value="<?php echo openssl_encrypt($prenda['Precio_Unitario'],COD,KEY);?>">
                    <input type="hidden" name="cantCart" id="cantCart" value="<?php echo openssl_encrypt(1,COD,KEY);?>">

                <button type="submit" class="btn btn-dark" name="btnAction" value="Add"><i class="fas fa-cart-plus"></i>COMPRAR </button>
                </form>
                <br>
            </div>
        </div>

    <?php } ?>


<?php include("template/footer.php");?>