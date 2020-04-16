<?php

require_once 'models/categoria.php';

class CategoriaController{

    public function index(){
        $categorias = new Categoria();
        $categorias = $categorias->getAll();

        return $categorias;
    }
}