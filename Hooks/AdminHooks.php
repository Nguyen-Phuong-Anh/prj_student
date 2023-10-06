<?php
    function checkAccountDuplicate($username, $conn) {
        $sql1 = "SELECT * FROM taikhoan WHERE tenTaiKhoan= ?;";
        $stmt1 = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

        if(!mysqli_stmt_prepare($stmt1, $sql1)) { //Prepares an SQL statement for execution -> return a boolean value
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "s",$username); //
        
        mysqli_stmt_execute($stmt1);

        $resultData = mysqli_stmt_get_result($stmt1);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['tenTaiKhoan'])) {
                return FALSE;
            }
        }
        mysqli_stmt_close($stmt1);
        
        return TRUE;
    }

    function checkStudentDuplicate($maSV, $conn) {
        $sql = "SELECT * FROM sinhvien WHERE maSinhVien= ?;";
        $stmt = mysqli_stmt_init($conn); 

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s",$maSV); //
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['maSinhVien'])) {
                return FALSE;
            }
        }
        mysqli_stmt_close($stmt);
        
        return TRUE;
    }

    function checkLecturerDuplicate($maNV, $conn) {
        $sql = "SELECT * FROM giangvien WHERE maNhanVien= ?;";
        $stmt = mysqli_stmt_init($conn); 

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s",$maNV); //
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['maNhanVien'])) {
                return FALSE;
            }
        }
        mysqli_stmt_close($stmt);
        
        return TRUE;
    }

    function checkSubjectDuplicate($maHP, $conn) {
        $sql = "SELECT * FROM hocphan WHERE maHocPhan= ?;";
        $stmt = mysqli_stmt_init($conn); 

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s",$maHP); //
        
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['maHocPhan'])) {
                return FALSE;
            }
        }
        mysqli_stmt_close($stmt);
        
        return TRUE;
    }

    function hashPwd($password) {
        $hasedPwd = password_hash($password, PASSWORD_DEFAULT);
        return $hasedPwd;
    }

    function deleteAccount($tenTK, $conn) {
        //tkhoan
        $sql1 = "DELETE FROM taikhoan WHERE tenTaiKhoan = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql1)) { 
            header("Location: ./");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $tenTK);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }


    function deleteStudentHPhan($maSV, $conn) {
        //get mabd & delete
        $sql = "SELECT maDSDK FROM hocphandk WHERE maSinhVien= ?;";
        $stmt1 = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt1, $sql)) { 
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "s", $maSV);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_store_result($stmt1);

        mysqli_stmt_bind_result($stmt1, $maDSDK);

        // Fetch the result and store it as an associative array
        $results = array();
        while (mysqli_stmt_fetch($stmt1)) {
            $results[] = $maDSDK;
        }

        mysqli_stmt_free_result($stmt1);
        mysqli_stmt_close($stmt1);

        if(!empty($results)) {
            $sql = "DELETE FROM chitiethocphandk WHERE maDSDK = ?;";
            $stmt2 = mysqli_stmt_init($conn);
    
            if(!mysqli_stmt_prepare($stmt2, $sql)) { 
                header("Location: ./");
                exit();
            } else {
                foreach ($results as $maHocPhi) {
                    mysqli_stmt_bind_param($stmt2, "s", $maHocPhi);
                    mysqli_stmt_execute($stmt2);
                }
                mysqli_stmt_close($stmt2);
            }
            // mysqli_stmt_bind_param($stmt2, "s", $results['maDSDK']);
            // mysqli_stmt_execute($stmt2);
            
            // mysqli_stmt_close($stmt2);

            $sql = "DELETE FROM hocphandk WHERE maDSDK = ?;";
            $stmt9 = mysqli_stmt_init($conn);
    
            if(!mysqli_stmt_prepare($stmt9, $sql)) { 
                header("Location: ./");
                exit();
            } else {
                foreach ($results as $maDSDK) {
                    mysqli_stmt_bind_param($stmt9, "s", $maDSDK);
                    mysqli_stmt_execute($stmt9);
                }
                
                mysqli_stmt_close($stmt9);
            }
            // mysqli_stmt_bind_param($stmt9, "s", $results['maDSDK']);
            // mysqli_stmt_execute($stmt9);
            
            // mysqli_stmt_close($stmt9);
        }
    }

    function deleteStudentHphi($maSV, $conn) {
        // hphi
        $sql = "SELECT maHocPhi FROM hocphi WHERE maSinhVien= ?;";
        $stmt3 = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt3, $sql)) { 
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt3, "s", $maSV);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_store_result($stmt3);

        mysqli_stmt_bind_result($stmt3, $maHocPhi);

        // Fetch the result and store it as an associative array
        $results = array();
        while (mysqli_stmt_fetch($stmt3)) {
            $results[] = $maHocPhi;
        }

        mysqli_stmt_free_result($stmt3);
        mysqli_stmt_close($stmt3);

        if(!empty($results)) {
            $sql = "DELETE FROM chitiethocphi WHERE maHocPhi = ?;";
            $stmt4 = mysqli_stmt_init($conn);
    
            if(!mysqli_stmt_prepare($stmt4, $sql)) { 
                header("Location: ./");
                exit();
            } else {
                foreach ($results as $maHocPhi) {
                    mysqli_stmt_bind_param($stmt4, "s", $maHocPhi);
                    mysqli_stmt_execute($stmt4);
                }
                mysqli_stmt_close($stmt4);
            }
            // mysqli_stmt_bind_param($stmt4, "s", $results['maHocPhi']);
            // mysqli_stmt_execute($stmt4);

            // mysqli_stmt_close($stmt4);

            $sql = "DELETE FROM hocphi WHERE maHocPhi = ?;";
            $stmt7 = mysqli_stmt_init($conn);
    
            if(!mysqli_stmt_prepare($stmt7, $sql)) { 
                header("Location: ./");
                exit();
            } else {
                foreach ($results as $maHocPhi) {
                    mysqli_stmt_bind_param($stmt7, "s", $maHocPhi);
                    mysqli_stmt_execute($stmt7);
                }
                
                mysqli_stmt_close($stmt7);
            }
            // mysqli_stmt_bind_param($stmt7, "s", $results['maHocPhi']);
            // mysqli_stmt_execute($stmt7);

            // mysqli_stmt_close($stmt7);
        }
    }

    function deleteStudentDiem($maSV, $conn) {
        //diem
        $sql = "SELECT maBangDiem FROM bangdiem WHERE maSinhVien= ?;";
        $stmt5 = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt5, $sql)) { 
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt5, "s", $maSV);
        mysqli_stmt_execute($stmt5);
        mysqli_stmt_store_result($stmt5);

        mysqli_stmt_bind_result($stmt5, $maBangDiem);

        // Fetch the result and store it as an associative array
        $results = array();
        while (mysqli_stmt_fetch($stmt5)) {
            // $results['maBangDiem'] = $maBangDiem;
            $results[] = $maBangDiem;
        }

        mysqli_stmt_free_result($stmt5);
        mysqli_stmt_close($stmt5);

        if(!empty($results)) {
            $sql1 = "DELETE FROM chitietbangdiem WHERE maBangDiem = ?;";
            $stmt6 = mysqli_stmt_init($conn);
    
            if(mysqli_stmt_prepare($stmt6, $sql1)) { 
                // header("Location: ./");
                // exit();
                foreach ($results as $maBangDiem) {
                    mysqli_stmt_bind_param($stmt6, "s", $maBangDiem);
                    mysqli_stmt_execute($stmt6);
                }
                mysqli_stmt_close($stmt6);
            } else {
                header("Location: ./");
                exit();
            }
            // mysqli_stmt_bind_param($stmt6, "s", $results['maBangDiem']);
            // mysqli_stmt_execute($stmt6);
            

            $sql1 = "DELETE FROM bangdiem WHERE maBangDiem = ?;";
            $stmt8 = mysqli_stmt_init($conn);
    
            if(mysqli_stmt_prepare($stmt8, $sql1)) { 
                // header("Location: ./");
                // exit();
                foreach ($results as $maBangDiem) {
                    mysqli_stmt_bind_param($stmt8, "s", $maBangDiem);
                    mysqli_stmt_execute($stmt8);
                }
                
                mysqli_stmt_close($stmt8);
            }
            // mysqli_stmt_bind_param($stmt8, "s", $results['maBangDiem']);
            // mysqli_stmt_execute($stmt8);
            
        }
    }

    function removeLecturerFromClass($maNV, $conn) {
        $sql = "UPDATE lop 
        SET maGV = ?
        WHERE maGV = ?";
        
        $stmt = mysqli_stmt_init($conn);
        
        $new_maNV = '';
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $new_maNV, $maNV);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);
        } else {
            header("Location: ./");
            exit();
        }
    }

    function getHPhiTin($maMH, $conn) {
        $sql = "SELECT soTinChi, hocPhiMotTin FROM hocphan WHERE maHocPhan= ?;";
        $stmt1 = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt1, $sql)) { 
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "s", $maMH);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_store_result($stmt1);

        mysqli_stmt_bind_result($stmt1, $soTinChi, $hocPhiMotTin);

        // Fetch the result and store it as an associative array
        $results = array();
        while (mysqli_stmt_fetch($stmt1)) {
            $results[] = array(
                'soTinChi' => $soTinChi,
                'hocPhiMotTin' => $hocPhiMotTin
            );
        }

        mysqli_stmt_free_result($stmt1);
        mysqli_stmt_close($stmt1);

        $tongTien = intval($results[0]['soTinChi']) * intval($results[0]['hocPhiMotTin']);
        return $tongTien;
    }

    function removeSbjFromCTHP($maMH, $thanhTien, $conn) {
        $sql = "SELECT maHocPhi FROM chitiethocphi WHERE maHocPhan= ?;";
        $stmt1 = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt1, $sql)) { 
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "s", $maMH);
        mysqli_stmt_execute($stmt1);
        mysqli_stmt_store_result($stmt1);

        mysqli_stmt_bind_result($stmt1, $maMH);

        // Fetch the result and store it as an associative array
        $results = array();
        while (mysqli_stmt_fetch($stmt1)) {
            $results[] = $maMH;
        }

        mysqli_stmt_free_result($stmt1);
        mysqli_stmt_close($stmt1);

        if(!empty($results)) {
            //delete in chitiethocphi
            $sql = "DELETE FROM chitiethocphi WHERE maHocPhi = ?;";
            $stmt4 = mysqli_stmt_init($conn);
    
            if(!mysqli_stmt_prepare($stmt4, $sql)) { 
                header("Location: ./");
                exit();
            } else {
                foreach ($results as $maHocPhi) {
                    mysqli_stmt_bind_param($stmt4, "s", $maHocPhi);
                    mysqli_stmt_execute($stmt4);
                }
                mysqli_stmt_close($stmt4);
            }

            // update tonghp
            $sql = "UPDATE hocphi SET tongHocPhi = tongHocPhi - ? WHERE maHocPhi = ?;";
            $stmt2 = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt2, $sql)) { 
                header("Location: ./");
                exit();
            } else {
                foreach ($results as $maHocPhi) {
                    mysqli_stmt_bind_param($stmt2, "is", $thanhTien, $maHocPhi);
                    mysqli_stmt_execute($stmt2);
                }
                mysqli_stmt_close($stmt2);
            }
        }
    }

    function removeSbjFromClass($maMH, $conn) {
        $sql = "UPDATE lop 
        SET maHocPhan = ?
        WHERE maHocPhan = ?";
        
        $stmt = mysqli_stmt_init($conn);
        
        $new_maMH = '';
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $new_maMH, $maMH);
            mysqli_stmt_execute($stmt);

            mysqli_stmt_close($stmt);
        } else {
            header("Location: ./");
            exit();
        }
    }

    function removeSbjFromCTBD($maMH, $conn) {
        $sql1 = "DELETE FROM chitietbangdiem WHERE maHocPhan = ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql1)) { 
            header("Location: ./");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $maMH);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
?>