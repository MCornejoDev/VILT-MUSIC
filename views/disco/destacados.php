<h2 class="text-capitalize h2-responsive mx-auto"> DESTACADOS </h2>

<div class="container-fluid mb-5 pb-5">
    <div class="row">
        <?php while($disco = $discos->fetch_object()): ?>
        <div class="col-12 col-sm-12.col-md-12 col-lg-3 col-xl-3 mb-4 w-25">
            <!--Card-->
            <div class="card card-cascade narrower mb-4" style="margin-top: 28px">

                <!--Card image-->
                <div class="view view-cascade">
                    <img src="<?php echo($disco->imagen); ?>"
                        class="card-img-top" alt="">
                    <a>
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>
                <!--/.Card image-->

                <!--Card content-->
                <div class="card-body card-body-cascade">
                    <h5 class="pink-text"><i class="fas fa-utensils"></i> Culinary</h5>
                    <!--Title-->
                    <h4 class="card-title">Cheat day inspirations</h4>
                    <!--Text-->
                    <p class="card-text">Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit
                        laboriosam, nisi ut
                        aliquid ex ea commodi.</p>
                    <a class="btn btn-unique">Button</a>
                </div>
                <!--/.Card content-->

            </div>
            <!--/.Card-->

        </div>
        <?php endwhile; ?>
    </div>
</div>