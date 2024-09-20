<?php

require_once './models/usuario.php';
require_once './helpers/utils.php';

class UsuarioController
{
    public function index()
    {
        echo 'Controlador Usuario, Acción Index';
    }

    public function login()
    {
        require_once 'views/usuario/login.php';
    }

    public function registro()
    {
        require_once 'views/usuario/registro.php';
    }

    public function save()
    {
        $save = false;
        $array_aux = [];

        if (isset($_POST)) {
            $nombre_usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : false;
            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $imagen = isset($_FILES['imagen']) ? $_FILES['imagen'] : false;

            if ($nombre_usuario && $email && $password && $nombre && $apellidos && $direccion && $imagen) {
                $usuario = new Usuario();
                $existe_usuario = $usuario->compruebaUsuario($nombre_usuario);

                if ($existe_usuario == false) {
                    $usuario->setNombre_usuario($nombre_usuario);
                    $usuario->setEmail($email);
                    $usuario->setPassword($password);
                    $usuario->setNombre($nombre);
                    $usuario->setApellidos($apellidos);
                    $usuario->setRol('user');
                    $usuario->setImagen($imagen);
                    $usuario->setDireccion($direccion);
                    $save = $usuario->save();
                }
            } else {
                foreach ($_POST as $elemento => $valor) {

                    if ($valor == false) {
                        array_push($array_aux, $elemento);
                    }
                }
                foreach ($_FILES as $elemento => $valor) {

                    if ($valor == false) {
                        array_push($array_aux, $elemento);
                    }
                }
            }
        }

        if ($save) {
            $_SESSION['register'] = 'complete';
        } else {
            $_SESSION['register'] = 'failed';
            $_SESSION['array_aux'] = $array_aux;
        }

        header('Location:' . base_url . 'usuario/registro');
    }

    public function loginPost()
    {
        if (isset($_POST)) {

            $email = isset($_POST['email']) ? $_POST['email'] : false;
            $password = isset($_POST['password']) ? $_POST['password'] : false;
            //IDENTIFICAR AL USUARIO

            //CONSULTA A LA BASE DE DATOS
            $usuario = new Usuario();
            $usuario->setEmail($email);
            $usuario->setPassword($password);
            $identity = $usuario->login();
            $localizacion = 'usuario/login';
            //CREAR UNA SESIÓN
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;
                if ($identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
                $localizacion = 'disco/index';
            } else {
                $_SESSION['error_login'] = 'Identificación fallida';
                $localizacion = 'usuario/login';
            }
        } else {
            $_SESSION['error_login'] = 'Identificación fallida';
        }

        header('Location:' . base_url . $localizacion);
    }

    public function salir()
    {
        if (isset($_SESSION['identity'])) {
            Utils::deleteSession('identity');
        }

        if (isset($_SESSION['admin'])) {
            Utils::deleteSession('admin');
        }

        //header('Location:'.base_url.'usuario/login');
        Utils::redirect(base_url . "usuario/login");
    }
}
