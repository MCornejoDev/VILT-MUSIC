<?php

use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '../../../Http/Services/UserService.php';
require_once __DIR__ . '../../../Http/Requests/UserRequest.php';

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

        $data = UserRequest::getData();

        if (UserRequest::isValid($data) && UserService::checkCredentials($data['email'], $data['password'])) {
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

            $data = UserRequest::getData();

            if (!UserRequest::isValid($data)) {
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
