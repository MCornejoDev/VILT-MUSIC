<h2 class="text-capitalize h2-responsive mx-auto"> DESTACADOS </h2>

<div class="container-fluid mb-5 pb-5">
    <div class="row mx-auto">
        <?php while($disco = $discos->fetch_object()): ?>
        <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 border destacados text-center">
            <img class="float-left" src="<?=base_url?><?php echo($disco->imagen)?>" alt="<?php echo($disco->titulo)?>">
            <span><?php echo($disco->titulo) ?></span>
            <?php if(isset($_SESSION['identity'])): ?>
            <a href="<?=base_url?>disco/album&id=<?php echo($disco->id) ?>" class="float-right">Ir</a>
            <?php else: ?>
                <i class="fas fa-info-circle float-right" data-toggle="tooltip" data-placement="right" title="Debe iniciar sesión o registrarse"></i>
            <?php endif;?>
        </div>
        <?php endwhile; ?>
    </div>
</div>