<?php
    class LecturerController {
        public function showHeader() {
            require_once('./Views/component/header.php');
        }

        public function showHome() {
            require_once('./Views/home.php');
        }

        public function showHomeLecturer() {
            require_once('./Views/home_lecturer.php');
        }
        public function showProfileLecturer() {
            require_once('./Views/lecturer/profile_lecturer.php');
        }
    }
?>