<?php
    class studentController {
        public function showHeader() {
            require_once('./Views/component/header.php');
        }

        public function showHome() {
            require_once('./Views/home.php');
        }

        public function showHomeStudent() {
            require_once('./Views/home_student.php');
        }
        public function showProfile_student(){
            require_once('./Views/student/profile_student.php');
        }
        public function showSubject_student(){
            require_once('./Views/student/subject_student.php');
        }

        public function showPoint_student(){
            require_once('./Views/student/point_student.php');
        }
        public function showTuition_student(){
            require_once('./Views/student/tuition_student.php');
        }
    }
?>