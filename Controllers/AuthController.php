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
                // $password = $_POST['password'];

                require_once('./Models/AuthModel.php');
                $authoMod = new AuthModel();
                $data = $authoMod->authenticate($username);

                //check the hash password
                // $pwdHashed = $data['password'];
                // $checkPwd = password_verify($pwd, $pwdHashed);
                // if($checkPwd === false) {

                // } else {}
                if($data['maVaiTro'] === '101') {
                    session_start();
                    $_SESSION['username'] = $data['tenTaiKhoan'];
                    $_SESSION['role'] = $data['maVaiTro'];
                    header("Location: .?route=home");
                    exit();
                } else if($data['maVaiTro'] === '103') {
                    session_start();
                    $_SESSION['username'] = $data['tenTaiKhoan'];
                    $_SESSION['role'] = $data['maVaiTro'];
                    header("Location: .?route=home_student");
                    exit();
                } else {
                    session_start();
                    $_SESSION['username'] = $data['tenTaiKhoan'];
                    $_SESSION['role'] = $data['maVaiTro'];
                    header("Location: .?route=home_lecturer");
                    exit();
                }
                else if($data['maVaiTro'] === '102') {
                    session_start();
                    $_SESSION['username'] = $data['tenTaiKhoan'];
                    $_SESSION['role'] = $data['maVaiTro'];
                    header("Location: .?route=home_lecturer");
                    exit();
                }
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