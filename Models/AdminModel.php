<?php 
    class AdminModel {
        public function getSearchAccount($search) {
            require_once('./Config/DBConn.php');
            $searchTerm = "%{$search}%";
            $sql = "SELECT * FROM taikhoan WHERE tenTaiKhoan LIKE ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $searchTerm);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            return $resultData;

            mysqli_stmt_close($stmt);
            $conn->close();
        }

        public function addAccount($username, $password, $role) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');
            
            //check duplicate
            if(!checkAccountDuplicate($username, $conn)) { 
                // add
                $sql = "INSERT INTO taikhoan (tenTaiKhoan, matKhau, maVaiTro) VALUES (?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }

                //hashed the password
                $hashedPwd = hashPwd($password);

                mysqli_stmt_bind_param($stmt, "sss", $username, $hashedPwd, $role);

                if(mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Successfully added account")</script>';
                } else {
                    echo '<script>alert("Failed to add account")</script>';
                }

                mysqli_stmt_close($stmt);
            } else {
                echo '<script>alert("Account existed!")</script>';
            }
            
            $conn->close();
        }

        public function changeAccount($username, $password, $role) {
            require_once('./Config/DBConn.php');
            $sql = "UPDATE taikhoan SET maVaiTro = ?, matKhau = ? WHERE tenTaiKhoan = ?;";

            require_once('./Hooks/AdminHooks.php');

            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }
            
            $hashedPwd = hashPwd($password);
            mysqli_stmt_bind_param($stmt, "sss", $role, $hashedPwd, $username);

            if(mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Successfully make changes to the account")</script>';
            } else {
                echo '<script>alert("Failed to make changes account")</script>';
            }

            mysqli_stmt_close($stmt);
            
            $conn->close();
        }

        public function getKhoa() {
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM khoa WHERE 1;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            return $resultData;

            mysqli_stmt_close($stmt);
            $conn->close();
        }
        
        public function addStudent($maSV, $khoa, $hocKy, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $tel) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');

            //check duplicate
            if(!checkStudentDuplicate($maSV, $conn)) { 
                // add
                $sql = "INSERT INTO sinhvien (tenTaiKhoan, maSinhVien, maKhoa, khoa, hocKyHienTai, hoTen, ngaySinh, gioiTinh, diaChi, email, soDienThoai) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }

                $nienKhoa = '74';
                mysqli_stmt_bind_param($stmt, "sssssssssss", $maSV, $maSV, $khoa, $nienKhoa, $hocKy, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $tel);

                if(mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Successfully added student")</script>';
                } else {
                    echo '<script>alert("Failed to add student")</script>';
                }
    
                mysqli_stmt_close($stmt);
            } else {
                echo '<script>alert("Student existed!")</script>';
            }
            
            $conn->close();
        }

        public function getSearchStudent($maSV, $nienKhoa, $khoa) {
            require('./Config/DBConn.php');
            $searchmaSV = "%{$maSV}%";
            $searchnienKhoa = "%{$nienKhoa}%";
            $searchkhoa = "%{$khoa}%";
            $sql = "SELECT maSinhVien, khoa, hoTen, ngaySinh, gioiTinh FROM sinhvien WHERE maSinhVien LIKE ? OR hocKyHienTai LIKE ? OR khoa LIKE ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "sss", $searchmaSV, $searchnienKhoa, $searchkhoa);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            return $resultData;

            mysqli_stmt_close($stmt);
            $conn->close();
        }

        public function getStudent($maSV) {
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM sinhvien WHERE maSinhVien= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maSV);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            $rows = array();
            while ($row = mysqli_fetch_assoc($resultData)) {
                $rows[] = $row;
            }
            
            mysqli_stmt_close($stmt);
            $conn->close();

            return $rows;
        }

        public function updateStudent($oldInfo) {
            require('./Config/DBConn.php');
            $updateHoten = isset($_POST['hoTen']) ? $_POST['hoTen'] : $oldInfo[0]['hoTen'];
            $updateNgaySinh = isset($_POST['ngaySinh']) ? $_POST['ngaySinh'] : $oldInfo[0]['ngaySinh'];
            $updateGioiTinh = isset($_POST['gioiTinh']) ? $_POST['gioiTinh'] : $oldInfo[0]['gioiTinh'];
            $updateDiaChi = isset($_POST['diaChi']) ? $_POST['diaChi'] : $oldInfo[0]['diaChi'];
            $updateEmail = isset($_POST['email']) ? $_POST['email'] : $oldInfo[0]['email'];
            $updateTel = isset($_POST['tel']) ? $_POST['tel'] : $oldInfo[0]['soDienThoai'];
            $updateNienKhoa = isset($_POST['nienKhoa']) ? $_POST['nienKhoa'] : $oldInfo[0]['khoa'];
            $updateKhoaSelector = isset($_POST['khoa_selector']) ? $_POST['khoa_selector'] : $oldInfo[0]['maKhoa'];
            $updateHocKy = isset($_POST['hocKy']) ? $_POST['hocKy'] : $oldInfo[0]['hocKyHienTai'];

            $sql = "UPDATE sinhvien 
            SET hoTen = ?, ngaySinh = ?, gioiTinh = ?, diaChi = ?, email = ?, soDienThoai = ?, khoa = ?, maKhoa = ?, hocKyHienTai = ?
            WHERE maSinhVien = ?";
            
            $stmt = mysqli_stmt_init($conn);
            $maSinhVien = $oldInfo[0]['maSinhVien'];
            
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssssssss",  $updateHoten, $updateNgaySinh, $updateGioiTinh, $updateDiaChi, $updateEmail, $updateTel, $updateNienKhoa, $updateKhoaSelector, $updateHocKy, $maSinhVien);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Update successful!")</script>';
                } else {
                    echo '<script>alert("Update failed!")</script>';
                }

                mysqli_stmt_close($stmt);
            } else {
                header("Location: ./");
                exit();
            }
            
            $conn->close();
        }
    }
?>