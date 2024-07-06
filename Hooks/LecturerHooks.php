<?php
    function checkExistMaBD($maSV, $hocKy, $conn) {
        $sql = "SELECT maBangDiem FROM bangdiem WHERE maSinhVien= ? AND hocKy= ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) { 
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $maSV, $hocKy);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['maBangDiem'])) {
                return $row['maBangDiem'];
            }
        }
        mysqli_stmt_close($stmt);
        
        return FALSE;
    }

    function checkExistMaHP($maHP, $conn) {
        $sql = "SELECT maHocPhan FROM chitietbangdiem WHERE maHocPhan= ?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) { 
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $maHP);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($resultData)) {
            if(isset($row['maHocPhan'])) {
                return TRUE;
            }
        }
        mysqli_stmt_close($stmt);
        
        return FALSE;
    }
?>