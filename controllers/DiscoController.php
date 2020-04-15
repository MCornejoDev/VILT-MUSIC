<?php
require_once './models/disco.php';
require_once './models/categoria.php';
require_once './models/single.php';

class DiscoController{
    public function index(){
        $discos = new Disco();
        
        $discos = $discos->getDiscosRandom(30);

        require_once "views/disco/destacados.php";
    }  

    public function categoria(){
       if(isset($_GET['nombre'])){
           $nombre = $_GET['nombre'];
           $categoria = new Categoria();
           $id = $categoria->getIdCategory($nombre);
           $result = false;
    
           if($id){
            $discos = new Disco();
            $discos = $discos->getDiscosCategoria($id);
            
           }
       }

       require_once "views/disco/categoria.php";

    }

    public function album(){
        if(isset($_GET['id']) && $_GET['id'] != "" && isset($_SESSION['identity'])){
            $id = $_GET['id'];
            $disco = new Disco();
            $disco = $disco->getDisco($id);
            $singles = new Single();
            $singles = $singles->getSingles($id);

            require_once "views/disco/album.php";
        }
        else{
            echo "Error";
        }
    }
}