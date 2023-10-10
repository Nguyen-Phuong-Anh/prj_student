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


<div class="insideBody">
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
        <button type="submit" name="search_point" class="btn btn-primary mt-4">Tìm kiếm</button>
    </form>
</div>

<?php
    if(isset($_POST['search_point'])) {
        $khoa = $_POST['hocky_selector'];
        require_once('./Controllers/StudentController.php');
        $controller = new StudentController();
        $data = $controller->getStudentPoint($_SESSION['username'], $khoa);
    }
?>

<table class="table mt-4">
    <?php
        if(isset($data)) {
            $index = 0;
            echo "<thead>
            <tr>
                <th>#</th>
                <th>Mã học phần</th>
                <th>Điểm CC</th>
                <th>Điểm TH</th>
                <th>Điểm TL</th>
                <th>Điểm kết thúc</th>
                <th>Điểm tổng kết</th>
                <th>Điểm chữ</th>
            </tr>
            </thead>
            <tbody>";
            while($row = mysqli_fetch_assoc($data)) {
                echo '<tr>';
                echo"<td class='table-cell'>".$index."</td>";
                echo"<td class='table-cell'>".$row["maHocPhan"]."</td>";
                echo"<td class='table-cell'>".$row["diemCC"]."</td>";
                echo"<td class='table-cell'>".$row["diemTH"]."</td>";
                echo"<td class='table-cell'>".$row["diemTL"]."</td>";
                echo"<td class='table-cell'>".$row["diemKetThuc"]."</td>";
                echo"<td class='table-cell'>".$row["diemTongKet"]."</td>";
                echo"<td class='table-cell'>".$row["diemChu"]."</td>";
                echo '</tr>';
                $index++;
            }
            echo "</tbody>";
        }
    ?>
</table>