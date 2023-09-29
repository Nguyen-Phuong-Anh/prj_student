<div class="mt-5">
    <h2 class="mt-4 ml-3">Thêm Mới Học Phần</h2>
    <form action="" method="post" class="wrapper ml-4" id="studentForm">
        <div>
            <div class="form-group mt-2">
                <label class="pb-2" for="maHocPhan">Mã học phần</label>
                <input type="text" class="form-control" name="maHocPhan" >
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
            <div class="form-group mt-2">
                <label class="pb-2" for="tenMonHoc">Tên môn học</label>
                <input type="text" class="form-control" name="tenMonHoc">
            </div>
            <div class="form-group mt-2">
                <label class="pb-2" for="soTinChi">Số tín chỉ</label>
                <input type="number" class="form-control" name="soTinChi" >
            </div>
            <div class="form-check mt-3 mb-2">
                    <input class="form-check-input" type="checkbox" name="batBuoc" value="checked"
                >
                <label class="form-check-label" for="batBuoc">
                    Bắt buộc
                </label>
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="hocPhiMotTin">Học phí một tín</label>
                <input type="text" class="form-control" name="hocPhiMotTin" >
            </div>
            <div class="form-group mt-4">
                <button name="submit_subject" type="submit" class="btn btn-primary">Thêm</button>
                <button name="clear" type="submit" class="btn btn-light">Clear</button>
            </div>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['submit_subject'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleAddSubject();
    } else {
        $_POST['maHocPhan'] = '';
        $_POST['tenMonHoc'] = '';
        $_POST['soTinChi'] = '';
        $_POST['batBuoc'] = 'unchecked';
        $_POST['hocPhiMotTin'] = '';
    }
?>