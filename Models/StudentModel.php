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
                if (!checkDuplicateSubject($row['maHocPhan'], $conn)) {
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
                }
            }

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
                    if(updateClassMem($maLop, $conn)) {
                        echo '<script>alert("Successfully added subject")</script>';
                        echo "<script>
                        window.location = 'http://localhost/prj_student/?route=regist_subject';
                        </script>";
                    } else {
                        echo '<script>alert("Failed to add subject")</script>';
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
    }
?>