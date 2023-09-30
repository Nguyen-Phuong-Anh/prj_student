<div class="mt-5">
    <h2 class="mt-4 ml-3">Thêm Mới Sinh Viên</h2>
    <form action="" method="post" class="wrapper ml-4" id="studentForm">
        <div>
            <div class="form-group mt-3">
                <label class="pb-2" for="maSV">Mã SV</label>
                <input type="text" class="form-control" name="maSV" placeholder="Mã SV" >
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
                <label class="pb-2" for="hocKy">Học kỳ hiện tại</label>
                <?php
                    $currentYear = intval(date("Y"));
                    echo '<input readonly type="text" class="form-control" name="hocKy" value="Năm học '.$currentYear.' - '.++$currentYear.' - Học kỳ 1" >';
                ?>
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
                <label class="pb-2" for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" >
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="tel">Số điện thoại</label>
                <input type="text" class="form-control" name="tel" placeholder="Số điện thoại" >
            </div>
            <div class="form-group mt-4">
                <button name="submit_student" type="submit" class="btn btn-primary">Thêm</button>
                <button name="clear" type="submit" class="btn btn-light">Clear</button>
            </div>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['edit_profile_student'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleAddStudent();
    } else {
        $_POST['maSV'] = '';
        $_POST['hoTen'] = '';
        $_POST['diaChi'] = '';
        $_POST['email'] = '';
        $_POST['tel'] = '';
    }
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_stdInfo"])) {
    // Kết nối đến cơ sở dữ liệu và thực hiện cập nhật thông tin sinh viên
    $conn = mysqli_connect("localhost", "username", "password", "database_name");

    if (!$conn) {
        die("Kết nối không thành công: " . mysqli_connect_error());
    }

    // Trích xuất dữ liệu từ biểu mẫu
    $hoTen = $_POST['hoTen'];
    $ngaySinh = $_POST['ngaySinh'];
    $gioiTinh = $_POST['gioiTinh'];
    $diaChi = $_POST['diaChi'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    // Cập nhật thông tin sinh viên trong cơ sở dữ liệu
    $sql = "UPDATE sinh_vien SET hoTen='$hoTen', ngaySinh='$ngaySinh', gioiTinh='$gioiTinh', diaChi='$diaChi', email='$email', soDienThoai='$tel' WHERE maSinhVien='ma_sinh_vien_cua_ban'"; // Thay thế 'ma_sinh_vien_cua_ban' bằng mã sinh viên thực tế

    if (mysqli_query($conn, $sql)) {
        echo "Cập nhật thông tin thành công!";
    } else {
        echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
