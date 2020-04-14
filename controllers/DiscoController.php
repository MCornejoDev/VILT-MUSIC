<?php
require_once './models/disco.php';
require_once './models/categoria.php';

class DiscoController{
    public function index(){
        $discos = new Disco();
        
        $discos = $discos->getDiscosRandom(6);

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
}