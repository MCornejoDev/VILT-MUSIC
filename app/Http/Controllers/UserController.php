<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;

class UserController extends BaseController
{
    private $rules = [
        'userName' => 'required|unique:users|min:1|max:255',
        'email' => 'required|unique:users|email',
        'password' => 'required|min:8|max:255',
        'samePassword' => 'required||min:8|max:255',
        'name' => 'required|max:255',
        'lastName' => 'required|max:255',
        'address' => 'required|max:255',
    ];

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

        $data = getData();

        if (UserRequest::isValid($data, $this->rules) && UserService::checkCredentials($data['email'], $data['password'])) {
            $user = UserService::getUser($data['email']);
            $_SESSION['identity'] = $user;
            $_SESSION['admin'] = isAdmin();
            redirectTo('/');
        } else {
            addToBag('messages', ['error' => 'user.form.register.error']);
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

            $data = getData();

            if (UserRequest::isValid($data, $this->rules)) {
                addToBag('messages', ['error' => 'user.form.register.error']);
                $this->loadView('user/register');
                return;
            }

            UserService::save($data) ? addToBag('messages', ['success' => 'user.form.register.success']) : addToBag('messages', ['error' => 'user.form.register.error']);
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
}
