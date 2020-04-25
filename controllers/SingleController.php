<?php

require_once "./models/disco.php";
require_once "./models/single.php";

class SingleController{
    
    public function añadir(){
        $discos = new Disco();
        $discos = $discos->getDiscos();
        require_once "views/administracion/añadir_singles.php";
    }

    public function save(){
        if(isset($_POST) && isset($_FILES)){
            $disco_id = isset($_POST['id_disco']) ? $_POST['id_disco'] : false;
            $archivos = isset($_FILES['audio']) ? $_FILES['audio'] : false;
            $archivos_subidos = count($_FILES['audio']['name']);

            if($archivos && $disco_id){

                foreach ($_FILES["audio"]["error"] as $clave => $error) {
                    if ($error == UPLOAD_ERR_OK) {
                        $nombre_tmp = $_FILES["audio"]["tmp_name"][$clave];
                        $nombre = current(explode('.',$_FILES["audio"]["name"][$clave]));
                        $single = new Single();
                        $comprobar_titulo = $single->comprobarTitulo($nombre,$disco_id);
                        
                        if($comprobar_titulo){
                            $single->setDisco_id($disco_id);
                            $single->setTitulo($nombre);
                            $single->setDuracion('3:45');
                            $nombre_carpeta = $single->obtenerTituloCarpeta($single->getDisco_id());
                            $url_carpeta = "public/albums/" . $nombre_carpeta . "/";
                            $url_completa = $url_carpeta . $single->getTitulo() . ".mp3";
                            $single->setArchivo_musical($url_completa);
                            //$id = $single->obtenerUltimoId();
                            // basename() puede evitar ataques de denegació del sistema de ficheros;
                            // podría ser apropiado más validación/saneamiento del nombre de fichero
                            //$nombre = basename($_FILES["imágenes"]["name"][$clave]);
                            if(move_uploaded_file($nombre_tmp, $url_completa)){
                                $save = $single->save();
                                if($save){
                                    $_SESSION['single'] = 'success';
                                    $_SESSION['archivos_subidos'] = $archivos_subidos;
                                }
                                else{
                                    $archivos_subidos--;
                                }
                            }
                            else{
                                $archivos_subidos--;
                            }
                        }
                        else
                        {
                            $archivos_subidos--;
                        }
                       
                    }
                }

                
            }
            else{
                $_SESSION['single'] = 'error';
                $_SESSION['message'] = 'Algún campo estaba vacío';
            }
        }
        else{
            $_SESSION['single'] = 'error';
            $_SESSION['message'] = 'Error, pruebe de nuevo';
        }
        
        header('Location:'.base_url.'single/añadir');
    }
}