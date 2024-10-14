<?php
require_once __DIR__ . '/Http/Controllers/ErrorController.php';

function show_error()
{
    $error = new ErrorController();
    $error->error404();
}

$name_controller = null;

$uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));

if (empty($uri[0])) {
    $name_controller = defined('CONTROLLER_DEFAULT') ? CONTROLLER_DEFAULT : null;
} else {
    $name_controller = file_exists(__DIR__ . '/Http/Controllers/' . ucfirst($uri[0]) . 'Controller.php') ?
        ucfirst($uri[0]) . "Controller" :
        null;
}

if (is_null($name_controller)) {
    show_error();
    exit();
}

$controller_file = __DIR__ . '/Http/Controllers/' . $name_controller . '.php';

if (!file_exists($controller_file)) {
    show_error();
    exit();
}

require_once $controller_file;

$controller = new $name_controller();

$action = $uri[1] ?? (defined('ACTION_DEFAULT') ? ACTION_DEFAULT : null);

if (!$action || !method_exists($controller, $action)) {
    show_error();
    exit();
}

$controller->$action();
