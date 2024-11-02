<?php

class BaseController
{
    public function loadView($viewName)
    {
        $viewPath = BASE_PATH . '/resources/views/' . $viewName . '.php';

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            include BASE_PATH . '/resources/views/errors/404.php';
        }
    }

    public function error404()
    {
        $this->loadView('errors/404');
    }
}
