<div class="mt-4">
    <h3>Thêm điểm sinh viên</h3>
    <form action="" method="post">
        <div class="form-group mt-2">
            <label class="pb-2" for="hocky_selector">Học kỳ</label>
            <select name="hocky_selector" class="form-select" aria-label="Default select example">
                <option selected>Học kỳ</option>
                <?php
                    $startYear = 1949 + intval($_GET['khoa']);
                    $currentYear = intval(date("Y"));
                    $length = $currentYear - $startYear;
                    for($a = 0; $a <= $length; $a++) {
                        $year = $startYear + 1;
                        echo '<option value="Năm học '.$startYear.' - '.$year.' - Học kỳ 1'.$b.'">Năm học '.$startYear.' - '.$year.' - Học kỳ 1</option>';
                        echo '<option value="Năm học '.$startYear.' - '.$year.' - Học kỳ 2'.$b.'">Năm học '.$startYear.' - '.$year.' - Học kỳ 2</option>';
                        ++$startYear;
                    }
                ?>
            </select>
        </div>
        <button type="submit" name="search_hocKy" class="btn btn-primary mt-4">Tìm kiếm</button>
    </form>
</div>

<div>
    <form action="" method="post">
        <div class="form-group mt-3">
            <label class="pb-2" for="hocPhan_selector">Học phần</label>
            <select name="hocPhan_selector" class="form-select" aria-label="Default select example">
                <option selected>Học phần</option>
                <?php
                    if(isset($_POST['search_hocKy'])) {
                        echo '<input type="hidden" value="'.$_POST['search_hocKy'].'" name="hocKy" >';
                        require_once('./Controllers/StudentController.php');
                        $controller = new StudentController();
                        $data = $controller->handleGetStudentSbj($_GET['maSV']);
                        if(!empty($data)) {
                            require_once('./Controllers/LecturerController.php');
                            $controller1 = new LecturerController();
                            foreach ($data as $row) {
                                $data1 = $controller1->handleGetHPName($row['maHocPhan']);
                                if(isset($data)) {
                                    echo '<option value="'.$row['maHocPhan'].'">'.$data.'</option>';
                                }
                            }
                        }
                    }
                ?>
            </select>
        </div>
        <div class="form-group mt-3">
            <label class="pb-2" for="diemCC">Điểm chuyên cần</label>
            <input type="number" class="form-control w-50" name="diemCC" value="'.$row["diemCC"].'">
        </div>
        <div class="form-group mt-3">
            <label class="pb-2" for="diemTH">Điểm thực hành</label>
            <input type="number" class="form-control w-50" name="diemTH" value="'.$row["diemTH"].'">
        </div>
        <div class="form-group mt-3">
            <label class="pb-2" for="diemTL">Điểm thảo luận</label>
            <input type="number" class="form-control w-50" name="diemTL" value="'.$row["diemTL"].'">
        </div>
        <div class="form-group mt-3">
            <label class="pb-2" for="diemKetThuc">Điểm kết thúc</label>
            <input type="number" class="form-control w-50" name="diemKetThuc" value="'.$row["diemKetThuc"].'">
        </div>
        <div class="form-group mt-3">
            <label class="pb-2" for="diemTongKet">Điểm tổng kết</label>
            <input type="number" class="form-control w-50" name="diemTongKet" value="'.$row["diemTongKet"].'">
        </div>
        <div class="form-group mt-3">
            <label class="pb-2" for="diemChu">Điểm chữ</label>
            <input type="number" class="form-control w-50" name="diemChu" value="'.$row["diemChu"].'">
        </div>

        <div class="form-group mt-5">
            <button type="submit" name="save" class="btn btn-primary me-4">Lưu</button>
            <button type="submit" name="clear" class="btn btn-light">Clear</button>
        </div>
    </form>
</div>

<?php
    if(isset($_POST['save'])) {
        require_once('./Controllers/LecturerController.php');
        $controller = new LecturerController();
        $controller->handleAddPoint();
    } else if(isset($_POST['clear'])) {

    }
?> 