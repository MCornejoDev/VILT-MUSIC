<?php

namespace App\Http\Controllers;

class AlbumController extends BaseController
{
    public function index()
    {
        $this->view('album/index');
    }
}
