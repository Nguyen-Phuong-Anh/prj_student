<?php
    require_once('./Controllers/AdminController.php');
    $controller = new AdminController();
    $data = $controller->showKhoa();
?>

<div>
    <form action="" method="post" class="wrapper ml-4">
        <div>
            <div class="form-group mt-3">
                <label class="pb-2" for="khoa_selector">Mã Học phí</label>
                <select name="khoa_selector" class="form-select" aria-label="Default select example">
                    <option>Mã học phí</option>
                    <?php
                        while ($row =mysqli_fetch_assoc($data)) {
                            echo '<option value="'.$row['maKhoa'].'">'.$row['tenKhoa'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="form-group mt-3">
                <label class="pb-2" for="maSV">Mã SV</label>
                <input type="text" class="form-control" name="maSV" placeholder="Mã SV" >
            </div>
            <div class="form-group mt-3">
                <button name="search_tuition" type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <table class="table mt-4">
        <?php
            if(isset($_POST['search_tuition'])) {
                require_once('./Controllers/AdminController.php');
                $controller = new AdminController();
                $data = $controller->handleSearchTuition();
                if(isset($data)) {
                    $index = 0;
                    echo "<thead>
                    <tr>
                        <th>#</th>
                        <th>Mã sinh viên</th>
                        <th>Mã khoa</th>
                        <th>Học kỳ</th>
                        <th>Tổng học phí</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>";
                    while($row = mysqli_fetch_assoc($data)) {
                        echo '<tr>';
                        echo"<td class='table-cell'>".$index."</td>";
                        echo"<td class='table-cell'>".$row["maSinhVien"]."</td>";
                        echo"<td class='table-cell'>".$row["maKhoa"]."</td>";
                        echo"<td class='table-cell'>".$row["hocKy"]."</td>";
                        echo"<td class='table-cell'>".$row["tongHocPhi"]."</td>";
                        echo '<td class="table-cell"> 
                            <button class="btn btn-light" type="button"><a href="?route=tuition_info&param='.$row['maHocPhi'].'" class="nav-link">
                            Chi tiết
                          </a></button>
                            </td>';
                        echo '</tr>';
                        $index++;
                    }
                    echo "</tbody>";
                }
            }
        ?>
    </table>
</div>