<?php

require_once __DIR__ . '/Http/Controllers/ErrorController.php';

function show_error()
{
    $error = new ErrorController();
    $error->error404();
}

function get_controller_name($uri_segment)
{
    if (empty($uri_segment)) {
        return defined('CONTROLLER_DEFAULT') ? CONTROLLER_DEFAULT : null;
    }

    $controller_name = ucfirst($uri_segment) . 'Controller';
    $controller_path = __DIR__ . '/Http/Controllers/' . $controller_name . '.php';

    return file_exists($controller_path) ? $controller_name : null;
}

function load_controller($name_controller)
{
    $controller_file = __DIR__ . '/Http/Controllers/' . $name_controller . '.php';

    if (!file_exists($controller_file)) {
        show_error();
        exit();
    }

    require_once $controller_file;

    return new $name_controller();
}

// Procesa URI y obtiene nombre del controlador
$uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
$name_controller = get_controller_name($uri[0] ?? null);

if (is_null($name_controller)) {
    show_error();
    exit();
}

$controller = load_controller($name_controller);

// Determina la acción o método a ejecutar
$action = $uri[1] ?? (defined('ACTION_DEFAULT') ? ACTION_DEFAULT : null);

if (!$action || !method_exists($controller, $action)) {
    show_error();
    exit();
}

$controller->$action();
