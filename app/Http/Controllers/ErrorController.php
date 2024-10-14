<?php

require_once __DIR__ . '/BaseController.php';


class ErrorController extends BaseController
{

    public function error404()
    {
        $this->loadView('errors/404');
    }
}
