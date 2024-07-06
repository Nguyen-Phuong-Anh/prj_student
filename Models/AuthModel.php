<?php
    class AuthModel {
        public function authenticate($username) {
            require_once('./Config/DBConn.php'); 
            $sql = "SELECT * FROM taikhoan WHERE tenTaiKhoan= ?;";
            $stmt = mysqli_stmt_init($conn); //create a beforehand statement to ensure the security

            if(!mysqli_stmt_prepare($stmt, $sql)) { //Prepares an SQL statement for execution -> return a boolean value
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $username); //
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($resultData)) { 
                return $row;
            }

            mysqli_stmt_close($stmt);
            $conn->close();
        }

        public function changePwd($tenTK) {
            require_once('./Hooks/AdminHooks.php');

            $mk1 = $_POST['matKhau'];
            $mk2 = $_POST['nhapLaiMK'];

            if (strcasecmp($mk1, $mk2) === 0) {
                $hashedPwd = hashPwd($mk1);

                require_once('./Config/DBConn.php');
                $sql = "UPDATE taikhoan SET matKhau = ? WHERE tenTaiKhoan = ?;";

                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) { 
                    header("Location: ./");
                    exit();
                }
                
                mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $tenTK);

                if(mysqli_stmt_execute($stmt)) {
                    if($_SESSION['role'] === '103') {
                        echo '<script>alert("Update successfully")</script>';
                        echo "<script>
                        window.location = 'http://localhost/prj_student/?route=pwd_student';
                        </script>";
                    } else {
                        echo '<script>alert("Update successfully")</script>';
                        echo "<script>
                        window.location = 'http://localhost/prj_student/?route=pwd_lecturer';
                        </script>";
                    }
                } else {
                    echo '<script>alert("Failed to make changes!")</script>';
                }

                mysqli_stmt_close($stmt);
                
                $conn->close();
            } else {
                if($_SESSION['role'] === '103') {
                    echo '<script>alert("Password and password re-entered are not similar!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=pwd_student';
                    </script>";
                } else {
                    echo '<script>alert("Password and password re-entered are not similar!")</script>';
                    echo "<script>
                    window.location = 'http://localhost/prj_student/?route=pwd_lecturer';
                    </script>";
                }
            }
        }
    }
?>