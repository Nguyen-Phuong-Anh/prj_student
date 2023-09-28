<div class="mt-5">
    <h2 class="mt-4 ml-3">Thêm Mới Giảng Viên</h2>
    <form action="" method="post" class="wrapper ml-4" id="studentForm">
        <div>
            <div class="form-group mt-3">
                <label class="pb-2" for="maSV">Mã NV</label>
                <input type="text" class="form-control" name="maNV" placeholder="Mã NV" >
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="khoa_selector">Khoa</label>
                <select name="khoa_selector" class="form-select" aria-label="Default select example">
                    <option selected>Khoa</option>
                    <?php
                        require_once('./Controllers/AdminController.php');
                        $controller = new AdminController();
                        $data = $controller->showKhoa();
                        while ($row =mysqli_fetch_assoc($data)) {
                            echo '<option value="'.$row['maKhoa'].'">'.$row['tenKhoa'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="hoTen">Họ và Tên</label>
                <input type="text" class="form-control" name="hoTen" placeholder="Họ và Tên" >
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="ngaySinh">Ngày sinh</label>
                <input type="date" class="form-control" name="ngaySinh" >
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="gioiTinh">Giới tính</label>
                <select class="form-select" name="gioiTinh" >
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="diaChi">Địa Chỉ</label>
                <input type="text" class="form-control" name="diaChi" placeholder="Địa Chỉ" >
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="chucVu">Chức vụ</label>
                <input type="text" class="form-control" name="chucVu" placeholder="Chức vụ" >
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" >
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="tel">Số điện thoại</label>
                <input type="text" class="form-control" name="tel" placeholder="Số điện thoại" >
            </div>
            <div class="form-group mt-4">
                <button name="submit_lecturer" type="submit" class="btn btn-primary">Thêm</button>
                <button name="clear" type="submit" class="btn btn-light">Clear</button>
            </div>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['submit_lecturer'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleAddLecturer();
    } else {
        $_POST['maNV'] = '';
        $_POST['hoTen'] = '';
        $_POST['diaChi'] = '';
        $_POST['email'] = '';
        $_POST['chucVu'] = '';
        $_POST['tel'] = '';
    }
?>