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

<div class="insideBody">
    <h2 class="mt-4">Danh sách học phần</h2>
    <form action="" method="post">
        <div class="form-group mt-3">
            <label class="pb-2" for="khoa_selector">Khoa</label>
            <select name="khoa_selector" class="form-select" aria-label="Default select example">
                <option>Khoa</option>
                <?php
                    while ($row =mysqli_fetch_assoc($data)) {
                        echo '<option value="'.$row['maKhoa'].'">'.$row['tenKhoa'].'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group mt-3">
            <button name="search_subject" type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>

    <table class="table mt-4">
        <?php
            if(isset($_POST['search_subject'])) {
                require_once('./Controllers/AdminController.php');
                $controller = new AdminController();
                $data = $controller->handleSearchSubject();
                if(isset($data)) {
                    $index = 0;
                    echo "<thead>
                    <tr>
                        <th>#</th>
                        <th>Mã học phần</th>
                        <th>Tên môn học</th>
                        <th>Số tín chỉ</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>";
                    while($row = mysqli_fetch_assoc($data)) {
                        echo '<tr>';
                        echo"<td class='table-cell'>".$index."</td>";
                        echo"<td class='table-cell'>".$row["maHocPhan"]."</td>";
                        echo"<td class='table-cell'>".$row["tenMonHoc"]."</td>";
                        echo"<td class='table-cell'>".$row["soTinChi"]."</td>";
                        echo '<td class="table-cell"> 
                            <button class="btn btn-light" type="button"><a href="?route=subject_info&param='.$row['maHocPhan'].'" class="nav-link">
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