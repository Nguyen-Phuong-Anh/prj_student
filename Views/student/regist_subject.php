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
</style>

<div class="mt-4 insideBody">
    <h2>Đăng ký học phần</h2>
    <form action="" method="post">
        <div class="form-group mt-2">
            <label class="pb-2" for="hocky_selector">Học kỳ</label>
            <select name="hocky_selector" class="form-select" aria-label="Default select example">
                <?php
                    $currentYear = intval(date("Y"));
                    for($a = 1; $a < 2; $a++) {
                        $year = $currentYear + 1;
                        echo '<option value="Năm học '.$currentYear.' - '.$year.' - Học kỳ 1'.$b.'">Năm học '.$currentYear.' - '.$year.' - Học kỳ 1</option>';
                        if(!stripos($array[0][0]['hocKyHienTai'], "Học kỳ 1")) {
                            echo '<option value="Năm học '.$currentYear.' - '.$year.' - Học kỳ 2'.$b.'">Năm học '.$currentYear.' - '.$year.' - Học kỳ 2</option>';
                        }
                    }
                ?>
            </select>
        </div>

        <div class="form-group mt-5">
            <h4>Danh sách học phần có thể đăng ký</h4>
            <?php
                require_once('./Controllers/StudentController.php');
                $controller = new StudentController();
                $data = $controller->handleGetHP($array[0][0]['maKhoa']);
                if(isset($data)) {
                    $index = 0;
                    echo '<table class="table mt-4">';
                    echo "<thead>
                    <tr>
                        <th>#</th>
                        <th>Mã học phần</th>
                        <th>Tên môn học</th>
                        <th>Học phí một tín</th>
                        <th>Bắt buộc</th>
                        <th>Số tín chỉ</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>";
                    foreach ($data as $row) {
                        echo '<tr>';
                        echo"<td class='table-cell'>".$index."</td>";
                        echo"<td class='table-cell'>".$row["maHocPhan"]."</td>";
                        echo"<td class='table-cell'>".$row["tenMonHoc"]."</td>";
                        echo"<td class='table-cell'>".$row["hocPhiMotTin"]."</td>";
                        if($row["batBuoc"] === 1) {
                            echo"<td class='table-cell'>Có</td>";
                        } else {
                            echo"<td class='table-cell'>Không</td>";
                        }
                        echo"<td class='table-cell'>".$row["soTinChi"]."</td>";
                        echo '<td class="table-cell">
                            <input class="form-check-input" type="radio" value="' . $row['maHocPhan'] . '" name="hocphanDK">
                        </td>';

                        echo '</tr>';
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                }
            ?>
        </div>
        <div class="form-group mt-4">
            <h4>Lớp</h4>
            <?php
                require_once('./Controllers/StudentController.php');
                $controller = new StudentController();
                $arr = array();
                foreach ($data as $row) {
                    $class = $controller->handlGetClass($row['maHocPhan']);
                    if($class) {
                        $arr[] = $class;
                    }
                }
                
                if(isset($arr)) {
                    $index = 0;
                    echo '<table class="table mt-4">';
                    echo "<thead>
                    <tr>
                        <th>#</th>
                        <th>Tên lớp</th>
                        <th>Mã học phần</th>
                        <th>Sĩ số</th>
                        <th>Sĩ số tối đa</th>
                        <th>Thời gian</th>
                        <th>Địa điểm</th>
                    </tr>
                    </thead>
                    <tbody>";
                    foreach ($arr as $row) {
                        echo '<tr>';
                        echo"<td class='table-cell'>".$index."</td>";
                        echo"<td class='table-cell'>".$row[0]["tenLop"]."</td>";
                        echo"<td class='table-cell'>".$row[0]["maHocPhan"]."</td>";
                        echo"<td class='table-cell'>".$row[0]["siSo"]."</td>";
                        echo"<td class='table-cell'>".$row[0]["siSoToiDa"]."</td>";
                        echo"<td class='table-cell'>".$row[0]["thoiGian"]."</td>";
                        echo"<td class='table-cell'>".$row[0]["diaDiem"]."</td>";
                        echo '<td class="table-cell">
                            <input class="form-check-input" type="radio" value="'.$row[0]['maLop'].'" name="lopDK">
                        </td>';
                        echo '</tr>';
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                }
            ?>
        </div>
        <button type="submit" name="regist_sbj" class="btn btn-primary mt-4">Đăng ký</button>
    </form>
</div>

<?php
    if(isset($_POST['regist_sbj'])) {
        require_once('./Controllers/StudentController.php');
        $controller = new StudentController();
        if(isset($_POST['hocky_selector']) && isset($_POST['hocphanDK']) && isset($_POST['lopDK'])) {
            $controller->handleRegistSbj($array[0][0]['maSinhVien'], $array[0][0]['maKhoa']);
        } else 
            echo '<script>alert("Please fill all the information")</script>';
    }
?>