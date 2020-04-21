<div class="container-fluid">
    <div class="row">
        <?php if(isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'success'):?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="alert alert-success alert-dismissable" id="flash-msg">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h3 class="text-center h3-responsive"><i class="icon fa fa-check"></i>
                    Nueva categoría añadida.</h3>
            </div>
        </div>
        <?php elseif(isset($_SESSION['categoria']) && $_SESSION['categoria'] == 'error'): ?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="alert alert-danger alert-dismissable" id="flash-msg">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h3 class="text-center h3-responsive"><i class="icon fa fa-exclamation"></i>
                    <?php echo($_SESSION['message']) ?></h3>
            </div>
        </div>
        <?php endif; ?>
        <?php Utils::deleteSession('categoria'); ?>
        <?php Utils::deleteSession('message'); ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
            <div class="header pt-4 pb-4 text-center">
                <h3 class="h3-responsive">Nueva Categoría</h3>
            </div>
            <form action="<?=base_url?>categoria/save" method="POST" id="formSave" class="md-form mx-auto">
                <div class="md-form">
                    <label for="nombre_categoria">Nueva Categoría</label>
                    <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control">
                </div>

                <div class="md-form text-center">
                    <button type="submit" class="btn btn-indigo">Crear</button>
                </div>
            </form>
        </div>
    </div>
</div>