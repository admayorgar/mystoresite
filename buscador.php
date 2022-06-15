<?php include("template/header.php");

    if ($_POST){

        $busqueda = $_POST['PalabraClave'];

        $consultaSQL = "SELECT * FROM producto WHERE Nombre_Producto LIKE '%$busqueda%' OR ID_Producto LIKE '%$busqueda%' ";
        $stmt = $conexion->prepare($consultaSQL);
        $result = $stmt->execute(array(':palabra'=>$busqueda));
        $rows = $stmt->fetchAll(\PDO::FETCH_OBJ);

        if (count( $rows)){
            foreach($rows as $row){  ?>
            <div class="col col-sm-12 col-md-6 col-lg-3 " > <br>
                <div class="card card-img-top align-items-center bgcolorcsstemp">
                    <img class="card-img-top rounded " width="100px" src="./img/<?php echo $row->Foto;?>" alt="<?php echo $row->Foto;?>">
                    <h4 class="card-title"><?php echo $row->Nombre_Producto;?></h4>
                    <p> <span>Artículo <?php echo $row->ID_Producto;?></span> </p>
                    <h5> $<?php echo $row->Precio_Unitario?></h5>
                    <p> <?php echo $row->Descripcion_Producto?></p>
                    <button type="submit" class="btn btn-dark" name="btnAction" value="Agregar"><i class="fas fa-cart-plus"></i>COMPRAR </button><br>
                </div> <br>
            </div>  <?php }
            }else{

            ?>
            <div class="col col-sm-12 col-md-12 col-lg-12 "> <br>
                <h4 class="card-title"> Ningun resultado encontrado </h4> <br>
                <h6 class="card-title"> Te invitamos a Explorar nuestros artículos de temporada a continuación </h6>

                <br>

            </div>
            <!--Inicio Temporada-->
            <!--Inicio Temporada-->
            <div class="container-fluid content-row fondotemporada temporada-seccion"> <br>
                <div class="row">
                    <div class="col-4">
                        <img src="./img/Index_img/temporadaVerano.png" alt="Verano" width="350px" id="temporada-img">
                    </div>
                    <div class="col-8">
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <div class="col">
                                <div class="card bgcolorcsstemp">
                                    <img src="./img/Index_img/1.jpeg" class="card-img-top" alt="new">
                                    <div class="card-body">
                                        <h5 class="card-title">Categoría 1</h5>
                                        <p class="card-text">Novedades<br>
                                        </p>
                                        <a href="mujer.php" class="btn btn-dark"> Ver más </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card bgcolorcsstemp">
                                    <img src="./img/Index_img/2.jpg" class="card-img-top" alt="New" >
                                    <div class="card-body">
                                        <h5 class="card-title">Categoría 2</h5>
                                        <p class="card-text"> Tendencias <br>
                                        </p>
                                        <a href="hombre.php" class="btn btn-dark"> Ver más </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card bgcolorcsstemp">
                                    <img src="./img/Index_img/3.jpg" class="card-img-top" alt="New" width="100px">
                                    <div class="card-body">
                                        <h5 class="card-title">Categoría 3</h5>
                                        <p class="card-text">Liquidaciones <br>
                                        </p>
                                        <a href="mujer.php" class="btn btn-dark"> Ver más </a>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div> <br>
                </div>
            </div> <br>
            <!--Fin Temporada-->
            <?php
        }




    }


include("template/footer.php");
