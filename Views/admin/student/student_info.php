<?php
    require_once('./Controllers/AdminController.php');
    $controller = new AdminController();
    $array = $controller->handleGetStudent();
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

<form class="insideBody mt-4" method="post" action="">
    <div>
        <h1>Thông tin sinh viên</h1>
    </div>
    <div class="w-100">
        <div class="d-flex mt-4">
            <div>
                <img src="http://localhost/prj_student/public/imgs/avatar-1577909_640.png" />
                <hr>
                <p><?php echo $array[0][0]['hoTen']; ?></p>
                <p><?php echo $array[0][0]['maSinhVien']; ?></p>
            </div>
            <div class="group2">
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
    </div>
    <div>
        <div class="form-group mt-2">
            <label class="pb-2" for="nienKhoa">Niên khóa</label>
            <input type="text" class="form-control" name="nienKhoa" value="<?php echo $array[0][0]['khoa']; ?>" >
        </div>
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
        <div class="form-group mt-2">
            <label class="pb-2" for="hocKy">Học kỳ hiện tại</label>
            <input type="text" class="form-control" name="hocKy" value="<?php echo $array[0][0]['hocKyHienTai']; ?>" placeholder="<?php echo 'VD: ' . $array[0][0]['hocKyHienTai']; ?>">
        </div>
    </div>
    <div class="form-group mt-4">
        <button name="change_stdInfo" type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
    </div>
</form>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Confirm</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you want to delete this student?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
        <form action="" method="post">
            <button name="delete_std" type="submit" class="btn btn-danger">Xóa</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
    if(isset($_POST['change_stdInfo'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleUpdateStudent($array[0]);
    } else if(isset($_POST['delete_std'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleDeleteStudent($array[0][0]['maSinhVien']);
    }
?>