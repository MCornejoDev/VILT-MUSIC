<?php

use App\Http\Services\UserService;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '../../../Http/Services/UserService.php';

class UserController extends BaseController
{
    function index()
    {
        $this->login();
    }

    function login()
    {
        if (!identityIsEmpty()) {
            redirectTo('/');
            return false;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->loadView('user/index');
            return false;
        }

        $data = $this->getData();

        if (UserService::checkCredentials($data['email'], $data['password'])) {
            $user = UserService::getUser($data['email']);
            $_SESSION['identity'] = $user;
            $_SESSION['admin'] = isAdmin();
            redirectTo('/');
        } else {
            addToBag('errors', ['user.form.login.error']);
            $this->loadView('user/index');
        }
    }

    function register()
    {
        if (!identityIsEmpty()) {
            redirectTo('/');
            return false;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = $this->getData();

            // //VALIDAR EL USUARIO SEGÚN UNIQUE, NULO, FALSE O LO QUE SEA
            // if (!$user->isValid($data)) {
            //     $this->loadView('user/register');
            //     return;
            // }

            UserService::save($data) ? addToBag('messages', ['user.form.register.success']) : addToBag('errors', ['user.form.register.error']);
        }

        $this->loadView('user/register');
    }

    public function logout()
    {
        // Clear session data
        unset($_SESSION['identity']);
        unset($_SESSION['admin']);
        unset($_SESSION['error']);
        unset($_SESSION['messages']);
        redirectTo('/user/login');
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
