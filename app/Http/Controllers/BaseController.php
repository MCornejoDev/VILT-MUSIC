<?php

namespace App\Http\Controllers;

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
     * This method loads a view and passes data to it.
     * @param mixed $template 
     * @param array $data 
     * @return void 
     */
    function view($template, $data = [])
    {
        $file = BASE_PATH . "/resources/views/{$template}.php";

        if (!file_exists($file)) {
            die("La vista {$template} no existe en {$file}");
        }

        extract($data, EXTR_SKIP);
        ob_start();
        include $file;
        $content = ob_get_clean();

        echo $content;
    }

    /**
     * This method loads the 404 view.
     * @return void 
     */
    public function error404(): void
    {
        $this->view('errors/404');
    }
}
