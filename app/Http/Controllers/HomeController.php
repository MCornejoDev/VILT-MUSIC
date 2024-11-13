<?php

namespace App\Http\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $this->loadView('home/index');
    }
}
