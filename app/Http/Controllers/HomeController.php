<?php

namespace App\Http\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        if (!identityIsEmpty()) {
            $this->view('home/index');
        }

        redirectTo('/user/login');
    }
}
