<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?php echo  BASE_URL ; ?>assets/favicon/apple-icon-57x57.png">
    <!--plugins-->
    <link href="<?php echo  BASE_URL ; ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?php echo  BASE_URL ; ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?php echo  BASE_URL ; ?>assets/css/pace.min.css" rel="stylesheet" />
    <script src="<?php echo  BASE_URL ; ?>assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="<?php echo  BASE_URL ; ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo  BASE_URL ; ?>assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="<?php echo  BASE_URL ; ?>assets/css/app.css" rel="stylesheet">
    <link href="<?php echo  BASE_URL ; ?>assets/css/icons.css" rel="stylesheet">
    <title><?php echo  $data ['title'];?></title>
</head>

<body class="bg-login">
    <video autoplay muted loop id="video-fondo">
    <source src="<?php echo BASE_URL; ?>assets/videos/admin.mp4" type="video/mp4">
    </video>
    <!--wrapper-->
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4">
                            <div class="text-center">
                            <img src="<?php echo  BASE_URL ; ?>assets/images/logo2.png" width="170"  alt="LOGO" style="margin-top: 50px;"/>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="mb-4">
                                    <div class="text-center">
                                        <h3 class="">Iniciar Sesión</h3>
                                    </div>
                                    <div class="login-separater text-center mb-4"> <span>O INICIAR SESIÓN CON CORREO ELECTRÓNICO</span>
                                        <hr/>
                                    </div>
                                    <div class="form-body">
                                        <form class="row g-3" id="formulario">
                                            <div class="col-12">
                                                <label for="email" class="form-label">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="email" name="email" value="" autocomplete="off" placeholder="Correo Electronico" >
                                            </div>
                                            <div class="col-12">
                                                <label for="clave" class="form-label">Contraseña</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" class="form-control border-end-0" id="clave" name="clave" value="" autocomplete="off" placeholder=" contraseña" > <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-end"> <a href="authentication-forgot-password.html">¿Olvidaste tu contraseña?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Acceso</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="<?php echo  BASE_URL ; ?>assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?php echo  BASE_URL ; ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo  BASE_URL ; ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?php echo  BASE_URL ; ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="<?php echo  BASE_URL ; ?>assets/js/app.js"></script>
    <script>
        const base_url = '<?php echo  BASE_URL ; ?>';
    </script>
     <script src="<?php echo  BASE_URL ; ?>assets/js/sweetalert2.all.min.js"></script>
     <script src="<?php echo  BASE_URL ; ?>assets/js/modulos/login.js"></script>
</body>

</html>