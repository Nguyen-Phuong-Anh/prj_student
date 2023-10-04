<?php
<<<<<<< HEAD
    require_once('./Controllers/StudentController.php');
    $controller = new StudentController();
    $array = $controller->getStudentInfo($_SESSION['username']);
?>

<div class="mt-5">
    <h2 class="mt-4 ml-3">Thông tin sinh viên</h2>
    <div class="d-flex">
        <div>
            <img src="http://localhost/prj_student/public/imgs/avatar-1577909_640.png" />
            <hr>
            <p><?php echo $array[0][0]['hoTen']; ?></p>
            <p><?php echo $array[0][0]['maSinhVien']; ?></p>
        </div>

        <div class="ms-5">
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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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
                            foreach ($array[1] as $row) {
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
            </div>
=======
    require_once('./Controllers/studentController.php');
    $controller = new studentController(); 
    $data = $controller->getStudent($_SESSION['username']);
    // print_r($data);
?>
<div class="mt-5">
    <h2 class="mt-4 ml-3">Thông tin sinh viên</h2>
    <form action="" method="post" class="wrapper ml-4" id="studentForm">
    <?php
    
    if(isset($data)) {  
        while($row = mysqli_fetch_assoc($data)) {
            echo '<tr>';
            echo'<p>Mã sinh viên</p>';
            echo"<p class='form-control'>".$row["maSinhVien"]."</p>";
            echo'<p>Khoa</p>';
            echo"<p class='form-control'>".$row["khoa"]."</p>";
            echo'<p>Học kỳ hiện tại</p>';
            echo"<p class='form-control'>".$row["hocKyHienTai"]."</p>";
            echo'<p>Họ và Tên</p>';
            echo"<p class='form-control'>".$row["hoTen"]."</p>";
            echo'<p>Ngày sinh</p>';
            echo"<p class='form-control'>".$row["ngaySinh"]."</p>";
            echo'<p>Giới tính</p>';
            echo"<p class='form-control'>".$row["gioiTinh"]."</p>";
            echo'<p>Địa chỉ</p>';
            echo"<p class='form-control'>".$row["diaChi"]."</p>";
            echo'<p>Gmail</p>';
            echo"<p class='form-control'>".$row["gmail"]."</p>";
            echo'<p>Số điện thoại</p>';
            echo"<p class='form-control'>".$row["soDienThoai"]."</p>";

            echo '<td class="table-cell"> 
            <button class="btn btn-light" name"123" type="button" data-bs-toggle="modal" 
            data-bs-target="#StudentModal'.$row['maSinhVien'].'">Sửa</button>
            </td>';
            echo '</tr>';
            echo 
            '<div class="modal fade" id="StudentModal'.$row['maSinhVien'].'" tabindex="-1" aria-labelledby="StudentModal'.$row['maSinhVien'].'" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="">Sửa thông tin sinh viên</h3>                
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="post">
                            <div class="modal-body">
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
                        
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" name="save_change" class="btn btn-primary">Lưu thay đổi
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>';
                }
            }
        ?>
>>>>>>> 7d7b2240323f1260faaa1dca9b86c1434fbeb950
    </form>
    </div>
    </div>
  </div>
</div>
<<<<<<< HEAD

<?php
    if(isset($_POST['change_stdInfo'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleUpdateStudent($array[0]);
    }
?>
=======
>>>>>>> 7d7b2240323f1260faaa1dca9b86c1434fbeb950
