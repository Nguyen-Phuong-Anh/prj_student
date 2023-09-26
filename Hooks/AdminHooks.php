<?php
    function checkUsername($username, $conn) {
        $sql1 = "SELECT * FROM taikhoan WHERE tenTaiKhoan= ?;";
        $stmt1 = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

        if(!mysqli_stmt_prepare($stmt1, $sql1)) { //Prepares an SQL statement for execution -> return a boolean value
            header("Location: ./");
            exit();
        }

        mysqli_stmt_bind_param($stmt1, "s", $username); //
        
        if(mysqli_stmt_execute($stmt1)) {
            return FALSE;
        } else return TRUE;

        mysqli_stmt_close($stmt1);
    }

    function hashPwd($password) {
        $hasedPwd = password_hash($password, PASSWORD_DEFAULT);
        return $hasedPwd;
    }
?>