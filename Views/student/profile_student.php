<?php
    require_once('./Controllers/StudentController.php');
    $controller = new StudentController();
    $array = $controller->getStudentInfo($_SESSION['username']);
?>

<style>
    .insideBody {
        height: 100%;
        width: 80%;
        padding-right: 20px;
    }
    
    .group2 {
        margin-left: 40px;
        width: 100%;
    }
</style>

<div class="mt-5 insideBody">
    <h2 class="mt-4 ml-3">Thông tin sinh viên</h2>
    <div class="d-flex mt-3">
        <div>
            <img src="http://localhost/prj_student/public/imgs/avatar-1577909_640.png" />
            <hr>
            <p><?php echo $array[0][0]['hoTen']; ?></p>
            <p><?php echo $array[0][0]['maSinhVien']; ?></p>
        </div>

        <div class="ms-5 group2">
            <div>
                <p><strong>Họ và Tên</strong></p>
                <p><?php echo $array[0][0]['hoTen']; ?></p>
            </div>
            <div>
                <p><strong>Ngày sinh</strong></p>
                <p><?php echo $array[0][0]['ngaySinh']; ?></p>
            </div>
            <div>
                <p><strong>Giới tính</strong></p>
                <p><?php echo $array[0][0]['gioiTinh']; ?></p>
            </div>
            <div>
                <p><strong>Địa Chỉ</strong></p>
                <p><?php echo $array[0][0]['diaChi']; ?></p>
            </div>
            <div>
                <p><strong>Email</strong></p>
                <p><?php echo $array[0][0]['email']; ?></p>
            </div>
            <div>
                <p><strong>Số điện thoại</strong></p>
                <p><?php echo $array[0][0]['soDienThoai']; ?></p>
            </div>
            <div>
                <p><strong>Niên khóa</strong></p>
                <p><?php echo $array[0][0]['khoa']; ?></p>
            </div>
            <div>
                <p><strong>Khoa</strong></p>
                <p>
                    <?php
                        foreach ($array[1] as $row) {
                            if($row['maKhoa'] === $array[0][0]['maKhoa']) {
                                echo $row['tenKhoa'];
                            }
                        }
                    ?>
                </p>
            </div>
            <div>
                <p><strong>Học kỳ hiện tại</strong></p>
                <p><?php echo $array[0][0]['hocKyHienTai']; ?></p>
            </div>
            <div class="mt-5">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">Sửa thông tin</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-lg" id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
            <div>
                <h1>Thông tin sinh viên</h1>
            </div>
            <div class="w-100">
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
                        <label class="pb-2" for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo $array[0][0]['email']; ?>" >
                    </div>
                    <div class="form-group mt-2">
                        <label class="pb-2" for="tel">Số điện thoại</label>
                        <input type="text" class="form-control" name="tel" placeholder="Số điện thoại" value="<?php echo $array[0][0]['soDienThoai']; ?>" >
                    </div>
                </div>
            </div>
            <div class="form-group mt-4">
                <button name="change_stdInfo" type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </div>
    </form>
    </div>
    </div>
  </div>
</div>

<?php
    if(isset($_POST['change_stdInfo'])) {
        require_once('./Controllers/StudentController.php');
        $controller = new StudentController();
        $controller->handleUpdateStudent($array[0]);
    }
?>
