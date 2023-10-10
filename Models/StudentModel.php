<?php
    class StudentModel {
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

            $sql = "UPDATE sinhvien 
            SET hoTen = ?, ngaySinh = ?, gioiTinh = ?, diaChi = ?, email = ?, soDienThoai = ?
            WHERE maSinhVien = ?";
            
            $stmt = mysqli_stmt_init($conn);
            $maSinhVien = $oldInfo[0]['maSinhVien'];
            
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssssss",  $updateHoten, $updateNgaySinh, $updateGioiTinh, $updateDiaChi, $updateEmail, $updateTel, $maSinhVien);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Update successfully!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=home_student';
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

        public function getMaBangDiem($maSV, $khoa) {
            require('./Config/DBConn.php');
            $sql = "SELECT maBangDiem FROM bangdiem WHERE maSinhVien= ? AND hocKy= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ss", $maSV, $khoa);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            return $resultData;
        }

        public function getPoint($maBD) {
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM chitietbangdiem WHERE maBangDiem= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maBD);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            $conn->close();

            return $resultData;
        }
        
        public function getMaHocPhi($maSV, $khoa) {
            require('./Config/DBConn.php');
            $sql = "SELECT maHocPhi FROM hocphi WHERE maSinhVien= ? AND hocKy= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ss", $maSV, $khoa);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            return $resultData;
        }

        public function getTuition($maHP) {
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM chitiethocphi WHERE maHocPhi= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maHP);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            $conn->close();

            return $resultData;
        }

        public function getHP($maKhoa) {
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM hocphan WHERE maKhoa= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maKhoa);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            $rows = array();
            while ($row = mysqli_fetch_assoc($resultData)) {
                $rows[] = $row;
            }

            require_once('./Hooks/StudentHooks.php');
            $filteredRows = array();
            foreach ($rows as $row) {
                if (checkDuplicateSubject($row['maHocPhan'], $conn)) {
                    $filteredRows[] = $row;
                }
            }

            mysqli_stmt_close($stmt);
            $conn->close();

            return $filteredRows;
        }

        public function getClass($maHP) {
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM lop WHERE maHocPhan= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maHP);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            $rows = array();
            while ($row = mysqli_fetch_assoc($resultData)) {
                $rows[] = $row;
            }

            $filteredRows = array();
            foreach ($rows as $row) {
                if ($row['siSo'] < $row['siSoToiDa']) {
                    $filteredRows[] = $row;
                }
            }
            mysqli_stmt_close($stmt);
            $conn->close();

            return $filteredRows;
        }
        
        public function AddRegistSubject($maSV, $hocKy, $malop, $maHP) {
            require('./Config/DBConn.php');
            require_once('./Hooks/StudentHooks.php');
            
            $maDSDK;
            if(checkDuplicateRegistSbj($maSV, $hocKy, $conn)) { 
                // add
                if(checkMatchClass($malop, $maHP, $conn)) {
                    $sql = "INSERT INTO hocphandk (maSinhVien, hocKy) VALUES (?, ?);";
                    $stmt = mysqli_stmt_init($conn);
    
                    if(!mysqli_stmt_prepare($stmt, $sql)) { 
                        header("Location: ./");
                        exit();
                    }
    
                    mysqli_stmt_bind_param($stmt, "ss", $maSV, $hocKy);
                    if(!mysqli_stmt_execute($stmt)) {
                        echo '<script>alert("Failed to add subject")</script>';
                    } else {
                        $sql = "SELECT * FROM hocphandk WHERE maSinhVien= ? AND hocKy= ?;";
                        if(!$stmt) $stmt = mysqli_stmt_init($conn);
            
                        if(!mysqli_stmt_prepare($stmt, $sql)) { 
                            header("Location: ./");
                            exit();
                        }
            
                        mysqli_stmt_bind_param($stmt, "ss", $maSV, $hocKy);
                        mysqli_stmt_execute($stmt);
                        
                        $data = mysqli_stmt_get_result($stmt);
                        while($row = mysqli_fetch_assoc($data)) {
                            $maDSDK = $row['maDSDK'];
                        }
                        
                        mysqli_stmt_close($stmt);
            
                        $conn->close();
                        return $maDSDK;
                    }
                } else {
                    echo '<script>alert("Wrong class!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=regist_subject';
                    </script>";
                }

            } else {
                if(!checkMatchClass($malop, $maHP, $conn)) {
                    echo '<script>alert("Wrong class!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=regist_subject';
                    </script>";
                } else {
                    $sql = "SELECT * FROM hocphandk WHERE maSinhVien= ? AND hocKy= ?;";
                    $stmt = mysqli_stmt_init($conn);
        
                    if(!mysqli_stmt_prepare($stmt, $sql)) { 
                        header("Location: ./");
                        exit();
                    }
        
                    mysqli_stmt_bind_param($stmt, "ss", $maSV, $hocKy);
                    mysqli_stmt_execute($stmt);
                    
                    $data = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($data)) {
                        $maDSDK = $row['maDSDK'];
                    }
                    
                    mysqli_stmt_close($stmt);
        
                    $conn->close();
                    return $maDSDK;
                }
            }
        }

        public function AddRegistSubjectInDetail($maDSDK, $maHocPhan, $maLop) {
            require('./Config/DBConn.php');
            require_once('./Hooks/StudentHooks.php');
            
            if(checkDuplicateRegistedSbj($maHocPhan, $conn)) { 
                // add
                $sql = "INSERT INTO chitiethocphandk (maDSDK, maHocPhan, maLop) VALUES (?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }

                mysqli_stmt_bind_param($stmt, "sss", $maDSDK, $maHocPhan, $maLop);
                if(!mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Failed to add subject")</script>';
                } else {
                    if(!updateClassMem($maLop, $conn)) {
                        echo '<script>alert("Failed to add student to class")</script>';
                    }
                }

                mysqli_stmt_close($stmt);
            } else {
                echo '<script>alert("Subject has existed")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=regist_subject';
                </script>";
            }
            
            $conn->close();
        }

        // add in tuition
        public function AddInTuition($maSV, $maKhoa, $hocKy) {
            require('./Config/DBConn.php');
            require_once('./Hooks/StudentHooks.php');
            
            $maHP;
            if(checkDuplicateTuition($maSV, $hocKy, $conn)) {
                $defaulHP = 0;
                $sql = "INSERT INTO hocphi (maSinhVien, maKhoa, hocKy, tongHocPhi) VALUES (?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
    
                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }
    
                mysqli_stmt_bind_param($stmt, "sssi", $maSV, $maKhoa, $hocKy, $defaulHP);
                
                mysqli_stmt_execute($stmt); 
            } 

            $sql = "SELECT * FROM hocphi WHERE maSinhVien= ? AND hocKy= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ss", $maSV, $hocKy);
            mysqli_stmt_execute($stmt);
            
            $data = mysqli_stmt_get_result($stmt);
            while($row = mysqli_fetch_assoc($data)) {
                $maHP = $row['maHocPhi'];
            }

            mysqli_stmt_close($stmt);

            $conn->close();
            return $maHP;
        }

        public function AddInDetailTuition($maHPhi, $HPDK) {
            require('./Config/DBConn.php');
            require_once('./Hooks/StudentHooks.php');

            $sql = "SELECT * FROM hocphan WHERE maHocPhan= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $HPDK);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            $rows = array();
            while ($row = mysqli_fetch_assoc($resultData)) {
                $rows[] = $row;
            }

            $sql = "INSERT INTO chitiethocphi (maHocPhi, maHocPhan, hocPhiMotTin, soTinChi, thanhTien) VALUES (?, ?, ?, ?, ?);";
            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            $thanhTien = intval($rows[0]['hocPhiMotTin']) * intval($rows[0]['soTinChi']);

            mysqli_stmt_bind_param($stmt, "sssss", $maHPhi, $rows[0]['maHocPhan'], $rows[0]['hocPhiMotTin'], $rows[0]['soTinChi'], $thanhTien);
            if(mysqli_stmt_execute($stmt)) {
                updateTuition($maHPhi, $thanhTien, $conn);
                echo '<script>alert("Successfully added subject")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=regist_subject';
                </script>";
            } else {
                echo '<script>alert("Failed to add subject")</script>';
            }
        }

        public function getSubject($maSV, $hocKy) {
            require('./Config/DBConn.php');

            $sql = "SELECT * FROM hocphandk WHERE maSinhVien= ? AND hocKy= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "ss", $maSV, $hocKy);
            mysqli_stmt_execute($stmt);
            
            $data = mysqli_stmt_get_result($stmt);
            $maDSDK;
            while($row = mysqli_fetch_assoc($data)) {
                $maDSDK = $row['maDSDK'];
            }
            
            $array = array();

            if(isset($maDSDK)) {
                $sql = "SELECT * FROM chitiethocphandk WHERE maDSDK= ?;";

                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }

                mysqli_stmt_bind_param($stmt, "s", $maDSDK);
                mysqli_stmt_execute($stmt);
                
                $data1 = mysqli_stmt_get_result($stmt);
                $arr = array();
                while($row = mysqli_fetch_assoc($data1)) {
                    $arr[] = $row;
                }

                $sql = "SELECT * FROM hocphan WHERE maHocPhan= ?;";

                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }
                foreach($arr as $row) {
                    mysqli_stmt_bind_param($stmt, "s", $row['maHocPhan']);
                    mysqli_stmt_execute($stmt);
                    
                    $data1 = mysqli_stmt_get_result($stmt);
                    while($row = mysqli_fetch_assoc($data1)) {
                        $array[] = $row;
                    }
                }
            }
            
            mysqli_stmt_close($stmt);

            $conn->close();
            return $array;
        }
    }
?>