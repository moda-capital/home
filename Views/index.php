<?php include_once 'Views/template/header-principal.php'; ?>
   <!-- Iniciar Banner Hero -->
    <!--Home section starts-->
    
    <video width="100%" autoplay loop muted>
        <source src="<?php echo BASE_URL; ?>assets/Videos/MODA CAPITAL.mp4" type="video/mp4">
    </video>
    

    <!-- Fin del Banner Hero -->

<!-- Inicio de las Categorías  -->
    <section class="bg-light py-5">
    <div class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Categorias</h1>

            </div>
        </div>
        <div class="row">
            <?php foreach ($data['categorias'] as $categoria) { ?>
            <div class="col-12 col-md-2 p-5 mt-3">
                <a href="<?php echo BASE_URL .'principal/categorias/'. $categoria['id']; ?>"><img src="<?php echo $categoria['imagen']; ?>" class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3"><?php echo $categoria['categoria']; ?></h5>
                <p class="text-center"><a class="btn btn-success" href="<?php echo BASE_URL .'principal/categorias/'. $categoria['id']; ?>">¡Entra aqui!</a></p>
            </div>
            <?php } ?>
        </div>
    </section>
   <!-- Fin de las categorías del mes -->

<!-- Inicio del producto destacado -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Nuevos Productos</h1>
                    
                </div>
            </div>
            <div class="row">
            <?php foreach ($data['nuevoProductos'] as $producto) { ?>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id'];   ?>">
                            <img src="<?php echo $producto['imagen']; ?>    " class="card-img-top" alt="<?php echo $producto['nombre']; ?>">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right"><?php echo MONEDA . ' ' . $producto['precio']; ?></li>
                            </ul>
                            <a href="<?php echo BASE_URL . 'principal/detail/' . $producto['id'];  ?>" class="h2 text-decoration-none text-dark"><?php echo  $producto['nombre']; ?></a>
                            <p class="card-text">
                                <?php echo $producto['descripcion']; ?>
                            </p>
                            <p class="text-muted">Reviews (24)</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </section>
    <!-- End Featured Product -->

    <?php include_once 'Views/template/footer-principal.php'; ?>
</body>

</html>