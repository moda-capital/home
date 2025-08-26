<?php include_once 'Views/template/header-admin.php'; ?>

<button type="button" class="btn btn-primary mb-2" id="nuevo_registro">Nuevo</button>

<div class="card" style="width: 100%;">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" style="width: 100%; text-align: center;" id="tblUsuarios">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Foto</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>                 



<div id="nuevoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="titleModal"></h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    
                </button>
            </div>
            <form id="frmRegistro" >
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                     <input type="hidden" id="imagen_actual" name="imagen_actual">
                    <div class="form-group mb-2">
                  <label for="nombre">Nombres</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombres">
                    </div>
                     <div class="form-group mb-2">
                  <label for="apellido">Apellidos</label>
                        <input id="apellido" class="form-control" type="text" name="apellido" placeholder="Apellidos">
                    </div> 
                    <div class="form-group mb-2">
                  <label for="correo">Correo</label>
                        <input id="correo" class="form-control" type="email" name="correo" placeholder="Correo Eletronico">
                    </div>
                     <div class="form-group mb-2">
                  <label for="clave">Contraseña</label>
                        <input id="clave" class="form-control" type="password" name="clave" placeholder="Contraseña">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
        <button class="btn btn-primary" type="submit" id="btnAccion">Registrar</button>
        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Cancelar</button>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once 'Views/template/footer-admin.php'; ?>


<script src="<?php echo BASE_URL . 'assets/js/modulos/usuarios.js'; ?>"></script>
</body>



</html>

