<?php
    require_once('./Controllers/AdminController.php');
    $controller = new AdminController();
    $data = $controller->showKhoa();
?>

<style>
    .insideBody {
        height: 100%;
        width: 80%;
        padding-right: 20px;
    }
</style>

<div class="mt-4 insideBody">
    <h2 class="mt-4 ml-3">Thêm Mới Lớp Học</h2>
    <form action="" method="post">
        <div class="form-group mt-3">
            <label class="pb-2" for="khoa_selector">Khoa</label>
            <select name="khoa_selector" class="form-select" aria-label="Khoa select">
                <option>Khoa</option>
                <?php
                    while ($row =mysqli_fetch_assoc($data)) {
                        echo '<option value="'.$row['maKhoa'].'">'.$row['tenKhoa'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group mt-3 mb-4">
            <button name="search_subject" type="submit" class="btn btn-primary">Tìm kiếm học phần khoa</button>
        </div>
    </form>
    <form action="" method="post" class="ml-4">
        <div class="form-group mt-2">
            <label class="pb-2" for="maLop">Mã lớp</label>
            <input type="text" class="form-control" name="maLop">
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="siSo">Sĩ số</label>
            <input type="number" class="form-control" name="siSo" readonly value="0">
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="siSoToiDa">Sĩ số tối đa</label>
            <input type="number" class="form-control" name="siSoToiDa" >
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="subject_selector">Học phần</label>
            <select name="subject_selector" class="form-select" aria-label="Subject select">
                <?php
                    if(isset($_POST['search_subject'])) {
                        require_once('./Controllers/AdminController.php');
                        $controller = new AdminController();
                        $data = $controller->handleSearchSubject();
                        if(isset($data)) {
                            while($row = mysqli_fetch_assoc($data)) {
                                echo '<option value="'.$row['maHocPhan'].'">'.$row['tenMonHoc'].'</option>';
                            }
                        }
                    }
                ?>
            </select>
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="thoiGian">Thời gian</label>
            <input type="text" class="form-control" name="thoiGian">
        </div>
        <div class="form-group mt-2">
            <label class="pb-2" for="diaDiem">Địa điểm</label>
            <input type="text" class="form-control" name="diaDiem">
        </div>
        <div class="form-group mt-4">
            <button name="submit_class" type="submit" class="btn btn-primary">Thêm</button>
            <button name="clear" type="submit" class="btn btn-light">Clear</button>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['submit_class'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleAddClass();
    } else if($_POST['clear']){
        $_POST['maLop'] = '';
        $_POST['siSo'] = '';
        $_POST['siSoToiDa'] = '';
        $_POST['thoiGian'] = '';
        $_POST['diaDiem'] = '';
    }
?>