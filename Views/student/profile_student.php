<?php
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
    </form>
</div>
