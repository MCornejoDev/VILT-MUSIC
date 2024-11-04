<?php

class BaseController
{
    /**
     * This method loads a view.
     * @param mixed $viewName 
     * @return void 
     */
    public function loadView($viewName): void
    {
        $viewPath = BASE_PATH . '/resources/views/' . $viewName . '.php';

        if (file_exists($viewPath)) {
            include $viewPath;
        } else {
            include BASE_PATH . '/resources/views/errors/404.php';
        }
    }

    /**
     * This method loads the 404 view.
     * @return void 
     */
    public function error404(): void
    {
        $this->loadView('errors/404');
    }
}
