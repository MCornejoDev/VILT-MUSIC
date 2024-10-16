<header>
    <nav class="bg-indigo-600">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Botón del menú móvil -->
                    <button type="button" class="relative inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-indigo-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-button">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Abrir menú principal</span>
                        <!-- Icono cuando el menú está cerrado -->
                        <svg class="block w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Icono cuando el menú está abierto -->
                        <svg class="hidden w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center justify-center flex-1 sm:items-stretch sm:justify-start">
                    <div class="flex items-center flex-shrink-0">
                        <a href="<?= BASE_URL ?>">
                            <img class="w-auto h-8" src="<?= BASE_URL ?>/img/logo.png" alt="Logo">
                        </a>
                    </div>
                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex space-x-4">
                            <!-- Menu de navegación -->
                            <?php if (!isset($_SESSION['identity'])) : ?>
                                <a href="<?= BASE_URL ?>" class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-indigo-500 hover:text-white"><? __('nav.home') ?></a>
                                <a href="<?= BASE_URL ?>/usuario/login" class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-indigo-500 hover:text-white"><? __('nav.login') ?></a>
                                <a href="<?= BASE_URL ?>/usuario/registro" class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-indigo-500 hover:text-white"><? __('nav.register') ?></a>
                            <?php else : ?>
                                <?php if (isset($_SESSION['admin'])) : ?>
                                    <li class="relative group">
                                        <a class="hover:text-gray-300" href="#">Administración</a>
                                        <ul class="absolute hidden p-2 mt-1 text-black bg-white rounded-lg shadow-lg group-hover:block">
                                            <li class="relative group">
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Disco</a>
                                                <ul class="absolute top-0 hidden mt-1 bg-white shadow-lg left-full group-hover:block">
                                                    <li><a href="<?= BASE_URL ?>/disco/añadir" class="block px-4 py-2 hover:bg-gray-100">Añadir</a></li>
                                                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Actualizar</a></li>
                                                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Eliminar</a></li>
                                                </ul>
                                            </li>
                                            <li class="relative group">
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Single</a>
                                                <ul class="absolute top-0 hidden mt-1 bg-white shadow-lg left-full group-hover:block">
                                                    <li><a href="<?= BASE_URL ?>/single/añadir" class="block px-4 py-2 hover:bg-gray-100">Añadir</a></li>
                                                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Actualizar</a></li>
                                                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Eliminar</a></li>
                                                </ul>
                                            </li>
                                            <li class="relative group">
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Categoría</a>
                                                <ul class="absolute top-0 hidden mt-1 bg-white shadow-lg left-full group-hover:block">
                                                    <li><a href="<?= BASE_URL ?>/categoria/añadir" class="block px-4 py-2 hover:bg-gray-100">Añadir</a></li>
                                                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Actualizar</a></li>
                                                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Eliminar</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                <?php else : ?>
                                    <li>
                                        <a class="hover:text-gray-300" href="#">Carrito</a>
                                    </li>
                                    <li class="relative group">
                                        <a class="hover:text-gray-300" href="#">Categorías</a>
                                        <div class="absolute hidden mt-1 text-black bg-white rounded-lg shadow-lg group-hover:block">
                                            <?php $categorias = Utils::showCategories();
                                            while ($categoria = $categorias->fetch_object()) : ?>
                                                <a href="<?= BASE_URL ?>/disco/categoria&nombre=<?php echo ($categoria->nombre) ?>" class="block px-4 py-2 text-capitalize hover:bg-gray-100">
                                                    <?php echo ($categoria->nombre) ?>
                                                </a>
                                            <?php endwhile; ?>
                                        </div>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a class="hover:text-gray-300" href="<?= BASE_URL ?>/usuario/salir">Salir</a>
                                </li>
                                <li>
                                    <input class="border-gray-300 rounded-lg form-control form-control-sm" id="search" type="text" placeholder="&#xF002; Presiona enter para buscar" style="font-family:Arial, FontAwesome" aria-label="Search">
                                    <div id="showSearchDiv"></div>
                                </li>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menú móvil, oculto por defecto -->
        <div class="overflow-hidden transition-all duration-200 ease-in-out opacity-0 sm:hidden max-h-0" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="<?= BASE_URL ?>" class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-indigo-500 hover:text-white"><? __('nav.home') ?></a>
                <a href="<?= BASE_URL ?>/usuario/login" class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-indigo-500 hover:text-white"><? __('nav.login') ?></a>
                <a href="<?= BASE_URL ?>/usuario/registro" class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-indigo-500 hover:text-white"><? __('nav.register') ?></a>
            </div>
        </div>
    </nav>
</header>