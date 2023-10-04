<?php
    class StudentController {
        public function showHeader() {
            require_once('./Views/component/header.php');
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

        public function getStudentInfo($maSV) {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getStudent($maSV);
            require_once('./Models/StudentModel.php');
            $model1 = new StudentModel();
            $khoa = $model1->getKhoa($data[0]['maKhoa']);
            $array = array();
            $array = [$data, $khoa];
            return $array;
        }

        public function getStudentPoint($maSV, $khoa) {
            require_once('./Models/StudentModel.php');
            $model = new StudentModel();
            $data1 = $model->getMaBangDiem($maSV, $khoa);
            $maBD;
            while($row = mysqli_fetch_assoc($data1)) {
                $maBD = $row['maBangDiem'];
            }
            $data = $model->getPoint($maBD);
            return $data;
        }

        public function getStudentTuition($maSV, $khoa) {
            require_once('./Models/StudentModel.php');
            $model = new StudentModel();
            $data1 = $model->getMaHocPhi($maSV, $khoa);
            $maHP;
            while($row = mysqli_fetch_assoc($data1)) {
                $maHP = $row['maHocPhi'];
            }
            $data = $model->getTuition($maHP);
            return $data;
        }

    }
?>