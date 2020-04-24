<div class="container-fluid mb-5">
    <div class="row">
        <?php if(isset($_SESSION['single']) && $_SESSION['single'] == 'success'):?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="alert alert-success alert-dismissable" id="flash-msg">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h3 class="text-center h3-responsive"><i class="icon fa fa-check"></i>
                    Nuevos singles añadidos.</h3>
            </div>
        </div>
        <?php elseif(isset($_SESSION['single']) && $_SESSION['single'] == 'error'): ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="alert alert-danger alert-dismissable" id="flash-msg">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h3 class="text-center h3-responsive"><i class="icon fa fa-exclamation"></i>
                    <?php echo($_SESSION['message']) ?></h3>
            </div>
        </div>
        <?php endif; ?>
        <?php Utils::deleteSession('single'); ?>
        <?php Utils::deleteSession('message'); ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
            <div class="header pt-4 pb-4 text-center">
                <h3 class="h3-responsive">Nuevos singles</h3>
            </div>
            <form action="<?=base_url?>single/save" method="POST" enctype="multipart/form-data" id="formSave"
                class="md-form mx-auto">
                <select class="browser-default custom-select" name="id_disco" id="id_disco" required>
                    <option selected disabled value="">Seleccione el disco</option>
                    <?php while($disco = $discos->fetch_object()):?>
                    <option value="<?php echo($disco->id)?>"><?php echo($disco->titulo)?></option>
                    <?php endwhile; ?>
                </select>

                <div class="mt-2 text-center hide" id="div_nueva_cancion">
                    <i class="fas fa-plus-circle fa-fw fa-lg" id="nueva_cancion"></i>
                </div>

                <div id="inputs">
                    
                </div>

                <div class="md-form text-center hide" id="button_enviar">
                    <button type="submit" class="btn btn-indigo">Añadir canciones</button>
                </div>
            </form>
        </div>
    </div>
</div>