<?php

namespace App\Controller;

class UserController
{
    private $model;
    private $view;

    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleRegister()
    {
        $this->view->renderHeader();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullName = filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_STRING);
            $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_NUMBER_INT);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $confirmPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_STRING);
    
            if (empty($fullName) || empty($cpf) || empty($email) || empty($password) || empty($confirmPassword)) {
                $this->view->renderRegisterForm('All fields are required.');
                return;
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $this->view->renderRegisterForm('Invalid email address.');
                return;
            }

            if ($password !== $confirmPassword) {
                $this->view->renderRegisterForm('Passwords do not match.');
                return;
            }

            if (strlen($password) < 6 || strlen($password) > 128) {
                $this->view->renderRegisterForm('Password must be between 6 and 128 characters.');
                return;
            }

            $formattedCpf = substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);

            // Call the model to register the user
            $registeredUser = $this->model->registerUser($fullName, $formattedCpf, $email, $password);

            $_SESSION['user_id'] = $registeredUser['id'];
            $_SESSION['full_name'] = $registeredUser['full_name'];

            header('Location: /');
            exit;
        } else {
            $this->view->renderRegisterForm();
        }

        $this->view->renderFooter();
    }

    public function handleLogin()
    {
        $this->view->renderHeader();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (empty($email) || empty($password)) {
                $this->view->renderLoginForm('All fields are required.');
                return;
            }

            // Call the model to login the user
            $loggedInUser = $this->model->loginUser($email, $password);

            if ($loggedInUser) {
                $_SESSION['user_id'] = $loggedInUser['id'];
                $_SESSION['full_name'] = $loggedInUser['full_name'];

                header('Location: /');
                exit;
            } else {
                $this->view->renderLoginForm('Invalid login or password.');
            }
        } else {
            $this->view->renderLoginForm();
        }

        $this->view->renderFooter();
    }

    public function handleLogout()
    {
        // Unset all session variables
        $_SESSION = array();

        // Destroy the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Destroy the session
        session_destroy();
        
        // Redirect to the home page
        header("Location: /");
        exit();
    }
}
