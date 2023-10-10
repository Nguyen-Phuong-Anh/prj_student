<?php
    class StudentController {
        public function showHeader() {
            require_once('./Views/component/header.php');
        }

        public function showProfileStudent(){
            require_once('./Views/student/profile_student.php');
        }

        public function showChangePwdStudent(){
            require_once('./Views/changePwd.php');
        }

        public function showSubjectStudent(){
            require_once('./Views/student/subject_student.php');
        }

        public function showRegisterSubject() {
            require_once('./Views/student/regist_subject.php');
        }

        public function showStudentSubject() {
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
            if(isset($maBD)) {
                $data = $model->getPoint($maBD);
                return $data;
            }
        }

        public function getStudentTuition($maSV, $khoa) {
            require_once('./Models/StudentModel.php');
            $model = new StudentModel();
            $data1 = $model->getMaHocPhi($maSV, $khoa);
            $maHP;
            while($row = mysqli_fetch_assoc($data1)) {
                $maHP = $row['maHocPhi'];
            }
            if(isset($maHP)) {
                $data = $model->getTuition($maHP);
                return $data;
            }
        }

        public function handleGetHP($maKhoa) {
            require_once('./Models/StudentModel.php');
            $model = new StudentModel();
            $data = $model->getHP($maKhoa);
            return $data;
        }

        public function handlGetClass($maHP) {
            require_once('./Models/StudentModel.php');
            $model = new StudentModel();
            $data = $model->getClass($maHP);
            return $data;
        }

        public function handleRegistSbj($maSV, $maKhoa) {
            require_once('./Models/StudentModel.php');
            $model = new StudentModel();
            $result = $model->AddRegistSubject($maSV, $_POST['hocky_selector'], $_POST['lopDK'], $_POST['hocphanDK']);
            if($result) {
                $model->AddRegistSubjectInDetail($result, $_POST['hocphanDK'], $_POST['lopDK']);
                //them vao hoc phi
                $maHPhi = $model->AddInTuition($maSV, $maKhoa, $_POST['hocky_selector']);
                if(isset($maHPhi)) {
                    $model->AddInDetailTuition($maHPhi, $_POST['hocphanDK']);
                }                 
            }
        }

        public function handleGetStudentSbj($maSV) {
            require_once('./Models/StudentModel.php');
            $model = new StudentModel();
            $data = $model->getSubject($maSV, $_POST['hocky_selector']);
            return $data;
        }

        public function handleUpdateStudent($oldInfo) {
            require_once('./Models/StudentModel.php');
            $model = new StudentModel($oldInfo);
            $model->updateStudent($oldInfo);
        }
    }
?>