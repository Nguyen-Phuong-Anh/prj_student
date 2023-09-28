<?php
    require_once('./Controllers/AdminController.php');
    $controller = new AdminController();
    $array = $controller->handleGetLecturer();
?>

<script>
if (typeof window.updateSuccessful !== 'undefined') {
    if (window.updateSuccessful) {
        location.reload(); // Reload the page only if update was successful
    }
    // Reset the variable to prevent further reloads
    window.updateSuccessful = undefined;
}
</script>

<form method="post" action="">
    <div>
        <h1>Thông tin giảng viên</h1>
    </div>
    <div class="w-100">
        <h2>Thông tin cá nhân</h2>
        <div class="d-flex">
            <div>
                <img src="http://localhost/prj_student/public/imgs/avatar-1577909_640.png" />
                <hr>
                <p><?php echo $array[0][0]['hoTen']; ?></p>
                <p><?php echo $array[0][0]['maNhanVien']; ?></p>
            </div>
            <div>
                <div class="form-group mt-2">
                    <label class="pb-2" for="hoTen">Họ và Tên</label>
                    <input type="text" class="form-control" name="hoTen" value="<?php echo $array[0][0]['hoTen']; ?>" >
                </div>
                <div class="form-group mt-2">
                    <label class="pb-2" for="ngaySinh">Ngày sinh</label>
                    <input type="date" class="form-control" name="ngaySinh" value="<?php echo $array[0][0]['ngaySinh']; ?>" >
                </div>
                <div class="form-group mt-2">
                    <label class="pb-2" for="gioiTinh">Giới tính</label>
                    <select class="form-select" name="gioiTinh" >
                        <option value="Nam" <?php if ($array[0][0]['gioiTinh'] === 'Nam') echo 'selected="selected"'; ?> >Nam</option>
                        <option value="Nữ" <?php if ($array[0][0]['gioiTinh'] === 'Nữ') echo 'selected="selected"'; ?> >Nữ</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <label class="pb-2" for="diaChi">Địa Chỉ</label>
                    <input type="text" class="form-control" name="diaChi" placeholder="Địa Chỉ" value="<?php echo $array[0][0]['diaChi']; ?>" >
                </div>
                <div class="form-group mt-2">
                    <label class="pb-2" for="chucVu">Chức vụ</label>
                    <input type="text" class="form-control" name="chucVu" placeholder="Chức vụ" value="<?php echo $array[0][0]['chucVu']; ?>" >
                </div>
                <div class="form-group mt-2">
                    <label class="pb-2" for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $array[0][0]['email']; ?>" >
                </div>
                <div class="form-group mt-2">
                    <label class="pb-2" for="tel">Số điện thoại</label>
                    <input type="text" class="form-control" name="tel" placeholder="Số điện thoại" value="<?php echo $array[0][0]['soDienThoai']; ?>" >
                </div>
            </div>
        </div>
    </div>
    <div>
        <h2>Giảng dạy</h2>
        <div class="form-group mt-2">
            <label class="pb-2" for="khoa_selector">Khoa</label>
            <select name="khoa_selector" class="form-select" aria-label="Default select example">
                <option selected>Khoa</option>
                <?php
                    while ($row =mysqli_fetch_assoc($array[1])) {
                        if($row['maKhoa'] == $array[0][0]['maKhoa']) {
                            echo '<option selected="selected" value="'.$row['maKhoa'].'">'.$row['tenKhoa'].'</option>';

                        } else {
                            echo '<option value="'.$row['maKhoa'].'">'.$row['tenKhoa'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <table class="table mt-4">
            <?php
                if(isset($array[2])) {
                    $index = 0;
                    echo "<thead>
                    <tr>
                        <th>#</th>
                        <th>Mã lớp</th>
                        <th>Sĩ số</th>
                        <th>Mã học phần</th>
                    </tr>
                    </thead>
                    <tbody>";
                    while($row = mysqli_fetch_assoc($array[2])) {
                        echo '<tr>';
                        echo"<td class='table-cell'>".$index."</td>";
                        echo"<td class='table-cell'>".$row["maLop"]."</td>";
                        echo"<td class='table-cell'>".$row["siSo"]."</td>";
                        echo"<td class='table-cell'>".$row["maHocPhan"]."</td>";
                        echo '</tr>';
                        $index++;
                    }
                    echo "</tbody>";
                }
            ?>
        </table>
    </div>
    <div class="form-group mt-4">
        <button name="change_lecturerInfo" type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <button name="delete_lecturer" type="submit" class="btn btn-danger">Xóa</button>
    </div>
</form>

<?php
    if(isset($_POST['change_lecturerInfo'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleUpdateLecturer($array[0]);
    } else if(isset($_POST['delete_lecturer'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleDeleteLecturer($array[0][0]['maNhanVien']);
    }
?>