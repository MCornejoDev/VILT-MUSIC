<div class="container-fluid mb-5">
    <div class="row">
        <?php if(isset($_SESSION['disco']) && $_SESSION['disco'] == 'success'):?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="alert alert-success alert-dismissable" id="flash-msg">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h3 class="text-center h3-responsive"><i class="icon fa fa-check"></i>
                    Nuevo Disco añadido.</h3>
            </div>
        </div>
        <?php elseif(isset($_SESSION['disco']) && $_SESSION['disco'] == 'error'): ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="alert alert-danger alert-dismissable" id="flash-msg">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h3 class="text-center h3-responsive"><i class="icon fa fa-exclamation"></i>
                    <?php echo($_SESSION['message']) ?></h3>
            </div>
        </div>
        <?php endif; ?>
        <?php Utils::deleteSession('disco'); ?>
        <?php Utils::deleteSession('message'); ?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mx-auto">
            <div class="header pt-4 pb-4 text-center">
                <h3 class="h3-responsive">Nuevo Disco</h3>
            </div>
            <form action="<?=base_url?>disco/save" method="POST" id="formSave" class="md-form mx-auto">
                <select class="browser-default custom-select" name="id_categoria">
                    <option selected disabled>Seleccione una categoría</option>
                    <?php while($categoria = $categorias->fetch_object()):?>
                    <option value="<?php echo($categoria->id)?>"><?php echo($categoria->nombre)?></option>
                    <?php endwhile; ?>
                </select>

                <div class="md-form">
                    <label for="nombre_titulo">Nuevo Disco</label>
                    <input type="text" name="nombre_titulo" id="nombre_titulo" class="form-control">
                </div>

                <div class="md-form">
                    <label for="nombre_artista">Artista</label>
                    <input type="text" name="nombre_artista" id="nombre_artista" class="form-control">
                </div>

                <div class="md-form">
                    <textarea id="descripcion" name="descripcion" class="md-textarea form-control" rows="3"></textarea>
                    <label for="descripcion">Descripción del disco</label>
                </div>

                <div class="md-form">
                    <label for="stock">Nº de unidades</label>
                    <input type="text" name="stock" id="stock" class="form-control">
                </div>

                <div class="md-form">
                    <label for="precio">Precio</label>
                    <input type="text" name="precio" id="precio" class="form-control">
                </div>

                <div class="md-form">
                    <label for="fecha">Fecha </label>
                    <input type="date" name="fecha" id="fecha" class="form-control">
                </div>

                <div class="md-form">
                    <div class="custom-file">
                        <input type="file" name="imagen" class="custom-file-input" id="imagen" lang="es">
                        <label class="custom-file-label" for="imagen">Seleccionar Archivo</label>
                    </div>
                </div>
                
                <div class="md-form text-center">
                    <button type="submit" class="btn btn-indigo">Añadir nuevo disco</button>
                </div>
            </form>
        </div>
    </div>
</div>