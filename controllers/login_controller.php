<?php
require_once 'views/login.view.php';
require_once 'models/user.model.php';
require_once 'helpers/auth.helper.php';

class login_controller {

    private $view;
    private $model;
    private $auth_helper;

    public function __construct() {
        $this->view = new login_view();
        $this->model = new user_model();
        $this->auth_helper = new auth_helper();
    }

    public function show_login() {
        $this->view->show_login_view();
    }

    public function verifyUser() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->model->get_by_username($username);

        // encontró un user con el username que mandó, y tiene la misma contraseña
        if (!empty($user) && password_verify($password, $user->password)) {
            $this->auth_helper->login($user);

            header('Location: home');
        } else {
            $this->view->show_login_view("Login incorrecto");
        }
    }

    public function logout() {
        $this->auth_helper->logout();
        header('Location: ' . LOGIN);
    }
}