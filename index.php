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
        
        case 'home': case 'add_student': case 'student_list': case 'student_info': 
            case 'lecturer_list': case 'lecturer_info': case 'add_lecturer': 
                case 'tuition': case 'tuition_info': case 'subject_list': case 'subject_info': case 'add_subject':
            require_once('./Controllers/Controller.php');
            $controller = new Controller();
            $controller->showHome();
            break;
        case 'home_student': case 'subject_student' : case 'point_student' : case 'tuition_student' : 
            require_once('./Controllers/Controller.php');
            $controller = new Controller();
            $controller->showHomeStudent();
            break;
<<<<<<< HEAD

        case 'home_lecturer': case 'point_student':
            require_once('./Controllers/Controller.php');
            $controller = new Controller();
            $controller->showHomeLecturer();
            break;

=======
        case 'home_lecturer': case 'profile_lecturer' :
             require_once('./Controllers/Controller.php');
            $controller = new Controller();
            $controller->showHomeLecturer();
            break;
>>>>>>> 7d7b2240323f1260faaa1dca9b86c1434fbeb950
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