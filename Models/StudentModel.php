<?php
class StudentModel {
    public function getStudent($maSV){
        $sql = "SELECT * FROM sinhvien WHERE maSinhVien= ?;";
        require('./Config/DBConn.php');
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) { 
            header("Location: ./");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $maSV);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);
        return $resultData;

        mysqli_stmt_close($stmt);
        $conn->close();
        } 
    public function getSubject($MaHphan){
        $sql = "SELECT * FROM hocphan WHERE maHocPhan= ?;";
        require('./Config/DBConn.php');
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)) { 
            header("Location: ./");
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $MaHphan);
        mysqli_stmt_execute($stmt);
        
        $resultData = mysqli_stmt_get_result($stmt);
        return $resultData;

        mysqli_stmt_close($stmt);
        $conn->close();
        } 
    }

?>


