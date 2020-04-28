<h2 class="text-capitalize h2-responsive mx-auto"><?php echo($disco->titulo)?></h2>

<div class="container-fluid mb-5 pb-5">
    <div class="row mx-auto">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4 text-center">
            <img class="img-fluid img_album pb-3" src="<?=base_url?><?php echo($disco->imagen)?>"
                alt="<?php echo($disco->titulo)?>">
            <div class="container-fluid mx-auto contenedor">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 detalles">
                        <span class="float-left pl-2">Artista :</span>
                        <span class="float-right font-weight-normal">
                            <?php echo($disco->artista)?>
                            <?php if(isset($_SESSION['admin'])): ?>
                            <i class="fas fa-edit hide" id="artista" data-type="text" data-placeholder=""
                                data-tama=""></i>
                            <?php endif;?>
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 detalles">
                        <span class="float-left pl-2">Precio :</span>
                        <span class="float-right font-weight-normal">
                            <?php echo($disco->precio)?> €
                            <?php if(isset($_SESSION['admin'])): ?>
                            <i class="fas fa-edit hide" id="precio" data-type="number" data-placeholder="Formato: 0,00"
                                data-tama=""></i>
                            <?php endif;?>
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 detalles">
                        <span class="float-left pl-2">Stock :</span>
                        <span class="float-right font-weight-normal">
                            <?php echo($disco->stock)?> unidades
                            <?php if(isset($_SESSION['admin'])): ?>
                            <i class="fas fa-edit hide" id="stock" data-type="number" data-placeholder=""
                                data-tama=""></i>
                            <?php endif;?>
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 detalles">
                        <span class="float-left pl-2">Fecha de salida: </span>
                        <span class="float-right font-weight-normal">
                            <?php echo($disco->fecha)?>
                            <?php if(isset($_SESSION['admin'])): ?>
                            <i class="fas fa-edit hide" id="fecha" data-type="text"
                                data-placeholder="Formato: YYYY/MM/DD" data-tama=""></i>
                            <?php endif;?>
                        </span>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 detalles">
                        <span class="float-left pl-2 font-weight-normal text-break text-left">
                            <?php echo($disco->descripcion)?>
                            <?php if(isset($_SESSION['admin'])): ?>
                            <i class="fas fa-edit hide" id="descripcion" data-type="textarea"
                                data-placeholder="Tamaño max: 255 carácteres" data-tama="255"></i>
                            <?php endif;?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($singles) && $singles->num_rows > 0):?>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-right border">
                        <div class="text-center">
                            <span class="reproducir" id="album_completo">Reproducir</span>
                            <span class="normal">Normal</span>
                            <span><i class="fas fa-random"></i></span>
                            <span><i class="fas fa-redo-alt"></i></span>
                        </div>
                        <div class="text-center">
                            <i class="fas fa-step-backward hide"></i>
                            <progress id="progress_audio" class="progress_bar" value="" max=""></progress>
                            <i class="fas fa-step-forward hide"></i>
                        </div>
                        <div class="text-center">
                            <span id="cancion_actual">Ninguna canción</span>
                            <span id="cambiaTiempo"></span><span id="tiempo"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row mx-auto" id="playlist">
                    <?php while($single = $singles->fetch_object()): ?>
                    <div
                        class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top destacados text-center pt-2 pb-3">
                        <span class="float-left font-weight-light"><?php echo($single->titulo);?></span>
                        <span class="float-right">
                            <i class="far fa-play-circle"></i>
                            <i class="hide far fa-pause-circle"></i>
                            <!-- <i class="far fa-stop-circle"></i> -->
                            <input type="hidden" class="audio" name="audio" id="<?php echo("audio_".$single->id)?>"
                                value="<?=base_url?><?php echo($single->archivo_musical)?>">
                        </span>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div>
            No hay singles por el momento, disculpe las molestias.
        </div>
        <?php endif; ?>
    </div>
</div>