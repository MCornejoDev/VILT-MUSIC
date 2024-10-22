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

            var_dump($_SESSION);
        } else {
            $this->loadView('user/index');
        }
    }

    function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getData();

            $user = new User();

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

            if ($user->save()) {
                addToBag('messages', ['user.form.success']);
                $this->loadView('user/index');
            }
        } else {
            $this->loadView('user/register');
        }
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
