<?php include_once 'Views/template/header-principal.php'; ?>
   <!-- Página de inicio de contenido -->
    <section class="bg-light py-1">
    <div class="container-fluid bg-light py-5">
    <section class="bg-light py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="h1"><b>Contacto con Nosotros</b></h1>
            <p><b>
                Aca podras contactarnos y contarnos tus inquietudes para
                asi poder darles una rapida solución.
            </b></p>
        </div>
    </section>
    </div>
</section>
  <!-- Iniciar mapa -->
<div id="mapid" style="width: 100%; height: 400px;"></div>

<!-- Folleto CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<!-- Folleto JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

<script>
    // Coordenadas aproximadas de Cra. 92 #82, Engativá, Bogotá
    var map = L.map('mapid').setView([4.721416, -74.118141], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([4.721416, -74.118141]).addTo(map)
        .bindPopup("<b>Moda Capital</b><br> Encuentranos en:<br>Calle 82 con Cra. 92, Engativá, Bogotá")
        .openPopup();

    map.scrollWheelZoom.disable();
    map.touchZoom.disable();
</script>
<!-- Fin del mapa -->

    <!-- Start Contact -->
    <section class="bg-light py-5">
    <div class="container py-5">
        <div class="row py-5">
            <form class="col-md-9 m-auto" role="form" id="frmContactos">
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control mt-1" id="nombre" name="Nombre" placeholder="Nombre" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="email">Correo</label>
                        <input type="email" class="form-control mt-1" id="email" name="email" value="info.modacapital@gmail.com" readonly>
                    </div>
                </div>
        
                <div class="mb-3">
                    <label for="inputmessage">Mensaje</label>
                    <textarea class="form-control mt-1" id="Mensaje" name="Mensaje"  placeholder="Mensaje" rows="8"></textarea>
                </div>
                <div class="row">
                    <div class="col text-end mt-2">
                        <button type="submit" class="btn btn-success btn-lg px-3" id="btnContactos">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </section>
    <!-- End Contact -->


<?php include_once 'Views/template/footer-principal.php'; ?>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script src="<?php echo BASE_URL . 'assets/js/modulos/contactos.js'; ?>"></script>
</body>

</html>