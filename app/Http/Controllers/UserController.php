<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '../../../Models/user.php';

class UserController extends BaseController
{
    function index()
    {
        $this->login();
    }

    function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getData();
            $user = new User();
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);

            if ($user->login()) {
                $_SESSION['identity'] = $user;
                $this->loadView('home/index');
            } else {
                addToBag('errors', ['user.form.login.error']);
                $this->loadView('user/index');
            }
        } else {
            $this->loadView('user/index');
        }
    }

    function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getData();

            $user = new User();

            //VALIDAR EL USUARIO SEGÚN UNIQUE, NULO, FALSE O LO QUE SEA
            if (!$user->isValid($data)) {
                $this->loadView('user/register');
                return;
            }

            $user->setEmail($data['email']);
            $user->setUserName($data['userName']);
            $user->setPassword($data['password']);
            $user->setName($data['name']);
            $user->setLastName($data['lastName']);
            $user->setAddress($data['address']);
            $user->setImage($data['image']);
            $user->setRol('user');

            $user->save() ? addToBag('messages', ['user.form.register.success']) : addToBag('errors', ['user.form.register.error']);
            $this->loadView('user/register');
        } else {
            $this->loadView('user/register');
        }
    }

    public function logout()
    {
        unset($_SESSION['identity']);
        unset($_SESSION['admin']);
        unset($_SESSION['error']);
        unset($_SESSION['messages']);
        $this->loadView('user/index');
    }

    function getData()
    {
        $data = [];

        foreach ($_POST as $key => $value) {
            $data[$key] = $value;
        }

        foreach ($_FILES as $key => $value) {
            $data[$key] = $value;
        }

        return $data;
    }
}
