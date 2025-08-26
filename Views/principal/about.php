<?php include_once 'Views/template/header-principal.php'; ?>
<!-- Start Banner Hero -->
<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">

        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" style="height: 500px;" src="<?php echo BASE_URL?>/assets/images/logo.png" alt="Ropa moderna para hombres y mujeres">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center pt-5">
                            <h1 class="h1 text-success"><b>Moda Capital</b></h1>
                            <p>
                                Somos un aplicativo web que visibiliza los 
                                productos de una tienda 
                                física que no contaba con plataforma digital.
                                Aquí encontrarás una variedad de 
                                prendas para vestir tanto para hombre 
                                como para mujer.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" style="height: 500px;" src="<?php echo BASE_URL?>assets/images/carrusel.png" alt="Misión de Moda Capital">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left pt-5">
                            <h1 class="h1"><b>Misión</b></h1>
                            <p>
                                Nuestra misión es ofrecer un aplicativo web moderno, 
                                rápido y accesible que permita visibilizar 
                                los productos de nuestra
                                tienda física de ropa. Queremos facilitar a 
                                los usuarios descubrir, explorar
                                y conocer nuestras colecciones desde cualquier 
                                lugar y en cualquier 
                                momento, integrando innovación, estilo y confianza en cada 
                                interacción en línea.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" style="height: 500px;" src="<?php echo BASE_URL?>assets/images/carrusel2.png" alt="Visión de Moda Capital">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left pt-5">
                            <h1 class="h1"><b>Visión</b></h1>
                            <p>
                                Nuestra visión es convertirnos en el principal canal digital
                                para la tienda, llevando nuestra 
                                oferta de moda
                                más allá del espacio físico. 
                                Queremos expandir la presencia de la marca 
                                en el entorno online y ofrecer a 
                                los usuarios una experiencia
                                única que refleje la identidad y 
                                calidad de nuestros productos.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Carousel Controls -->
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>
<!-- End Banner Hero -->
    <!-- Start Section -->
    <section class="bg-light py-5">
        <div class="container py-5">
        <div class="row text-center pt-5 pb-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1"><h1>Nuestros servicios</h1></h1>
                <p>
                    Algunos de ellos son:
                </p>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-truck fa-lg"></i></div>
                    <h2 class="h5 mt-4 text-center">Servicios de entrega</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fas fa-exchange-alt"></i></div>
                    <h2 class="h5 mt-4 text-center">Envíos y devoluciones</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-percent"></i></div>
                    <h2 class="h5 mt-4 text-center">Promoción</h2>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 pb-5">
                <div class="h-100 py-5 services-icon-wap shadow">
                    <div class="h1 text-success text-center"><i class="fa fa-user"></i></div>
                    <h2 class="h5 mt-4 text-center">24 Horas de Servicio</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

    


<?php include_once 'Views/template/footer-principal.php'; ?>
</body>

</html>