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
    <h2 class="mt-4">Học phí</h2>
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
        <button type="submit" name="search_tuition" class="btn btn-primary mt-4 mb-4">Tìm kiếm</button>
    </form>
    
    <?php
        if(isset($_POST['search_tuition'])) {
            $khoa = $_POST['hocky_selector'];
            require_once('./Controllers/StudentController.php');
            $controller = new StudentController();
            $data = $controller->handlegetStudentTuition($_SESSION['username'], $khoa);
        }
    ?>

    <table class="table mt-4">
        <?php
            if(isset($data)) {
                $index = 0;
                echo "<h3>Học phí $khoa</h3>";
                echo "<thead>
                <tr>
                    <th>#</th>
                    <th>Mã học phần</th>
                    <th>Học phí một tín</th>
                    <th>Số tín chỉ</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>";
                while($row = mysqli_fetch_assoc($data)) {
                    echo '<tr>';
                    echo"<td class='table-cell'>".$index."</td>";
                    echo"<td class='table-cell'>".$row["maHocPhan"]."</td>";
                    echo"<td class='table-cell'>".$row["hocPhiMotTin"]."</td>";
                    echo"<td class='table-cell'>".$row["soTinChi"]."</td>";
                    echo"<td class='table-cell'>".$row["thanhTien"]."</td>";
                    echo '</tr>';
                    $index++;
                }
                echo "</tbody>";
            }
        ?>
    </table>
</div>
