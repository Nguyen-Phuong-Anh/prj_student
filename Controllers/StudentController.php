<?php
    class StudentController {
        public function showHeader() {
            require_once('./Views/component/header.php');
        }

        public function showHome() {
            require_once('./Views/home.php');
        }

        public function showHomeStudent() {
                require_once('./Views/home_student.php');
            }
            public function showProfileStudent(){
                require_once('./Views/student/profile_student.php');
            }
            public function showSubjectStudent(){
                require_once('./Views/student/subject_student.php');
            }
            
            public function showPointStudent(){
                require_once('./Views/student/point_student.php');
            }
            public function showTuitionStudent(){
                require_once('./Views/student/tuition_student.php');
            }
            public function getStudent($maSV){
                require_once('./Models/StudentModel.php');
                $model = new StudentModel();
                $data = $model->getStudent($maSV);
                // echo $masv;
                return $data;
            }
            public function getSubject($MaHphan){
                require_once('./Models/StudentModel.php');
                $model = new StudentModel();
                $data = $model->getSubject($MaHphan);
                // echo $masv;
                return $data;
            }
        }
    ?>