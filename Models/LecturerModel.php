<?php
    class LecturerModel {
        public function updateLecturer($oldInfo) {
            require('./Config/DBConn.php');
            $updateHoten = isset($_POST['hoTen']) ? $_POST['hoTen'] : $oldInfo[0]['hoTen'];
            $updateNgaySinh = isset($_POST['ngaySinh']) ? $_POST['ngaySinh'] : $oldInfo[0]['ngaySinh'];
            $updateGioiTinh = isset($_POST['gioiTinh']) ? $_POST['gioiTinh'] : $oldInfo[0]['gioiTinh'];
            $updateDiaChi = isset($_POST['diaChi']) ? $_POST['diaChi'] : $oldInfo[0]['diaChi'];
            $updateEmail = isset($_POST['email']) ? $_POST['email'] : $oldInfo[0]['email'];
            $updateTel = isset($_POST['tel']) ? $_POST['tel'] : $oldInfo[0]['soDienThoai'];

            $sql = "UPDATE giangvien 
            SET hoTen = ?, ngaySinh = ?, gioiTinh = ?, diaChi = ?, email = ?, soDienThoai = ?
            WHERE maNhanVien = ?";
            
            $stmt = mysqli_stmt_init($conn);
            $maNhanVien = $oldInfo[0]['maNhanVien'];
            
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssssss",  $updateHoten, $updateNgaySinh, $updateGioiTinh, $updateDiaChi, $updateEmail, $updateTel, $maNhanVien);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Update successfully!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=home_lecturer';
                    </script>";
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

        public function searchStudent($khoa, $maSV) {
            require('./Config/DBConn.php');
            $searchmaSV = "%{$maSV}%";
            $searchkhoa = "%{$khoa}%";
            $sql = "SELECT maSinhVien, maKhoa, khoa, hoTen, ngaySinh, gioiTinh FROM sinhvien WHERE maSinhVien LIKE ? AND maKhoa LIKE ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ss", $searchmaSV, $searchkhoa);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            return $resultData;

            mysqli_stmt_close($stmt);
            $conn->close();
        }

        public function changePoint() {
            require('./Config/DBConn.php');

            $maBD = $_POST['maBD'];
            $maHocPhan = $_POST['maHocPhan'];
            $diemCC = $_POST['diemCC'];
            $diemTH = $_POST['diemTH'];
            $diemTL = $_POST['diemTL'];
            $diemKetThuc = $_POST['diemKetThuc'];

            $sql = "UPDATE chitietbangdiem 
            SET diemCC = ?, diemTH = ?, diemTL = ?, diemKetThuc = ?
            WHERE maHocPhan = ? AND maBangDiem= ?";
            
            $stmt = mysqli_stmt_init($conn);
            
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ddddss",  $diemCC, $diemTH, $diemTL, $diemKetThuc, $maHocPhan, $maBD);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Update successfully!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=getStudent_info';
                    </script>";
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

        public function updatePoint() {
            require('./Config/DBConn.php');

            $maBD = $_POST['maBD'];
            $maHocPhan = $_POST['maHocPhan'];
            $diemCC = floatval($_POST['diemCC']);
            $diemTH = floatval($_POST['diemTH']);
            $diemTL = floatval($_POST['diemTL']);
            $diemKetThuc = floatval($_POST['diemKetThuc']);

            $diemTK = ($diemCC + $diemTH + $diemTL + $diemKetThuc) / 4;
            $diemChu;
            switch ($diemTK) {
                case $diemTK < 6:
                    $diemChu = 'D';
                    break;
                case $diemTK <= 7:
                    $diemChu = 'C';
                    break;
                case $diemTK <= 8:
                    $diemChu = 'B';
                    break;
                case $diemTK <= 9:
                    $diemChu = 'A';
                    break;
            }

            $sql = "UPDATE chitietbangdiem 
            SET diemTongKet = ?, diemChu = ?
            WHERE maHocPhan = ? AND maBangDiem= ?";
            
            $stmt = mysqli_stmt_init($conn);
            
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "dsss",  $diemTK, $diemChu, $maHocPhan, $maBD);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Update successfully!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=getStudent_info';
                    </script>";
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

        public function getHPName($maHP) {
            require('./Config/DBConn.php');

            $sql = "SELECT tenMonHoc FROM hocphan WHERE maHocPhan= ?;";
            $stmt = mysqli_stmt_init($conn); 

            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s",$maHP); //
            
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_assoc($resultData)) {
                if(isset($row['tenMonHoc'])) {
                    return $row['tenMonHoc'];
                }
            }
        }

        public function addPoint($maSV, $hocKy) {
            require_once('./Config/DBConn.php');
            require_once('./Hooks/LecturerHooks.php');

            if(checkExistMaBD($maSV, $hocKy, $conn) === FALSE) {
                $sql = "INSERT INTO bangdiem (maSinhVien, hocKy) VALUES (?, ?);";
                $stmt = mysqli_stmt_init($conn);
                

                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }

                mysqli_stmt_bind_param($stmt, "ss", $maSV, $hocKy);

                if(mysqli_stmt_execute($stmt)) {
                    
                } 
                mysqli_stmt_close($stmt);
            }

            $sql = "SELECT maBangDiem FROM bangdiem WHERE maSinhVien= ? AND hocKy= ?;";
            $stmt1 = mysqli_stmt_init($conn);
            
            if(!mysqli_stmt_prepare($stmt1, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt1, "ss", $maSV, $hocKy);
            mysqli_stmt_execute($stmt1);

            $resultData = mysqli_stmt_get_result($stmt1);
            $maBD;
            while($row = mysqli_fetch_assoc($resultData)) {
                $maBD = $row['maBangDiem'];
                break;
            }
            $maHocPhan = isset($_POST['hocPhan_selector']) ? $_POST['hocPhan_selector'] : 0;

            //check mahp
            if(checkExistMaHP($maHocPhan, $conn)) {
                echo '<script>alert("Student point existed!")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=add_stdPoint';
                </script>";
            } else {
                $diemCC = isset($_POST['diemCC']) ? floatval($_POST['diemCC']) : 0;
                $diemTH = isset($_POST['diemTH']) ? floatval($_POST['diemTH']) : 0;
                $diemTL = isset($_POST['diemTL']) ? floatval($_POST['diemTL']) : 0;
                $diemKetThuc = isset($_POST['diemKetThuc']) ? floatval($_POST['diemKetThuc']) : 0;

                $sql = "INSERT INTO chitietbangdiem 
                (maBangDiem, maHocPhan, diemCC, diemTH, diemTL, diemKetThuc) VALUES (?, ?, ?, ?, ?, ?)";
                
                $stmt = mysqli_stmt_init($conn);
                
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "isdddd", $maBD, $maHocPhan, $diemCC, $diemTH, $diemTL, $diemKetThuc);
    
                    if (mysqli_stmt_execute($stmt)) {
                        echo '<script>alert("Add student point successfully!")</script>';
                        echo "<script>
                        window.location = 'http://localhost/prj_student/?route=add_stdPoint';
                        </script>";
                    } else {
                        echo '<script>alert("Add student point failed!")</script>';
                    }
    
                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ./");
                    exit();
                }                
            }
            
            $conn->close();
        }
    }
?>