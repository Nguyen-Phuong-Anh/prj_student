<?php
    class AdminController {
        public function showAddStudent() {
            require_once('./Views/admin/add_student.php');
        }

        public function showManageStudent() {
            require_once('./Views/admin/manage_student.php');
        }
    }
?>