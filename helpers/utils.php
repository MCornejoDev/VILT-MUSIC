<?php

require_once './models/categoria.php';

class Utils{

    public static function deleteSession($nombre){
       if(isset($_SESSION[$nombre])){
        $_SESSION[$nombre] = null;
        unset($_SESSION[$nombre]);
       }

       return $nombre;
    }

    public static function showCategories(){
        $categorias = new Categoria();
        $categorias = $categorias->getAll();
        return $categorias;
    }
}