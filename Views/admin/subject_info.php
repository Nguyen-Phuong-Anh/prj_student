<?php
    require_once('./Controllers/AdminController.php');
    $controller = new AdminController();
    $array = $controller->handleGetSubject();
?>

<form method="post" action="">
    <div>
        <h1>Chi tiết học phần</h1>
    </div>
    <div>
        <div class="form-group mt-2">
            <label class="pb-2" for="maHocPhan">Mã học phần</label>
            <input type="text" class="form-control" name="maHocPhan" value="<?php echo $array[0][0]['maHocPhan']; ?>" readonly >
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="khoa_selector">Khoa</label>
            <select name="khoa_selector" class="form-select" aria-label="Default select example">
                <option selected>Khoa</option>
                <?php
                    while ($row =mysqli_fetch_assoc($array[1])) {
                        if($row['maKhoa'] == $array[0][0]['maKhoa']) {
                            echo '<option selected="selected" value="'.$row['maKhoa'].'">'.$row['tenKhoa'].' - '.$row['maKhoa'].'</option>';

                        } else {
                            echo '<option value="'.$row['maKhoa'].'">'.$row['tenKhoa'].' - '.$row['maKhoa'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="tenMonHoc">Tên môn học</label>
            <input type="text" class="form-control" name="tenMonHoc" value="<?php echo $array[0][0]['tenMonHoc']; ?>" >
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="soTinChi">Số tín chỉ</label>
            <input type="number" class="form-control" name="soTinChi" value="<?php echo $array[0][0]['soTinChi']; ?>" >
        </div>
        <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" name="batBuoc" value="checked"
                <?php if ($array[0][0]['batBuoc'] === 1) echo 'checked'; ?>
            >
            <label class="form-check-label" for="batBuoc">
                Bắt buộc
            </label>
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="hocPhiMotTin">Học phí một tín</label>
            <input type="text" class="form-control" name="hocPhiMotTin" value="<?php echo $array[0][0]['hocPhiMotTin']; ?>" >
        </div>
    </div>
    <div class="form-group mt-4">
        <button name="change_sbjInfo" type="submit" class="btn btn-primary">Lưu thay đổi</button>
        <button name="delete_sbj" type="submit" class="btn btn-danger">Xóa</button>
    </div>
</form>

<?php
    if(isset($_POST['change_sbjInfo'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleUpdateSubject($array[0]);
    } else if(isset($_POST['delete_sbj'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleDeleteSubject($array[0][0]['maHocPhan']);
    }
?>