<?php
    class Controller {
        public function showHeader() {
            require_once('./Views/component/header.php');
        }

        public function showHome() {
            require_once('./Views/home.php');
        }

        public function showHomeStudent() {
            require_once('./Views/home_student.php');
        }
<<<<<<< HEAD

=======
>>>>>>> 7d7b2240323f1260faaa1dca9b86c1434fbeb950
        public function showHomeLecturer() {
            require_once('./Views/home_lecturer.php');
        }
    }
?>