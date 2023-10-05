<?php
    require_once('./Controllers/StudentController.php');
    $controller = new StudentController();
    $array = $controller->getStudentInfo($_SESSION['username']);
?>

<div class="mt-4">
    <h3>DS Học phần đã đăng ký</h3>
    <form action="" method="post">
        <div class="form-group mt-2">
            <label class="pb-2" for="hocky_selector">Học kỳ</label>
            <select name="hocky_selector" class="form-select" aria-label="Default select example">
                <option selected>Học kỳ</option>
                <?php
                    $startYear = 1949 + intval($array[0][0]['khoa']);
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
        <button type="submit" name="search_sbj" class="btn btn-primary mt-4 mb-5">Tìm kiếm</button>
    </form>
</div>

<?php
    if(isset($_POST['search_sbj'])) {
        $khoa = $_POST['hocky_selector'];
        require_once('./Controllers/StudentController.php');
        $controller = new StudentController();
        $data = $controller->handleGetStudentSbj($_SESSION['username'], $khoa);

        if(isset($data)) {
            echo "<h4>Danh sách học phần $khoa</h4>";
            $index = 0;
            echo '<table class="table mt-4">';
            echo "<thead>
            <tr>
                <th>#</th>
                <th>Mã học phần</th>
                <th>Tên môn học</th>
                <th>Học phí một tín</th>
                <th>Số tín chỉ</th>
            </tr>
            </thead>
            <tbody>";
            foreach ($data as $row) {
                echo '<tr>';
                echo"<td class='table-cell'>".$index."</td>";
                echo"<td class='table-cell'>".$row["maHocPhan"]."</td>";
                echo"<td class='table-cell'>".$row["tenMonHoc"]."</td>";
                echo"<td class='table-cell'>".$row["hocPhiMotTin"]."</td>";
                echo"<td class='table-cell'>".$row["soTinChi"]."</td>";
                echo '</tr>';
                $index++;
            }
            echo "</tbody>";
            echo "</table>";
        }
    }
?>