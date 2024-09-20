<h2 class="text-capitalize h2-responsive mx-auto"> Categoria <?php echo($nombre); ?> </h2>


<?php while($disco = $discos->fetch_object()): ?>
<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 mt-5">
    <!-- Card -->
    <div class="card">
        <!-- Card image -->
        <div class="view overlay">
            <img class="card-img-top" src="https://mdbootstrap.com/img/Mockups/Lightbox/Thumbnail/img%20(67).jpg"
                alt="Card image cap">
            <a href="#!">
                <div class="mask rgba-white-slight"></div>
            </a>
        </div>
        <!-- Card content -->
        <div class="card-body">
            <!-- Title -->
            <h4 class="card-title"><?php echo($disco->titulo); ?></h4>
            <!-- Text -->
            <p class="card-text"><?php echo($disco->descripcion)?></p>
            <!-- Button -->
            <a href="#" class="btn btn-primary">Button</a>
        </div>
    </div>
    <!-- Card -->
</div>
<?php endwhile; ?>