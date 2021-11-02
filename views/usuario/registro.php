<div class="container-fluid mb-5">
    <div class="row">
        <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="text-center font-weight-bold h3-responsive text-success">Registro completado correctamente.
                </div>
            </div>
        <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed' && isset($_SESSION['array_aux'])) : ?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="text-center font-weight-bold h3-responsive text-danger">Registro fallido,
                    datos erroneos o existentes. </div>
                <ul class="pt-2 pb-2 error" >
                    <?php foreach ($_SESSION['array_aux'] as $elemento => $valor) {
                        echo ("<li>" . $valor . "</li>");
                    } ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php Utils::deleteSession('register'); ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto border registro">
            <div class="header border-bottom pt-4 pb-4 text-center">
                <h3 class="h3-responsive">REGISTRO</h3>
            </div>
            <form action="<?= base_url ?>usuario/save" method="POST" enctype="multipart/form-data" id="formRegister" class="md-form mx-auto">
                <div class="md-form">
                    <label for="nombre_usuario">Usuario</label>
                    <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control">
                </div>

                <div class="md-form">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

                <div class="md-form">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="md-form">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>

                <div class="md-form">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control">
                </div>

                <div class="md-form">
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" class="form-control">
                </div>


                <div class="md-form">
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="imagen" class="custom-file-input" id="imagen" lang="es" size="2048" accept="image/jpg, image/png, image/gif, image/jpeg">
                            <label class="custom-file-label" for="imagen">Seleccionar Archivo</label>
                        </div>
                    </div>
                </div>


                <div class="md-form text-center">
                    <button type="submit" class="btn btn-indigo">Registrarse</button>
                </div>
            </form>
        </div>
    </div>
</div>