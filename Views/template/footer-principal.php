<!--Modal-->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="my-modal-title"><i class="fas fa-cart-arrow-down"></i>Carrito</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle" id="tableListaCarrito">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-around mb-3">
                <h3 id="totalGeneral"></h3>
                <?php if (!empty($_SESSION['correoCliente'])) {?>
                <a class="btn btn-outline-primary" href="<?php echo BASE_URL . 'clientes'; ?>">Procesar pedido</a>
                <?php }else{ ?>
                <a class="btn btn-outline-primary" href="#" onclick="abrirModalLogin();">Crear Cuenta</a>
                <?php } ?>
            </div>

        </div>
    </div>
</div>

<!--Login-->
<div id="modalLogin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="title-Login">Iniciar Sesión</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body m-3">
                <form method="get" action="">
                    <div class="text-center">
                        <img class="img-thumbnail rounded-circle" src="<?php echo BASE_URL . 'assets/img/logo.png'; ?>" alt="" width="100">
                    </div>
                    <div class="row">
                    <!-- formulario de Login -->
                        <div class="col-md-12" id="frmLogin">
                            <div class="form-group mb-3">
                                <label for="correoLogin"><i class="fas fa-envelope"></i> Correo</label>
                                <input id="correoLogin" class="form-control" type="text" name="correoLogin" placeholder="Correo Electrónico">
                            </div>
                            <div class="form-group mb-3">
                                <label for="claveLogin"><i class="fas fa-key"></i> Contraseña</label>
                                <input id="claveLogin" class="form-control" type="text" name="claveLogin" placeholder="Contraseña">
                            </div>
                            <a href="#" id="btnRegister" >¿Todavia no tienes una cuenta?</a>
                            <div class="float-end">
                                <button class="btn btn-primary btn-lg" type="button" id="login">Login</button>
                            </div>
                        </div>
                        <!-- formulario de registro -->
                        <div class="col-md-12 d-none" id="frmRegister" >
                        <div class="form-group mb-3">
                                <label for="nombreRegistro"><i class="fas fa-list"></i> Nombre</label>
                                <input id="nombreRegistro" class="form-control" type="text" name="nombreRegistro" placeholder="Nombre Complento">
                            </div>
                            <div class="form-group mb-3">
                                <label for="correoRegistro"><i class="fas fa-envelope"></i> Correo</label>
                                <input id="correoRegistro" class="form-control" type="text" name="correoRegistro" placeholder="Correo Electrónico">
                            </div>
                            <div class="form-group mb-3">
                                <label for="claveRegistro"><i class="fas fa-key"></i> Contraseña</label>
                                <input id="claveRegistro" class="form-control" type="text" name="claveRegistro" placeholder="Contraseña">
                            </div>
                            <a href="#" id="btnLogin" >¿Ya tienes una cuenta?</a>
                            <div class="float-end">
                                <button class="btn btn-primary btn-lg" type="button" id="registrarse" >Registrarse</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="text-center mt-3">
    <a href="<?php echo BASE_URL; ?>admin" class="btn btn-outline-primary">
        Login Administrador
    </a>
</div>

            </div>
        </div>
    </div>
</div>
<!-- Start Footer -->
<footer class="bg-footer" id="tempaltemo_footer">
    <div class="container">
        <div class="row">

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-success border-bottom pb-3 border-light logo">Moda Capital</h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li>
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        Calle 82 con Cra. 92, Engativa,Bogota
                    </li>
                    <li>
                        <i class="fa fa-phone fa-fw"></i>
                        <a class="text-decoration-none" href="https://wa.me/573115015076?text=%F0%9F%92%AC%20Hola%20%F0%9F%91%8B,%20quiero%20m%C3%A1s%20informaci%C3%B3n%20sobre%20la%20p%C3%A1gina%20de%20Moda%20Capital%20%F0%9F%9B%8D%EF%B8%8F.%20%C2%BFMe%20pueden%20ayudar?" target="_black">3115015076</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope fa-fw"></i>
                        <a class="text-decoration-none" href="https://mail.google.com/mail/?view=cm&fs=1&to=info.modacapital@gmail.com&su=Consulta%20sobre%20Moda%20Capital&body=Estimados%20señores%20de%20Moda%20Capital,%0D%0A%0D%0AQuisiera%20obtener%20información%20más%20detallada%20sobre%20sus%20productos%20y%20servicios.%20Agradezco%20de%20antemano%20su%20atención.%0D%0A%0D%0ASaludos%20cordiales," target="_blank"> info.modacapital@gmail.com</a>
                    </li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light"><b>Productos</b></h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL .'principal/categorias/12' ?>">Enterizos</a></li>
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL .'principal/categorias/9' ?>">Vestidos</a></li>
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL .'principal/categorias/3' ?>">Chaquetas hombre</a></li>
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL .'principal/categorias/11' ?>">Mujer Zapatos</a></li>
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL .'principal/categorias/8' ?>">Faldas</a></li>
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL .'principal/categorias/1' ?>">Camisas Hombre</a></li>
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL .'principal/categorias/4' ?>">Zapatos Hombre</a></li>
                </ul>
            </div>

            <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light"><b>Mas informacion</b></h2>
                <ul class="list-unstyled text-light footer-link-list">
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL; ?>">Inicio</a></li>
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL .'principal/about' ?>">Nosotros</a></li>
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL .'principal/shop' ?>">Productos</a></li>
                    <li><a class="text-decoration-none" href="<?php echo BASE_URL .'principal/contact' ?>">Contactenos</a></li>
                </ul>
            </div>

        </div>

        <div class="row text-light mb-4">
            <div class="col-12 mb-3">
                <div class="w-100 my-3 border-top border-light"></div>
            </div>
            <div class="col-auto me-auto">
                <ul class="list-inline text-left footer-icons">
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.facebook.com/profile.php?id=61576371895211"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/es_moda_capital/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                    </li>
                    <li class="list-inline-item border border-light rounded-circle text-center">
                        <a class="text-light text-decoration-none" target="_blank" href="https://x.com/capital_mo21399"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="w-100 bg-dark py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light">
                       <b> Copyright &copy; 2025 Moda Capital
                        | Diseñado por:Carol Aguirre y Lizeth Gonzales</b></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- End Footer -->
<!-- Start Script -->
<script src="<?php echo BASE_URL; ?>assets/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/slick.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/templatemo.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/all.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/custom.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/sweetalert2.all.min.js"></script>
<script>
    const base_url = '<?php echo BASE_URL; ?>';
</script>
<script src="<?php echo BASE_URL; ?>assets/js/carrito.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/login.js"></script>


<!-- End Script -->