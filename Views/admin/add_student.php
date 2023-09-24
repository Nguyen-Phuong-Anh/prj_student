<?php
    require_once('./Controllers/Controller.php');
    $controller = new Controller();
    $controller->showHome();
?>
<div class="mt-5">
    <h2 class="mt-4 ml-3">Thêm Mới Sinh Viên</h2>
    <form action="/student/th2.php" method="post" class="wrapper ml-4" id="studentForm">
        <div>
            <div class="form-group">
                <label for="maSV">Mã SV</label>
                <input type="text" class="form-control" name="maSV" placeholder="Mã SV" required>
            </div>
            <div class="form-group">
                <label for="hoTen">Họ và Tên</label>
                <input type="text" class="form-control" name="hoTen" placeholder="Họ và Tên" required>
            </div>
            <div class="form-group">
                <label for="ngaySinh">Ngày sinh</label>
                <input type="date" class="form-control" name="ngaySinh" required>
            </div>
            <div class="form-group">
                <label for="diaChi">Địa Chỉ</label>
                <input type="text" class="form-control" name="diaChi" placeholder="Địa Chỉ" required>
            </div>
            <div class="form-group">
                <label for="gioiTinh">Giới tính</label>
                <select class="form-control" name="gioiTinh" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="lop">Lớp</label>
                <input type="text" class="form-control" name="lop" placeholder="Lớp" required>
            </div>
            <div class="form-group">
                <label for="khoa">Khoa</label>
                <input type="text" class="form-control" name="khoa" placeholder="Khoa" required>
            </div>
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </div>
    </form>
</div>