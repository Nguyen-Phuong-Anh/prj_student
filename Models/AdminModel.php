<?php 
    class AdminModel {
        public function getSearchAccount($search) {
            require_once('./Config/DBConn.php');
            $searchTerm = "%{$search}%";
            $sql = "SELECT * FROM taikhoan WHERE tenTaiKhoan LIKE ?;";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)) { 
                header("Location: ./");
                exit();
            }

            mysqli_stmt_bind_param($stmt, "s", $searchTerm);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);
            return $resultData;

            mysqli_stmt_close($stmt);
            $conn->close();
        }

        public function addAccount($username, $password, $role) {
            require_once('./Config/DBConn.php');
            require_once('./Hooks/AdminHooks.php');
            //check duplicate
            if(!checkUsername($username, $conn)) { 
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
            } else {
                echo '<script>alert("Failed to make changes account")</script>';
            }

            mysqli_stmt_close($stmt);
            
            $conn->close();
        }
    }
?>