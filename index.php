<?php include("template/header.php");?>
<!-- Inicio Carrusel -->
<div class="row">
    <section>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/Index_img/banner1.jpg" class="d-block w-100" alt="banner1">
                </div>
                <div class="carousel-item">
                    <img src="./img/Index_img/banner2.jpg" class="d-block w-100" alt="banner2">
                </div>
                <div class="carousel-item">
                    <img src="./img/Index_img/banner3.jpg" class="d-block w-100" alt="banner3">
                </div>
                <div class="carousel-item">
                    <img src="./img/Index_img/banner4.jpg" class="d-block w-100" alt="banner4">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div> <br>
    </section>
</div>
<!--Fin Carrusel-->
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

<?php include("template/footer.php");?>
