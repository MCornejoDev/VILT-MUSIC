<h2 class="text-capitalize h2-responsive mx-auto"> Album <?php echo($disco->titulo)?></h2>

<div class="container-fluid mb-5 pb-5">
    <div class="row mx-auto">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-4 text-center">
            <img class="img-fluid img_album pb-3" src="<?php echo($disco->imagen)?>" alt="<?php echo($disco->titulo)?>">
            <div class="container-fluid mx-auto contenedor">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><span class="float-left pl-2">Artista :
                        </span><span class="float-right"> <?php echo($disco->artista)?></span><br></div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><span class="float-left pl-2">Precio :
                        </span><span class="float-right"> <?php echo($disco->precio)?> €</span><br></div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><span class="float-left pl-2">Stock :
                        </span><span class="float-right"> <?php echo($disco->stock)?> unidades</span><br></div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><span class="float-left pl-2">Fecha de
                            salida: </span><span class="float-right"> <?php echo($disco->fecha)?></span><br></div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"><span
                            class="float-left pl-2"><?php echo($disco->descripcion)?></span></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="container-fluid">
                <div class="row mx-auto" id="playlist">
                    <?php while($single = $singles->fetch_object()): ?>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top destacados text-center pt-2 pb-3">
                        <span class="float-left"><?php echo($single->titulo);?></span>

                        <a href="<?=base_url?><?php echo($single->archivo_musical)?>"></a>
                        <span class="float-right">
                            <i class="far fa-play-circle"></i>
                            <i class="far fa-stop-circle"></i>
                            <input type="hidden" name="audio" value="<?=base_url?><?php echo($single->archivo_musical)?>">
                            
                            <!--<i class="far fa-pause-circle"></i>-->
                        </span>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>