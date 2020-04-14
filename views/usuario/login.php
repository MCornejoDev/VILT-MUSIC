<div class="container-fluid mb-5">
    <div class="row">
        <?php if(isset($_SESSION['error_login'])): ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mx-auto border">
            <div class="text-center font-weight-bold h3-responsive text-danger">
                <?php echo($_SESSION['error_login']); ?>
            </div>
        </div>
        <?php endif; ?>
        <?php Utils::deleteSession('error_login'); ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto border">
            <div class="header border-bottom pt-4 pb-4 text-center">
                <h3 class="h3-responsive">INICIAR SESIÓN</h3>
            </div>
            <form action="<?=base_url?>usuario/loginPost" method="POST" id="formLogin" class="md-form mx-auto">
                <div class="md-form">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="md-form">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <div class="md-form text-center">
                    <button type="submit" class="btn btn-indigo">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>
</div>