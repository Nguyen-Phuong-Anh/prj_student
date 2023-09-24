<?php
    class AuthController {
        public function showLoginForm() {
            require_once('./Views/auth/login.php');
        }

        public function processLogin() {
            if(isset($_POST['submit'])) {
                if(!$_POST['username'] || !$_POST['password']) {
                    header("Location: ./");
                }
                $username = $_POST['username'];
                $password = $_POST['password'];

                require_once('./Models/AuthModel.php');
                $authoMod = new AuthModel();
                $data = $authoMod->authenticate($username, $password);
                print_r($data);

                //check the hash password
                // $pwdHashed = $data['password'];
                // $checkPwd = password_verify($pwd, $pwdHashed);
                // if($checkPwd === false) {

                // }
                session_start();
                $_SESSION['username'] = $data['tenTaiKhoan'];
                $_SESSION['role'] = $data['maVaiTro'];
                header("Location: .?route=home");
                exit();
            }
        }

        public function processLogout() {
            session_start();
            session_unset();
            session_destroy();

            header("Location: ./");
            exit();
        }
    }
?>