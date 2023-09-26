<?php
    class AdminController {
        public function showAddStudent() {
            require_once('./Views/admin/add_student.php');
        }

        public function showManageAccount() {
            require_once('./Views/admin/manage_account.php');
        }

        public function handleSearchAccount() {
            $search = $_POST['search'];
            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $data = $model->getSearchAccount($search);
            return $data;
        }

        public function handleAddAccount() {
            if(!$_POST['username'] || !$_POST['password'] || !$_POST['role']) {
                echo '<script>alert("Please fill all the information")</script>';
                header("Location: ./");
            }
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->addAccount($username, $password, $role);
        }

        public function handleChangeAccount() {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            require_once('./Models/AdminModel.php');
            $model = new AdminModel();
            $model->changeAccount($username, $password, $role);
        }
    }
?>