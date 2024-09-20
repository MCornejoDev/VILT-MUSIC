<?php

require_once 'models/categoria.php';

class CategoriaController{

    public function index(){
        $categorias = new Categoria();
        $categorias = $categorias->getAll();

        return $categorias;
    }

    public function añadir(){
        require_once 'views/administracion/añadir.php';
    }

    public function save(){
     
        if(isset($_POST)){
            
            $nombre_categoria = isset($_POST['nombre_categoria']) ? $_POST['nombre_categoria'] : false;

            if($nombre_categoria){
                $categoria = new Categoria();
                $categoria->setNombre($nombre_categoria);
                $save = $categoria->save();

                if($save){
                    $_SESSION['categoria'] = 'success';
                }
                else{
                    $_SESSION['categoria'] = 'error';
                    $_SESSION['message'] = 'Error, pruebe de nuevo.';
                }
            }
            else{
                $_SESSION['categoria'] = 'error';
                $_SESSION['message'] = 'Campos vacíos, rellene los campos.';
            }
        }
        else{
            $_SESSION['categoria'] = 'error';
            $_SESSION['message'] = 'Campos vacíos, rellene los campos';
        }

        header('Location:'.base_url.'categoria/añadir');
    }
}