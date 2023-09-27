<?php
    class AdminController {
        public function showAddStudent() {
            require_once('./Views/admin/add_student.php');
        }

        public function showManageAccount() {
            require_once('./Views/admin/manage_account.php');
        }

        public function showStudentList() {
            require_once('./Views/admin/student_list.php');
        }

        public function showStudentInfo() {
            require_once('./Views/admin/student_info.php');
        }

        public function handleSearchAccount() {
            $search = $_POST['search'];
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getSearchAccount($search);
            return $data;
        }

        public function handleAddAccount() {
            if(!$_POST['username'] || !$_POST['password'] || !$_POST['role']) {
                echo '<script>alert("Please fill all the information")</script>';
                header("Location: ./");
            }
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->addAccount($username, $password, $role);
        }

        public function handleChangeAccount() {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->changeAccount($username, $password, $role);
        }

        public function showKhoa() {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getKhoa();
            return $data;
        }

        public function handleAddStudent() {
            if(!$_POST['maSV'] || !$_POST['khoa_selector'] || !$_POST['hoTen'] || !$_POST['ngaySinh'] || !$_POST['gioiTinh'] || !$_POST['diaChi']) {
                echo '<script>alert("Please fill all the information")</script>';
                header("Location: ./");
            }
            $maSV = $_POST['maSV'];
            $khoa = $_POST['khoa_selector'];
            $hocKy = $_POST['hocKy'];
            $hoTen = $_POST['hoTen'];
            $ngaySinh = $_POST['ngaySinh'];
            $gioiTinh = $_POST['gioiTinh'];
            $diaChi = $_POST['diaChi'];
            $email = $_POST['email'];
            $tel = $_POST['tel'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->addStudent($maSV, $khoa, $hocKy, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $tel);
            $model->addAccount($maSV, $maSV, '103');
        }

        //search
        public function handleSearchStudent() {
            if(!$_POST['maSV']) {
                $maSV = '';
            } else $maSV = $_POST['maSV'];
            if(!$_POST['nienKhoa']) {
                $nienKhoa = '';
            } else $nienKhoa = $_POST['nienKhoa'];
            if($_POST['khoa_selector'] === 'Khoa') {
                $khoa = '';
            } else $khoa = $_POST['khoa_selector'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getSearchStudent($maSV, $nienKhoa, $khoa);
            return $data;
        }

        public function handleGetStudent() {
            $maSV = $_GET['param'];
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getStudent($maSV);
            $khoa = $model->getKhoa();
            $array = array();
            $array = [$data, $khoa];
            return $array;
        }

        public function handleUpdateStudent($oldInfo) {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel($oldInfo);
            $model->updateStudent($oldInfo);
        }
    }
?>