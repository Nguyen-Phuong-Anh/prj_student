<?php
    require_once('./Controllers/AdminController.php');
    $controller = new AdminController();
    $data = $controller->showKhoa();
?>

<div>
    <form action="" method="post" class="wrapper ml-4">
        <div>
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
                <label class="pb-2" for="maNV">Mã nhân viên</label>
                <input type="text" class="form-control" name="maNV" placeholder="Mã NV" >
            </div>
            <div class="form-group mt-3">
                <button name="search_lecturer" type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </div>
    </form>

    <table class="table mt-4">
        <?php
            if(isset($_POST['search_lecturer'])) {
                require_once('./Controllers/AdminController.php');
                $controller = new AdminController();
                $data = $controller->handleSearchLecturer();
                if(isset($data)) {
                    $index = 0;
                    echo "<thead>
                    <tr>
                        <th>#</th>
                        <th>Mã nhân viên</th>
                        <th>Tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Chức vụ</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>";
                    while($row = mysqli_fetch_assoc($data)) {
                        echo '<tr>';
                        echo"<td class='table-cell'>".$index."</td>";
                        echo"<td class='table-cell'>".$row["maNhanVien"]."</td>";
                        echo"<td class='table-cell'>".$row["hoTen"]."</td>";
                        echo"<td class='table-cell'>".$row["ngaySinh"]."</td>";
                        echo"<td class='table-cell'>".$row["gioiTinh"]."</td>";
                        echo"<td class='table-cell'>".$row["chucVu"]."</td>";
                        echo '<td class="table-cell"> 
                            <button class="btn btn-light" type="button"><a href="?route=lecturer_info&param='.$row['maNhanVien'].'" class="nav-link">
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

