<header class="mb-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <span>
                    <a href="<?= BASE_URL ?>">
                        <img src="<?= BASE_URL ?>/img/logo.png" alt="logo" width="50px" height="50px" style="position:relative; top:10px;">
                    </a>
                </span>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark indigo">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if (isset($_SESSION['identity'])) : ?>
            <ul class="ml-auto navbar-nav nav-flex-icons">
                <li class="nav-item avatar">
                    <a class="p-0 nav-link" href="#">
                        <img src="<?= BASE_URL ?><?php echo ($_SESSION['identity']->imagen); ?>" alt="<?= BASE_URL ?><?php echo ($_SESSION['identity']->imagen); ?>" class="rounded-circle z-depth-0" alt="avatar image" height="35">
                    </a>
                </li>
            </ul>
        <?php endif; ?>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <?php if (!isset($_SESSION['identity'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/usuario/login">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/usuario/registro">Registrar</a>
                    </li>
                <?php else : ?>
                    <?php if (isset($_SESSION['admin'])) : ?>
                        <li class="nav-item dropdown multi-level-dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Administración</a>
                            <!--Añadir subMenu dentro de cada enlace para insercción,actualizar o eliminar-->
                            <ul class="dropdown-menu">
                                <li class="p-0 dropdown-item dropdown-submenu">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle w-100">Disco</a>
                                    <ul class="dropdown-menu rounded-0 border-1">
                                        <li class="p-0 dropdown-item border-1">
                                            <a class="dropdown-item" href="<?= BASE_URL ?>/disco/añadir">Añadir</a>
                                        </li>
                                        <li class="p-0 dropdown-item border-1">
                                            <a class="dropdown-item" href="#">Actualizar</a>
                                        </li>
                                        <li class="p-0 dropdown-item border-1">
                                            <a class="dropdown-item" href="#">Eliminar</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="p-0 dropdown-item dropdown-submenu">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle w-100">Single</a>
                                    <ul class="dropdown-menu rounded-0 border-1">
                                        <li class="p-0 dropdown-item border-1">
                                            <a class="dropdown-item" href="<?= BASE_URL ?>/single/añadir">Añadir</a>
                                        </li>
                                        <li class="p-0 dropdown-item border-1">
                                            <a class="dropdown-item" href="#">Actualizar</a>
                                        </li>
                                        <li class="p-0 dropdown-item border-1">
                                            <a class="dropdown-item" href="#">Eliminar</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="p-0 dropdown-item dropdown-submenu">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle w-100">Categoría</a>
                                    <ul class="dropdown-menu rounded-0 border-1">
                                        <li class="p-0 dropdown-item border-1">
                                            <a class="dropdown-item" href="<?= BASE_URL ?>/categoria/añadir">Añadir</a>
                                        </li>
                                        <li class="p-0 dropdown-item border-1">
                                            <a class="dropdown-item" href="#">Actualizar</a>
                                        </li>
                                        <li class="p-0 dropdown-item border-1">
                                            <a class="dropdown-item" href="#">Eliminar</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Carrito</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categorias</a>
                            <div class="dropdown-menu">
                                <?php $categorias = Utils::showCategories();
                                while ($categoria = $categorias->fetch_object()) : ?>
                                    <a href="<?= BASE_URL ?>/disco/categoria&nombre=<?php echo ($categoria->nombre) ?>" class="dropdown-item text-capitalize"><?php echo ($categoria->nombre) ?></a>
                                <?php endwhile; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>/usuario/salir">Salir</a>
                    </li>
                    <li class="nav-item">
                        <input class="mr-3 form-control form-control-sm fa" id="search" type="text"
                            placeholder="&#xF002; Press enter to search" style="font-family:Arial, FontAwesome" aria-label="Search" value="">
                        <div id="showSearchDiv"></div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>