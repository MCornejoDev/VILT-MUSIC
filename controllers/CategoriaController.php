<?php

require_once 'models/categoria.php';

class CategoriaController{

    public function index(){
        $categoria = new Categoria();
        $categoria = $categoria->getAll();

        return $categoria;
    }
}