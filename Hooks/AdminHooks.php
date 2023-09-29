<?php
    function checkAccountDuplicate($username, $conn) {
        $sql1 = "SELECT * FROM taikhoan WHERE tenTaiKhoan= ?;";
        $stmt1 = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

        if(!mysqli_stmt_prepare($stmt1, $sql1)) { //Prepares an SQL statement for execution -> return a boolean value
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "s",$username); //
        
        if(mysqli_stmt_execute($stmt1)) {
            return FALSE;
        } else return TRUE;

        mysqli_stmt_close($stmt1);
    }

    function checkStudentDuplicate($maSV, $conn) {
        $sql = "SELECT * FROM sinhvien WHERE maSinhVien= ?;";
        $stmt = mysqli_stmt_init($conn); 

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s",$maSV); //
        
        if(mysqli_stmt_execute($stmt)) {
            return FALSE;
        } else return TRUE;

        mysqli_stmt_close($stmt);
    }

    function checkSubjectDuplicate($maHP, $conn) {
        $sql = "SELECT * FROM hocphan WHERE maHocPhan= ?;";
        $stmt = mysqli_stmt_init($conn); 

        if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s",$maHP); //
        
        if(mysqli_stmt_execute($stmt)) {
            return FALSE;
        } else return TRUE;

        mysqli_stmt_close($stmt);
    }

    function hashPwd($password) {
        $hasedPwd = password_hash($password, PASSWORD_DEFAULT);
        return $hasedPwd;
    }
?>