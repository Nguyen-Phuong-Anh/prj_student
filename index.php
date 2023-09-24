<?php 
    if(isset($_GET['route'])) {
        $route = $_GET['route'];
    } else {
        $route = '';
    }

    switch ($route) {
        case 'login': case '':
            require_once('./Controllers/AuthController.php');
            $controller = new AuthController();
            $controller->showLoginForm();
            break;
        case 'home':
            require_once('./Views/home.php');
            break;
        
        default:
            # code...
            break;
    }
?>