<?php
    class Controller {
        public function showHeader() {
            require_once('./Views/component/header.php');
        }

        public function showHome() {
            require_once('./Views/home.php');
        }
    }
?>