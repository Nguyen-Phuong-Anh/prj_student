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
                case 'tuition': case 'tuition_info': case 'subject_list': case 'subject_info': case 'add_subject': case 'class_list': case 'add_class': case 'lecturer_class':
            require_once('./Controllers/Controller.php');
            $controller = new Controller();
            $controller->showHome();
            break;
        case 'home_student': case 'subject_student' : case 'point_student' : case 'tuition_student' : case 'regist_subject': case 'getStudent_sbj': case 'pwd_student':
            require_once('./Controllers/Controller.php');
            $controller = new Controller();
            $controller->showHomeStudent();
            break;

        case 'home_lecturer': case 'student_point': case 'getStudent_info': case 'add_stdPoint': case 'std_Point': case 'pwd_lecturer':
            require_once('./Controllers/Controller.php');
            $controller = new Controller();
            $controller->showHomeLecturer();
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