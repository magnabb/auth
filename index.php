<?php
require_once 'bootstrap.php';

switch($_SERVER['REQUEST_URI']){

    // Registration form
    case '/register':
        $action = new \magnabb\controller\Register();
        $action->indexAction();
        break;

    // Chech phone number form
    case '/register/checkNumber':
        $action = new \magnabb\controller\Register();
        $res = $action->checkAction();
        if (!$res) {
            header('Location: /register', true, 307);
            die;
        }
        break;

    // Save user data in DB
    case '/register/send':
        $action = new \magnabb\controller\Register();
        $action->sendAction();
        header('Location: /user', true, 307);
        break;

    // User profile page
    case '/user':
        if(isset($_SESSION['user'])) {
            (new \magnabb\controller\Controller())->showUserAction();
        } else {
            header('Location: /', true, 307);
            die;
        }
        break;

    // Authorisation form
    case '/auth':
        $action = new \magnabb\controller\Authorise();
        $action->indexAction();
        break;

    // Check user auth exists
    case '/auth/check':
        $action = new \magnabb\controller\Authorise();

        if (!$action) {
            // if user doesn`t exists
            // relocate to main page
            header('Location: /', true, 307);
            die;
        }
        $action->auth();
        header('Location: /user', true, 307);
        break;

    // Logout auth user
    case '/logout':
        (new \magnabb\controller\Authorise())->deauth();
        header('Location: /', true, 307);
        break;

    // Main page
    default:
        $action = new \magnabb\controller\Controller();
        $action->indexAction();
}