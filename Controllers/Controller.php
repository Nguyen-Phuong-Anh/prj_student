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
        public function showHomeLecturer() {
            require_once('./Views/home_lecturer.php');
        }

        public function handleChangePwd() {
            require_once('./Models/AuthModel.php');
            $model = new AuthModel();
            $model->changePwd($_POST['tenTK']);
        }
    }
?>