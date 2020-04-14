<?php
include("./layouts/header.php");
include("./layouts/form.php")
?>

<div class="container-fluid mt-5 mb-5 pt-5 pb-5">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-3 col-lg-3 col-xl-3 border-right border-bottom">
            <form action="" id="formLogin" class="md-form">
                <div class="md-form">
                    <label for="nombre_usuario">Usuario</label>
                    <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control">
                </div>

                <div class="md-form">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>

                <div class="md-form">
                    <input type="checkbox" name="remember_me" id="remember_me"> Recuerdame
                    <span class="float-right"><a href="">¿Olvidaste la contraseña?</a></span>
                </div>
                <div class="md-form text-center">
                    <button type="submit" class="btn btn-indigo">Iniciar Sesión</button>
                </div>
            </form>
        </div>
        <div class="col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9 border-bottom">
           
        </div>
    </div>
</div>


<?php
include("./layouts/footer.php");
?>