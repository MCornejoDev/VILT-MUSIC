<?php

class BaseController
{
    public function loadView($viewName)
    {
        $viewPath = BASE_PATH . '/resources/views/' . $viewName . '.php';

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            echo "La vista no existe.";
        }
    }
}
