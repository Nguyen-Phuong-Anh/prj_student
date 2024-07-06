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

        mysqli_stmt_bind_param($stmt, "s", $maNV); //
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

    function checkLecturerClassDuplicate($maNV, $maLop, $conn) {
        $sql = "SELECT * FROM lop WHERE maLop = ? AND maGV= ?;";
        $stmt = mysqli_stmt_init($conn); 

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $maLop, $maNV); //
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['maLop'])) {
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

    function checkClassDuplicate($maLop, $conn) {
        $sql = "SELECT * FROM lop WHERE maLop = ?;";
        $stmt = mysqli_stmt_init($conn); 

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s",$maLop); //
        
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['maLop'])) {
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

//check again
    function deleteStudentHPhanAndClass($maSV, $conn) {
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

        //get malop
        $sql = "SELECT maLop FROM chitiethocphandk WHERE maDSDK= ?;";
        $stmt11 = mysqli_stmt_init($conn);

        $result2 = array();
        if(!mysqli_stmt_prepare($stmt11, $sql)) { 
            header("Location: ./");
            exit();
        } else {
            foreach ($results as $maDSDK) {
                mysqli_stmt_bind_param($stmt11, "s", $maDSDK);
                mysqli_stmt_execute($stmt11);
                $resultData = mysqli_stmt_get_result($stmt11);
                while ($data = mysqli_fetch_assoc($resultData)) {
                    $result2[] = $data;
                }
            }
        }
        mysqli_stmt_close($stmt11);

        if(!empty($results)) {
            $sql = "DELETE FROM chitiethocphandk WHERE maDSDK = ?;";
            $stmt2 = mysqli_stmt_init($conn);
    
            if(!mysqli_stmt_prepare($stmt2, $sql)) { 
                header("Location: ./");
                exit();
            } else {
                foreach ($results as $maDSDK) {
                    mysqli_stmt_bind_param($stmt2, "s", $maDSDK);
                    mysqli_stmt_execute($stmt2);
                }
                mysqli_stmt_close($stmt2);
            }

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

            $sql = "UPDATE lop SET siSo = siSo - ? WHERE maLop = ?;";
            $stmt10 = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt10, $sql)) { 
                header("Location: ./");
                exit();
            } else {
                $student = 1;
                foreach ($result2 as $maLop) {
                    mysqli_stmt_bind_param($stmt10, "is", $student, $maLop);
                    mysqli_stmt_execute($stmt10);
                }
                mysqli_stmt_close($stmt10);
            }
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
            echo '<script>alert("5")</script>';

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
            $results[] = $maBangDiem;
        }

        mysqli_stmt_free_result($stmt5);
        mysqli_stmt_close($stmt5);

        if(!empty($results)) {
            $sql1 = "DELETE FROM chitietbangdiem WHERE maBangDiem = ?;";
            $stmt6 = mysqli_stmt_init($conn);
    
            if(mysqli_stmt_prepare($stmt6, $sql1)) { 
                foreach ($results as $maBangDiem) {
                    mysqli_stmt_bind_param($stmt6, "s", $maBangDiem);
                    mysqli_stmt_execute($stmt6);
                }
                mysqli_stmt_close($stmt6);
            } else {
                header("Location: ./");
                exit();
            }

            $sql1 = "DELETE FROM bangdiem WHERE maBangDiem = ?;";
            $stmt8 = mysqli_stmt_init($conn);
    
            if(mysqli_stmt_prepare($stmt8, $sql1)) { 
                foreach ($results as $maBangDiem) {
                    mysqli_stmt_bind_param($stmt8, "s", $maBangDiem);
                    mysqli_stmt_execute($stmt8);
                }
                
                mysqli_stmt_close($stmt8);
            }
            
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

    function checkDeleteClass($arr, $conn) {
        $sql = "SELECT maBangDiem FROM bangdiem WHERE maSinhVien= ? AND hocKy= ?;";
        $stmt = mysqli_stmt_init($conn); 

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./");
            exit();
        }

        foreach ($arr as $row) {
            mysqli_stmt_bind_param($stmt, "ss", $row['maSinhVien'], $row['hocKy']);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            while ($data = mysqli_fetch_assoc($resultData)) {
                if(isset($data['maBangDiem'])) {
                    return FALSE;
                }
            }
        }

        mysqli_stmt_close($stmt);
        
        return TRUE;
    }

    function prepareHPDK_Class($maLop, $conn) {
        $sql = "SELECT maDSDK FROM chitiethocphandk WHERE maLop= ?;";
        $stmt3 = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt3, $sql)) {         
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt3, "s", $maLop);
        mysqli_stmt_execute($stmt3);
        mysqli_stmt_store_result($stmt3);

        mysqli_stmt_bind_result($stmt3, $maDSDK);

        $rows = array();
        while (mysqli_stmt_fetch($stmt3)) {
            $rows[] = $maDSDK;
        }
        
        mysqli_stmt_free_result($stmt3);
        mysqli_stmt_close($stmt3);

        //get masv, hk
        $sql2 = "SELECT maSinhVien, hocKy FROM hocphandk WHERE maDSDK= ?;";
        $stmt2 = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt2, $sql2)) {
            header("Location: ./");
            exit();
        }

        $array = array();
        foreach ($rows as $row) {
            mysqli_stmt_bind_param($stmt2, "s", $row);
            mysqli_stmt_execute($stmt2);
            
            $resultData = mysqli_stmt_get_result($stmt2);
            while ($data = mysqli_fetch_assoc($resultData)) {
                $array[] = $data;
            }
        }
        mysqli_stmt_close($stmt2);

        return $array;
    }

    function updateHphi_Class($arr, $thanhTien, $conn) {
        $sql = "SELECT maHocPhi FROM hocphi WHERE maSinhVien= ? AND hocKy=?;";
        $stmt2 = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt2, $sql)) {
            header("Location: ./");
            exit();
        }
        
        $array = array();
        foreach ($arr as $row) {
            mysqli_stmt_bind_param($stmt2, "ss", $row['maSinhVien'], $row['hocKy']);
            mysqli_stmt_execute($stmt2);
    
            $resultData = mysqli_stmt_get_result($stmt2);
            while ($data = mysqli_fetch_assoc($resultData)) {
                $array[] = $data;
            }
        }
        mysqli_stmt_close($stmt2);
        
        $sql = "UPDATE hocphi SET tongHocPhi = tongHocPhi - ? WHERE maHocPhi = ?;";
        $stmt3 = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt3, $sql)) { 
            header("Location: ./");
            exit();
        } else {
            foreach ($array as $row) {
                mysqli_stmt_bind_param($stmt3, "is", $thanhTien, $row['maHocPhi']);
                mysqli_stmt_execute($stmt3);
            }
            mysqli_stmt_close($stmt3);
        }

        return $array;
    }

    function deleteCTHP_Class($array, $maHP, $conn) {
        $sql1 = "DELETE FROM chitiethocphi WHERE maHocPhi = ? AND maHocPhan=?;";
        $stmt2 = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt2, $sql1)) { 
            header("Location: ./");
            exit();
        } else {
            foreach ($array as $row) {
                mysqli_stmt_bind_param($stmt2, "ss", $row['maHocPhi'], $maHP);
                mysqli_stmt_execute($stmt2);
            }
            mysqli_stmt_close($stmt2);
        }
    }

    function deleteCTHPDK_Class($maLop, $conn) {
        $sql1 = "DELETE FROM chitiethocphandk WHERE maLop = ?;";
        $stmt2 = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt2, $sql1)) { 
            header("Location: ./");
            exit();
        }
        mysqli_stmt_bind_param($stmt2, "s", $maLop);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }
?>