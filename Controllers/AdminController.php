<?php
    class AdminController {
        public function showManageAccount() {
            require_once('./Views/admin/manage_account.php');
        }
        public function showStudentList() {
            require_once('./Views/admin/student/student_list.php');
        }
        public function showAddStudent() {
            require_once('./Views/admin/student/add_student.php');
        }
        public function showStudentInfo() {
            require_once('./Views/admin/student/student_info.php');
        }

        public function showLecturerList() {
            require_once('./Views/admin/lecturer/lecturer_list.php');
        }

        public function showSubjectList() {
            require_once('./Views/admin/subject_list.php');
        }
        
        public function showClassList() {
            require_once('./Views/admin/class/class_list.php');
        }

        public function showSubjectInfo() {
            require_once('./Views/admin/subject_info.php');
        }

        public function showAddSubject() {
            require_once('./Views/admin/add_subject.php');
        }
       
        public function showAddClass() {
            require_once('./Views/admin/class/add_class.php');
        }

        public function showAddLecturer() {
            require_once('./Views/admin/lecturer/add_lecturer.php');
        }

        public function showLecturerInfo() {
            require_once('./Views/admin/lecturer/lecturer_info.php');
        }

        public function showLecturerAddClass() {
            require_once('./Views/admin/lecturer/lecturer_class.php');
        }

        public function showTuitionList() {
            require_once('./Views/admin/student/tuition_list.php');
        }
        public function showTuitionInfo() {
            require_once('./Views/admin/student/tuition_info.php');
        }
         public function showProfileStudent() {
            require_once('./Views/student/profile_student.php');
        }

        public function handleSearchAccount() {
            $search = $_POST['search']; //
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getSearchAccount($search);
            return $data;
        }

        public function handleAddAccount() {
            if(!$_POST['username'] || !$_POST['password'] || !$_POST['role']) {
                echo '<script>alert("Please fill all the information")</script>';
                header("Location: ./");
            } else {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];
    
                require_once('./Models/AdminModel.php');
                $model = new AdminModel();
                $model->addAccount($username, $password, $role);
            }
        }

        public function handleChangeAccount() {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->changeAccount($username, $password, $role);
        }

        public function handleDeleteAccount() {
            $username = $_POST['tenTK'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->deleteAccount($username);
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
            } else {
                $maSV = $_POST['maSV'];
                $khoa = $_POST['khoa_selector'];
                $hocKy = $_POST['hocKy'];
                $nienKhoa = $_POST['nienKhoa'];
                $hoTen = $_POST['hoTen'];
                $ngaySinh = $_POST['ngaySinh'];
                $gioiTinh = $_POST['gioiTinh'];
                $diaChi = $_POST['diaChi'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
    
                require_once('./Models/AdminModel.php');
                $model = new AdminModel();
                if($model->addStudent($maSV, $khoa, $hocKy, $nienKhoa, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $tel)) {
                    $model->addAccount($maSV, $maSV, '103');
                }
            }
        }

        public function handleAddLecturer() {
            if(!$_POST['maNV'] || !$_POST['khoa_selector'] || !$_POST['hoTen'] || !$_POST['ngaySinh'] || !$_POST['gioiTinh'] || !$_POST['diaChi']) {
                echo '<script>alert("Please fill all the information")</script>';
                header("Location: ./");
            } else {
                $maNV = $_POST['maNV'];
                $khoa = $_POST['khoa_selector'];
                $hoTen = $_POST['hoTen'];
                $ngaySinh = $_POST['ngaySinh'];
                $gioiTinh = $_POST['gioiTinh'];
                $diaChi = $_POST['diaChi'];
                $chucVu = $_POST['chucVu'];
                $email = $_POST['email'];
                $tel = $_POST['tel'];
    
                require_once('./Models/AdminModel.php');
                $model = new AdminModel();
                $model->addLecturer($maNV, $khoa, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $chucVu, $email, $tel);
                $model->addAccount($maNV, $maNV, '102');
            }
        }

        public function handleAddSubject() {
            if(!$_POST['maHocPhan'] || !$_POST['khoa_selector'] || !$_POST['tenMonHoc'] || !$_POST['soTinChi'] || !$_POST['hocPhiMotTin']) {
                echo '<script>alert("Please fill all the information")</script>';
                header("Location: ./");
            } else {
                $maHocPhan = $_POST['maHocPhan'];
                $khoa = $_POST['khoa_selector'];
                $tenMonHoc = $_POST['tenMonHoc'];
                $soTinChi = $_POST['soTinChi'];
                $batBuoc = $_POST['batBuoc'];
                $hocPhiMotTin = $_POST['hocPhiMotTin'];
    
                require_once('./Models/AdminModel.php');
                $model = new AdminModel();
                $model->addSubject($maHocPhan, $khoa, $tenMonHoc, $soTinChi, $batBuoc, $hocPhiMotTin);
            }
        }
        
        public function handleAddClass() {
            if(!$_POST['maLop'] || !$_POST['subject_selector'] || !$_POST['siSoToiDa'] || !$_POST['thoiGian'] || !$_POST['diaDiem']) {
                echo '<script>alert("Please fill all the information")</script>';
                header("Location: ./");
            } else {
                $maHP = $_POST['subject_selector'];
                $maLop = $_POST['maLop'];
                $siSo = $_POST['siSo'];
                $siSoToiDa = $_POST['siSoToiDa'];
                $thoiGian = $_POST['thoiGian'];
                $diaDiem = $_POST['diaDiem'];

                require_once('./Models/AdminModel.php');
                $model = new AdminModel();
                $model->addClass($maHP, $maLop, $siSo, $siSoToiDa, $thoiGian, $diaDiem);
            }
        }

        public function handleAddLecturerClass() {
            $maNV = $_GET['param'];
            $maLop = $_POST['maLop_add'];
            $maHP = $_POST['maHocPhan_add'];
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->addLecturerClass($maNV, $maLop, $maHP);
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

        public function handleSearchTuition() {
            if(!$_POST['maSV']) {
                $maSV = '';
            } else $maSV = $_POST['maSV'];
            if($_POST['khoa_selector'] === 'Khoa') {
                $khoa = '';
            } else $khoa = $_POST['khoa_selector'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getSearchTuition($maSV, $khoa);
            return $data;
        }

        public function handleSearchSubject() {
            if($_POST['khoa_selector'] === 'Khoa') {
                $khoa = '';
            } else $khoa = $_POST['khoa_selector'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getSearchSubject($khoa);
            return $data;
        }

        public function handleSearchSubject_Class() {
            $khoa = $_GET['maKhoa'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getSearchSubject($khoa);
            return $data;
        }

        public function handleSearchClass() {
            if($_POST['subject_selector'] === 'Học phần') {
                $maHP = '';
            } else $maHP = $_POST['subject_selector'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getSearchClass($maHP);
            return $data;
        }

        public function handleSearchLecturer() {
            if(!$_POST['maNV']) {
                $maNV = '';
            } else $maNV = $_POST['maNV'];
            if($_POST['khoa_selector'] === 'Khoa') {
                $khoa = '';
            } else $khoa = $_POST['khoa_selector'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getSearchLecturer($maNV, $khoa);
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
        
        public function handleGetTuition() {
            $maHphi = $_GET['param'];
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getTuition($maHphi);
            return $data;
        }
        
        public function handleGetSubject() {
            $maHphan = $_GET['param'];
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getSubject($maHphan);
            $khoa = $model->getKhoa();
            $array = array();
            $array = [$data, $khoa];
            return $array;
        }
        
        public function handleGetLecturer() {
            $maNV = $_GET['param'];
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getLecturer($maNV);
            $khoa = $model->getKhoa();
            $lop = $model->getLop($maNV);
            $array = array();
            $array = [$data, $khoa, $lop];
            return $array;
        }

        public function handleUpdateStudent($oldInfo) {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->updateStudent($oldInfo);
        }
        
        public function handleUpdateSubject($oldInfo) {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->updateSubject($oldInfo);
        }

        public function handleUpdateClass() {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->updateClass();
        }

        public function handleUpdateLecturer($oldInfo) {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->updateLecturer($oldInfo);
        }

        public function handleDeleteStudent($maSV) {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->deleteStudent($maSV);
        }
        
        public function handleDeleteSubject($maMH) {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->deleteSubject($maMH);
        }
        
        public function handleDeleteClass() {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->deleteClass();
        }
        
        public function handleDeleteLecturer($maNV) {
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->deleteLecturer($maNV);
        }
        
    }
?>