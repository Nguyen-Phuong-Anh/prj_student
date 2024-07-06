<?php
    function checkDuplicateSubject($maHP, $conn) {
        $sql1 = "SELECT * FROM chitiethocphandk WHERE maHocPhan= ?;";
        $stmt1 = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

        if(!mysqli_stmt_prepare($stmt1, $sql1)) { 
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "s",$maHP); //
        mysqli_stmt_execute($stmt1);

        $resultData = mysqli_stmt_get_result($stmt1);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['maHocPhan'])) {
                return FALSE;
            }
        }
        return TRUE;

        mysqli_stmt_close($stmt1);
    }

    function checkDuplicateRegistSbj($maSV, $hocKy, $conn) {
        $sql1 = "SELECT * FROM hocphandk WHERE maSinhVien= ? AND hocKy= ?;";
        $stmt1 = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

        if(!mysqli_stmt_prepare($stmt1, $sql1)) { //Prepares an SQL statement for execution -> return a boolean value
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "ss",$maSV, $hocKy); //
        
        mysqli_stmt_execute($stmt1);

        $resultData = mysqli_stmt_get_result($stmt1);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['hocKy'])) {
                return FALSE;
            }
        }
        mysqli_stmt_close($stmt1);
        
        return TRUE;
    }

    function checkDuplicateRegistedSbj($maHP, $conn) {
        $sql1 = "SELECT * FROM chitiethocphandk WHERE maHocPhan= ?;";
        $stmt1 = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

        if(!mysqli_stmt_prepare($stmt1, $sql1)) { //Prepares an SQL statement for execution -> return a boolean value
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "s",$maHP); //
        mysqli_stmt_execute($stmt1);

        $resultData = mysqli_stmt_get_result($stmt1);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['maHocPhan'])) {
                return FALSE;
            }
        }
        mysqli_stmt_close($stmt1);

        return TRUE;
    }

    function updateClassMem($maLop, $conn) {
        $sql1 = "UPDATE lop SET siSo = siSo + 1 WHERE maLop = ?;";
        $stmt1 = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

        if(!mysqli_stmt_prepare($stmt1, $sql1)) { //Prepares an SQL statement for execution -> return a boolean value
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "s",$maLop); //
        
        if(mysqli_stmt_execute($stmt1)) {
            return TRUE;
        } else return FALSE;
       
        mysqli_stmt_close($stmt1);
    }

    function checkMatchClass($malop, $maHP, $conn) {
        $sql1 = "SELECT * FROM lop WHERE maLop = ?;";
        $stmt1 = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

        if(!mysqli_stmt_prepare($stmt1, $sql1)) { //Prepares an SQL statement for execution -> return a boolean value
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "s",$malop); //
        mysqli_stmt_execute($stmt1);

        $resultData = mysqli_stmt_get_result($stmt1);        
        while($row = mysqli_fetch_assoc($resultData)) {
            if($row['maHocPhan'] === $maHP) {
                return TRUE;
            }
        }

        mysqli_stmt_close($stmt1);
        
        return FALSE;
    }

    function checkDuplicateTuition($maSV, $hocKy, $conn) {
        $sql1 = "SELECT * FROM hocphi WHERE maSinhVien= ? AND hocKy= ?;";
        $stmt1 = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

        if(!mysqli_stmt_prepare($stmt1, $sql1)) { //Prepares an SQL statement for execution -> return a boolean value
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "ss",$maSV, $hocKy); //
        
        mysqli_stmt_execute($stmt1);

        $resultData = mysqli_stmt_get_result($stmt1);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['hocKy'])) {
                return FALSE;
            }
        }
        mysqli_stmt_close($stmt1);
        
        return TRUE;
    }

    function updateTuition($maHPhi, $thanhTien, $conn) {
        $sql1 = "UPDATE hocphi SET tongHocPhi = tongHocPhi + ? WHERE maHocPhi = ?;";
        $stmt1 = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

        if(!mysqli_stmt_prepare($stmt1, $sql1)) { //Prepares an SQL statement for execution -> return a boolean value
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "is", $thanhTien, $maHPhi); //
        
        if(mysqli_stmt_execute($stmt1)) {
            return TRUE;
        } else return FALSE;

        mysqli_stmt_close($stmt1);
    }
?>