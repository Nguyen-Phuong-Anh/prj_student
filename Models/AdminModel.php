<?php 
    class AdminModel {
        public function getSearchAccount($search) {
            require_once('./Config/DBConn.php'); //knoi db
            $searchTerm = "%{$search}%"; //tim kiem gan dung
            $sql = "SELECT * FROM taikhoan WHERE tenTaiKhoan LIKE ?;";
            $stmt = mysqli_stmt_init($conn); //dtg cbi thuc thi cau lenh truy van den db

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $searchTerm); //string s, int i
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            $conn->close();

            return $resultData;
        }

        public function addAccount($username, $password, $role) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');
            
            //check duplicate
            if(checkAccountDuplicate($username, $conn)) { 
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
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=home';
                    </script>";
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
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=home';
                </script>";
            } else {
                echo '<script>alert("Failed to make changes account")</script>';
            }

            mysqli_stmt_close($stmt);
            
            $conn->close();
        }

        public function deleteAccount($username) {
            require('./Config/DBConn.php');

            $sql = "DELETE FROM taikhoan WHERE tenTaiKhoan= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }
            
            mysqli_stmt_bind_param($stmt, "s", $username);
            if(mysqli_stmt_execute($stmt)) {
                echo '<script>alert("Successfully delete account")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=home';
                </script>";
            } else {
                echo '<script>alert("Failed to delete account")</script>';
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
            mysqli_stmt_close($stmt);
            $conn->close();
            
            return $resultData;
        }

        public function getLop($maNV) {
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM lop WHERE maGV= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }
            mysqli_stmt_bind_param($stmt, "s", $maNV);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            $conn->close();
            
            return $resultData;
        }
        
        public function addStudent($maSV, $khoa, $hocKy, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $email, $tel) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');

            //check duplicate
            if(checkStudentDuplicate($maSV, $conn)) { 
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
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=add_student';
                    </script>";
                } else {
                    echo '<script>alert("Failed to add student")</script>';
                }
    
                mysqli_stmt_close($stmt);
                $conn->close();
                return TRUE;
            } else {
                echo '<script>alert("Student existed!")</script>';
                return FALSE;
            }
        }

        public function addLecturer($maNV, $khoa, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $chucVu, $email, $tel) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');

            //check duplicate
            if(checkLecturerDuplicate($maNV, $conn)) { 
                // add
                $sql = "INSERT INTO giangvien (tenTaiKhoan, maNhanVien, maKhoa, hoTen, ngaySinh, gioiTinh, diaChi, chucVu, email, soDienThoai) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }

                mysqli_stmt_bind_param($stmt, "ssssssssss", $maNV, $maNV, $khoa, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $chucVu, $email, $tel);

                if(mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Successfully added lecturer")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=add_lecturer';
                    </script>";
                } else {
                    echo '<script>alert("Failed to add lecturer")</script>';
                }
    
                mysqli_stmt_close($stmt);
            } else {
                echo '<script>alert("Lecturer existed!")</script>';
            }
            
            $conn->close();
        }

        public function addLecturerClass($maNV, $maLop, $maHP) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');

            if(checkLecturerClassDuplicate($maNV, $maLop, $conn)) {
                $stmt = mysqli_stmt_init($conn);
                $sql = "UPDATE lop
                SET
                    maGV = ?
                WHERE
                    maLop = ? AND maHocPhan= ?;
                ";
                if (mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sss", $maNV, $maLop, $maHP);

                    if (mysqli_stmt_execute($stmt)) {
                        echo '<script>alert("Assigned successfully!")</script>';
                        echo "<script>
                        window.location = 'http://localhost/prj_student/?route=lecturer_list';
                        </script>";
                    } else {
                        echo '<script>alert("Assign failed!")</script>';
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    header("Location: ./");
                    exit();
                }
                
                $conn->close();
            } else {
                echo '<script>alert("Class assigned!")</script>';
            }
        }

        public function addSubject($maHocPhan, $khoa, $tenMonHoc, $soTinChi, $batBuoc, $hocPhiMotTin) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');

            if(checkSubjectDuplicate($maHocPhan, $conn)) {
                $sql = "INSERT INTO hocphan (maHocPhan, maKhoa, tenMonHoc, soTinChi, batBuoc, hocPhiMotTin) VALUES (?, ?, ?, ?, ?, ?);";
                
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }

                mysqli_stmt_bind_param($stmt, "ssssss", $maHocPhan, $khoa, $tenMonHoc, $soTinChi, $batBuoc, $hocPhiMotTin);

                if(mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Successfully added subject")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=add_subject';
                    </script>";
                } else {
                    echo '<script>alert("Failed to add subject")</script>';
                }
                mysqli_stmt_close($stmt);
            } else {
                echo '<script>alert("Subject existed!")</script>';
            }
            $conn->close();
        }

        public function addClass($maHP, $maLop, $tenLop, $siSo, $siSoToiDa, $thoiGian, $diaDiem) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');

            if(checkClassDuplicate($maLop, $conn)) {
                $sql = "INSERT INTO lop (tenLop, siSo, siSoToiDa, maHocPhan, thoiGian, diaDiem) VALUES (?, ?, ?, ?, ?, ?);";
                
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }

                mysqli_stmt_bind_param($stmt, "siisss", $tenLop, $siSo, $siSoToiDa, $maHP, $thoiGian, $diaDiem);

                if(mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Successfully added class")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=add_class';
                    </script>";
                } else {
                    echo '<script>alert("Failed to add class")</script>';
                }
                mysqli_stmt_close($stmt);
            } else {
                echo '<script>alert("Class existed!")</script>';
            }
            $conn->close();
        }

        public function getSearchStudent($maSV, $nienKhoa, $khoa) {
            require('./Config/DBConn.php');
            $searchmaSV = "%{$maSV}%";
            $searchnienKhoa = "%{$nienKhoa}%";
            $searchkhoa = "%{$khoa}%";

            if($maSV === '' && $nienKhoa === '' && $khoa === '') {
                echo '<script>alert("Please enter information!")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=student_list';
                </script>";
            }
            $sql = "SELECT maSinhVien, khoa, hoTen, ngaySinh, gioiTinh FROM sinhvien WHERE maSinhVien LIKE ? AND khoa LIKE ? AND maKhoa LIKE ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "sss", $searchmaSV, $searchnienKhoa, $searchkhoa);
            mysqli_stmt_execute($stmt);
            
            $resultData = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            $conn->close();

            return $resultData;
        }

        public function getSearchTuition($maSV, $khoa) {
            require('./Config/DBConn.php');
            $searchmaSV = "%{$maSV}%";
            $searchkhoa = "%{$khoa}%";

            if($maSV === '' && $khoa === '') {
                echo '<script>alert("Please enter information!")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=tuition';
                </script>";
            }

            $sql = "SELECT * FROM hocphi WHERE maSinhVien LIKE ? AND maKhoa LIKE ?;";
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

        public function getSearchSubject($khoa) {
            if($khoa === '') {
                echo '<script>alert("Please enter information!")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=subject_list';
                </script>";
            }
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM hocphan WHERE maKhoa= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $khoa);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            return $resultData;

            mysqli_stmt_close($stmt);
            $conn->close();
        }

        public function getSearchClass($maHP) {
            if($maHP === '') {
                echo '<script>alert("Please enter information!")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=class_list';
                </script>";
            }
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
            mysqli_stmt_close($stmt);
            $conn->close();
            
            return $resultData;
        }

        public function getSearchLecturer($maSV, $khoa) {
            $searchmaSV = "%{$maSV}%";
            $searchkhoa = "%{$khoa}%";
            if($maSV === '' && $khoa === '') {
                echo '<script>alert("Please enter the information")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=lecturer_list';
                </script>";
            } else {
                require('./Config/DBConn.php');
                $sql = "SELECT maNhanVien, hoTen, ngaySinh, gioiTinh, chucVu FROM giangvien WHERE maNhanVien LIKE ? AND maKhoa LIKE ?;";
                $stmt = mysqli_stmt_init($conn);
    
                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }
    
                mysqli_stmt_bind_param($stmt, "ss", $searchmaSV, $searchkhoa);
                mysqli_stmt_execute($stmt);
    
                $resultData = mysqli_stmt_get_result($stmt);

                mysqli_stmt_close($stmt);
                $conn->close();

                return $resultData;
            }
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
        
        public function getSubject($maHphan) {
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM hocphan WHERE maHocPhan= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maHphan);
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

        public function getTuition($maHphi) {
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM chitiethocphi WHERE maHocPhi= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maHphi);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);

            mysqli_stmt_close($stmt);
            $conn->close();

            return $resultData;
        }

        public function getLecturer($maNV) {
            require('./Config/DBConn.php');
            $sql = "SELECT * FROM giangvien WHERE maNhanVien= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maNV);
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
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=student_list';
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

        public function updateLecturer($oldInfo) {
            require('./Config/DBConn.php');
            $hoTen = isset($_POST['hoTen']) ? $_POST['hoTen'] : $oldInfo[0]['hoTen'];
            $maKhoa = isset($_POST['maKhoa']) ? $_POST['maKhoa'] : $oldInfo[0]['maKhoa'];
            $ngaySinh = isset($_POST['ngaySinh']) ? $_POST['ngaySinh'] : $oldInfo[0]['ngaySinh'];
            $gioiTinh = isset($_POST['gioiTinh']) ? $_POST['gioiTinh'] : $oldInfo[0]['gioiTinh'];
            $diaChi = isset($_POST['diaChi']) ? $_POST['diaChi'] : $oldInfo[0]['diaChi'];
            $chucVu = isset($_POST['chucVu']) ? $_POST['chucVu'] : $oldInfo[0]['chucVu'];
            $email = isset($_POST['email']) ? $_POST['email'] : $oldInfo[0]['email'];
            $soDienThoai = isset($_POST['tel']) ? $_POST['tel'] : $oldInfo[0]['soDienThoai'];

            
            $stmt = mysqli_stmt_init($conn);
            $maNhanVien = $oldInfo[0]['maNhanVien'];
            $sql = "UPDATE giangvien
            SET
                maKhoa = ?,
                hoTen = ?,
                ngaySinh = ?,
                gioiTinh = ?,
                diaChi = ?,
                chucVu = ?,
                email = ?,
                soDienThoai = ?
            WHERE
                maNhanVien = ?;
            ";
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssssssss", $maKhoa, $hoTen, $ngaySinh, $gioiTinh, $diaChi, $chucVu, $email, $soDienThoai, $maNhanVien);


                if (mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Updated successfully!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=lecturer_list';
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

        public function updateSubject($oldInfo) {
            require('./Config/DBConn.php');
            $updateMaKhoa = isset($_POST['maKhoa']) ? $_POST['maKhoa'] : $oldInfo[0]['maKhoa'];
            $updateTenMonHoc = isset($_POST['tenMonHoc']) ? $_POST['tenMonHoc'] : $oldInfo[0]['tenMonHoc'];
            $updateSoTinChi = isset($_POST['soTinChi']) ? $_POST['soTinChi'] : $oldInfo[0]['soTinChi'];
            if(isset($_POST['batBuoc']) && $_POST['batBuoc'] === "checked") {
                $updateBatBuoc = 1;
            } else {
                $updateBatBuoc = 0;
            }
            $updateHocPhiMotTin = isset($_POST['hocPhiMotTin']) ? $_POST['hocPhiMotTin'] : $oldInfo[0]['hocPhiMotTin'];
            
            $sql = "UPDATE hocphan SET 
            maKhoa = ?, 
            tenMonHoc = ?, 
            soTinChi = ?, 
            batBuoc = ?, 
            hocPhiMotTin = ?
            WHERE maHocPhan = ?;";

            $stmt = mysqli_stmt_init($conn);

            $maHocPhan = $oldInfo[0]['maHocPhan'];
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssss", 
                    $updateMaKhoa, 
                    $updateTenMonHoc, 
                    $updateSoTinChi, 
                    $updateBatBuoc, 
                    $updateHocPhiMotTin, 
                    $maHocPhan
                );

                if (mysqli_stmt_execute($stmt)) {
                    if($updateSoTinChi !== $oldInfo[0]['soTinChi'] || $updateHocPhiMotTin !== $oldInfo[0]['hocPhiMotTin']) {
                        $sql1 = "UPDATE chitiethocphi SET 
                        hocPhiMotTin = ?,
                        soTinChi = ?,
                        thanhTien = ?
                        WHERE maHocPhan = ?;";
                        $updateThanhTien = intval($updateSoTinChi) * intval($updateHocPhiMotTin);
                        if (mysqli_stmt_prepare($stmt, $sql1)) {
                            mysqli_stmt_bind_param($stmt, "ssss", 
                                $updateHocPhiMotTin, 
                                $updateSoTinChi,
                                $updateThanhTien,
                                $maHocPhan
                            );
                            if (mysqli_stmt_execute($stmt)) {
                                echo '<script>alert("Updated successfully!")</script>';
                                echo "<script>
                                window.location = 'http://localhost/prj_student/?route=subject_list';
                                </script>";
                            } else {
                                echo '<script>alert("Update failed!")</script>';
                            }
                        }
                    } 
                    echo '<script>alert("Updated successfully!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=subject_list';
                    </script>";
                } else {
                    echo '<script>alert("Update failed!")</script>';
                }
            } else {
                header("Location: ./");
                exit();
            }

            mysqli_stmt_close($stmt);
            $conn->close();
        }

        public function updateClass() {
            require('./Config/DBConn.php');

            $maLop = $_POST['maLop'];
            $tenLop = $_POST['tenLop'];
            $siSoToiDa = $_POST['siSoToiDa'];
            $maGV = $_POST['maGV'];
            $thoiGian = $_POST['thoiGian'];
            $diaDiem = $_POST['diaDiem'];

            $stmt = mysqli_stmt_init($conn);
            $sql = "UPDATE lop
            SET
                tenLop = ?,
                siSoToiDa = ?,
                maGV = ?,
                thoiGian = ?,
                diaDiem = ?
            WHERE
                maLop = ?;
            ";
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssssss", $tenLop, $siSoToiDa, $maGV, $thoiGian, $diaDiem, $maLop);

                if (mysqli_stmt_execute($stmt)) {
                    echo '<script>alert("Updated successfully!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=class_list';
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

        public function deleteStudent($maSV) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');

            $sql = "DELETE FROM sinhvien WHERE maSinhVien= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maSV);

            if (mysqli_stmt_execute($stmt)) {
                deleteAccount($maSV, $conn);
                deleteStudentDiem($maSV, $conn);
                deleteStudentHphi($maSV, $conn);
                deleteStudentHPhanAndClass($maSV, $conn);
                echo '<script>alert("Delete successful!")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=student_list';
                </script>";
                mysqli_stmt_close($stmt);
                $conn->close();
            } else {
                echo '<script>alert("Delete failed!")</script>';
                mysqli_stmt_close($stmt);
                $conn->close();
            }  
        }

        public function deleteLecturer($maNV) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');

            $sql = "DELETE FROM giangvien WHERE maNhanVien= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maNV);

            if (mysqli_stmt_execute($stmt)) {
                deleteAccount($maNV, $conn);
                removeLecturerFromClass($maNV, $conn);
                echo '<script>alert("Delete successful!")</script>';
                echo "<script>
                window.location = 'http://localhost/prj_student/?route=lecturer_list';
                </script>";
            } else {
                echo '<script>alert("Delete failed!")</script>';
            }
            
            mysqli_stmt_close($stmt);
            $conn->close();
        }
        
        public function deleteSubject($maMH) {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');

            $thanhTien = getHPhiTin($maMH, $conn);
            $sql = "DELETE FROM hocphan WHERE maHocPhan= ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $maMH);

            if (mysqli_stmt_execute($stmt)) {
                $sql1 = "DELETE FROM chitiethocphandk WHERE maHocPhan= ?;";
                if(!mysqli_stmt_prepare($stmt, $sql1)) { 
                    echo '<script>alert("Delete failed!")</script>';
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $maMH);
                    if (!mysqli_stmt_execute($stmt)) {
                        echo '<script>alert("Delete failed!")</script>';
                    } else {
                        //hook
                        removeSbjFromCTHP($maMH, $thanhTien, $conn);
                        removeSbjFromClass($maMH, $conn);
                        removeSbjFromCTBD($maMH, $conn);
                        echo '<script>alert("Delete successful!")</script>';
                        echo "<script>
                        window.location = 'http://localhost/prj_student/?route=subject_list';
                        </script>";
                    }
                }
            } else {
                echo '<script>alert("Delete failed!")</script>';
            }
            
            mysqli_stmt_close($stmt);
            $conn->close();
        }

        public function deleteClass() {
            require('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');
            
            $maHP = $_POST['maHocPhan_delete'];
            $maLop = $_POST['maLop_delete'];
            
            $result = prepareHPDK_Class($maLop, $conn);

            if(!checkDeleteClass($result, $conn)) {
                echo '<script>alert("This class has started! Cannot delete it!")</script>';
            } else {
                $sql = "DELETE FROM lop WHERE maLop = ?;";
                $stmt = mysqli_stmt_init($conn);
    
                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }
    
                mysqli_stmt_bind_param($stmt, "s", $maLop);
                if (mysqli_stmt_execute($stmt)) {
                    $thanhTien = getHPhiTin($maHP, $conn);
                    $result1 = updateHphi_Class($result, $thanhTien, $conn);
                    deleteCTHP_Class($result1, $maHP, $conn);
                    deleteCTHPDK_Class($maLop, $conn);
                    echo '<script>alert("Deleted successfully!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=class_list';
                    </script>";
                } else {
                    echo '<script>alert("Delete failed!")</script>';
                }
            }

            $conn->close();
        }
    }
?>