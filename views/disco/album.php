<h2 class="text-capitalize h2-responsive mx-auto"> Album </h2>

<div class="container-fluid mb-5 pb-5">
    <div class="row mx-auto">
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 mb-3">
            <img class="img-fluid w-75" src="<?php echo($disco->imagen)?>" alt="<?php echo($disco->titulo)?>">
        </div>
        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
            <div class="container">
                <div class="row mx-auto">
                    <?php while($single = $singles->fetch_object()): ?>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top destacados text-center pt-2 pb-3">
                        <span class="float-left"><?php echo($single->titulo) ?></span>
                        <i class="far fa-play-circle float-right"></i>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>