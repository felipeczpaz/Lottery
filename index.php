<?php
require_once 'vendor/autoload.php';

require_once 'src/Controller/BaseController.php';
require_once 'src/Controller/UserController.php';

require_once 'src/Model/BaseModel.php';
require_once 'src/Model/Database.php';
require_once 'src/Model/UserModel.php';

require_once 'src/View/BaseView.php';
require_once 'src/View/UserView.php';

session_start();

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new \Bramus\Router\Router();

$router->get('/', function() {
    $view = new App\View\BaseView(['title' => 'Lottery']);

    $view->renderHeader();
    $view->renderBetForm();
    $view->renderFooter();
});

$router->match('GET|POST', '/register', function() {
    $database = new App\Model\Database($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

    $model = new App\Model\UserModel($database);
    $view  = new App\View\UserView(['title' => 'Register | Lottery']);

    $userController = new App\Controller\UserController($model, $view);
    $userController->handleRegister();    
});

$router->match('GET|POST', '/login', function() {
    $database = new App\Model\Database($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

    $model = new App\Model\UserModel($database);
    $view  = new App\View\UserView(['title' => 'Login | Lottery']);

    $userController = new App\Controller\UserController($model, $view);
    $userController->handleLogin();    
});

$router->post('/logout', function() {
    $database = new App\Model\Database($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

    $model = new App\Model\BaseModel($database);
    $view  = new App\View\BaseView([]);

    $userController = new App\Controller\UserController($model, $view);
    $userController->handleLogout();    
});

$router->run();

?>