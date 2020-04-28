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

    public function añadir(){
        $categorias = new Categoria();
        $categorias = $categorias->getAll();
        require_once 'views/administracion/añadir_disco.php';
    }

    public function save(){
        if(isset($_POST)){
            
            $id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : false;
            $nombre_titulo = isset($_POST['nombre_titulo']) ? $_POST['nombre_titulo'] : false;
            $nombre_artista = isset($_POST['nombre_artista']) ? $_POST['nombre_artista'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : false;
            $imagen = isset($_FILES['imagen']) ? $_FILES['imagen'] : false;
            
            if($id_categoria && $nombre_titulo && $nombre_artista && $descripcion && $stock && $precio && $fecha && $imagen){
                $disco = new Disco();
                $comprobar_titulo = $disco->comprobarTitulo($nombre_titulo);
                if($comprobar_titulo){
                    $disco->setCategoria_id($id_categoria);
                    $disco->setTitulo($nombre_titulo);
                    $disco->setArtista($nombre_artista);
                    $disco->setDescripcion($descripcion);
                    $disco->setStock($stock);
                    $disco->setPrecio($precio);
                    $disco->setFecha($fecha);
                    $disco->setImagen($imagen);
                   
                    $save = $disco->save();
    
                    if($save){
                        $_SESSION['disco'] = 'success';
                    }
                    else{
                        $_SESSION['disco'] = 'error';
                        $_SESSION['message'] = 'Hubo un error en la petición';
                    }
                }
                else{
                    $_SESSION['disco'] = 'error';
                    $_SESSION['message'] = 'El título del disco ya existe.';
                }
                
            }
            else{
                $_SESSION['disco'] = 'error';
                $_SESSION['message'] = 'Algún campo estaba vacío';
            }
        }
        else{
            $_SESSION['disco'] = 'error';
            $_SESSION['message'] = 'Error, pruebe de nuevo';
        }

        header('Location:'.base_url.'disco/añadir');
    }

    public function update(){
       if(isset($_POST)){
           $id = $_POST['id'];
           $columna = $_POST['columna'];
           $valor = $_POST['value'];

           $disco = new Disco();
           $actualizado = $disco->update($id,$columna,$valor);

           if($actualizado){
            $response['status']  = 'success';
            $response['message'] = 'Se ha actualizado correctamente';
           }
           else{
            $response['status']  = 'error';
            $response['message'] = 'No se ha actualizado correctamente';
           }

           echo json_encode($response);
       }
    }
}