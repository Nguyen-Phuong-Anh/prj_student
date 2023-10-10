<?php
    class LecturerController {
        public function showLecturerProfile() {
                require_once('./Views/lecturer/profile_lecturer.php');
        }

        public function showChangePwdLecturer(){
            require_once('./Views/changePwd.php');
        }

        public function showStudentSearch() {
            require_once('./Views/lecturer/search_student.php');
        }

        public function showStudentPoint() {
            require_once('./Views/lecturer/point_student.php');
        }
        
        public function showStudentAddPoint() {
            require_once('./Views/lecturer/addPoint_student.php');
        }
        
        public function showAddPoint() {
            require_once('./Views/lecturer/std_Point.php');
        }

        public function getLecturerInfo($maNV) {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getLecturer($maNV);
            require_once('./Models/StudentModel.php');
            $model1 = new StudentModel();
            $khoa = $model1->getKhoa($data[0]['maKhoa']);
            $array = array();
            $array = [$data, $khoa];
            return $array;
        }

        public function handleUpdateLecturer($oldInfo) {
            require_once('./Models/LecturerModel.php');
            $model = new LecturerModel($oldInfo);
            $model->updateLecturer($oldInfo);
        }
        
        public function handleSearchStudent() {
            require_once('./Models/LecturerModel.php');
            $model = new LecturerModel();
            $data = $model->searchStudent($_POST['khoa'], $_POST['maSV']);
            return $data;
        }

        public function handleGetPoint() {
            $maSV = $_GET['maSV'];
            //get mabd
            if(!$_POST['hocky_selector']) {
                echo '<script>alert("Please choose the semester!")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=getStudent_info';
                </script>";
            } else {
                require_once('./Models/StudentModel.php');
                $model = new StudentModel();
                $data1 = $model->getMaBangDiem($maSV, $_POST['hocky_selector']);
                $maBD;
                while($row = mysqli_fetch_assoc($data1)) {
                    $maBD = $row['maBangDiem'];
                }
                $result = array();
                if(isset($maBD)) {
                    $data = $model->getPoint($maBD);
                    $result = [$maBD, $data];
                    return $result;
                }
            }
        }

        public function handleChangePoint() {
            require_once('./Models/LecturerModel.php');
            $model = new LecturerModel();
            $model->changePoint();
        }

        public function handleUpdatePoint() {
            require_once('./Models/LecturerModel.php');
            $model = new LecturerModel();
            $model->updatePoint();
        }

        public function handleAddPoint() {
            $maSV = $_GET['maSV'];
            $hocKy = $_POST['hocKy'];
        require_once('./Models/LecturerModel.php');
            $model = new LecturerModel();
            $model->addPoint($maSV, $hocKy);
        }

        public function handleGetHPName($maHP) {
            require_once('./Models/LecturerModel.php');
            $model = new LecturerModel();
            $data = $model->getHPName($maHP);
            return $data;
        }

    }
?>