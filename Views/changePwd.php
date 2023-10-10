<div class="mt-4">
    <h3>Đổi Mật Khẩu</h3>
    <form action="" method="post">
        <div class="form-group mt-2">
            <label class="pb-2" for="tenTK">Tên tài khoản</label>
            <input type="text" readonly class="form-control" name="tenTK" value="<?php echo $_SESSION['username']; ?>" >
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="matKhau">Mật khẩu mới</label>
            <input type="password" class="form-control" name="matKhau" >
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="nhapLaiMK">Nhập lại mật khẩu</label>
            <input type="password" class="form-control" name="nhapLaiMK" >
        </div>
        <div class="form-group mt-4">
            <button name="change_pwd" type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['change_pwd'])) {
        require_once('./Controllers/Controller.php');
        $controller = new Controller();
        $controller->handleChangePwd();
    }
?>