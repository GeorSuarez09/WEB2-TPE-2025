<?php
//HASH DE LA CONTRASENIA $2a$12$UcWcrM14bVq8qL1oqepc5uwW4MdBNtfdNa9bBNumy9oGVze4u2WQK
                        //Usuario MelGeor       Email geoormel@gmail.com
require_once './app/model/usuario.model.php';
require_once './app/view/auth.view.php';

class AuthController {
    private $userModel;
    private $view;

    function __construct() {
        $this->userModel = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin($request) {
        $this->view->showLogin("", $request->usuario);
    }

    public function doLogin($request) {
        session_start();
        if(empty($_POST['nombre']) || empty($_POST['password']) || empty($_POST['email'])) {
            return $this->view->showLogin("Faltan datos obligatorios", $_POST['nombre'] ?? '');
            $usuarioPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }

        $nombre = $_POST['nombre'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $userFromDB = $this->userModel->getByUser($nombre);

        if($userFromDB && password_verify($password, $userFromDB->password)) {
            $_SESSION['USER_ID'] = $userFromDB->ID_usuario;
            $_SESSION['USER_PASSWORD'] = $userFromDB->password;
            $_SESSION['USER_NAME'] = $userFromDB->nombre;
            $_SESSION['USER_GMAIL'] = $userFromDB->email;
            header("Location: ".BASE_URL."listar");
            return;
        } else {
            return $this->view->showLogin("Usuario o contraseña incorrecta", $_POST['nombre'] ?? '');
        }
    }

    public function logout($request) {
        session_start();
        session_destroy();
        header("Location: ".BASE_URL."login");
        return;
    }


}