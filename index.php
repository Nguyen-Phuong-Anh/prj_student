<?php 
    if(isset($_GET['route'])) {
        $route = $_GET['route'];
    } else {
        $route = '';
    }

    switch ($route) {
        case '':
            require_once('./Controllers/AuthController.php');
            $controller = new AuthController();
            $controller->showLoginForm();
            break;
        case 'home':
            require_once('./Controllers/Controller.php');
            $controller = new Controller();
            $controller->showHome();
            break;
        case 'add_student':
            require_once('./Controllers/AdminController.php');
            $controller = new AdminController();
            $controller->showAddStudent();
            break;
        case 'logout':
            require_once('./Controllers/AuthController.php');
            $controller = new AuthController();
            $controller->processLogout();
            break;
        default:
            # code...
            break;
    }
?>