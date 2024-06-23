<?php
    require_once('./Controllers/LecturerController.php');
    $controller = new LecturerController();
    $array = $controller->getLecturerInfo($_SESSION['username']);
?>

<style>
    .insideBody {
        height: 100%;
        width: 80%;
        padding-right: 20px;
    }
</style>

<div class="mt-4 insideBody">
    <h2>Tìm kiếm sinh viên</h2>
    <form action="" method="post">
        <div class="form-group mt-2">
            <label class="pb-2" for="khoa">Khoa</label>
            <input readonly type="text" class="form-control" name="khoa" 
                value="<?php
                foreach ($array[1] as $row) {
                    if($row['maKhoa'] === $array[0][0]['maKhoa']) {
                        echo $row['tenKhoa'];
                        break;
                    }
                }
            ?>" >
            <input readonly type="hidden" class="form-control" name="khoa" 
                value="<?php
                foreach ($array[1] as $row) {
                    if($row['maKhoa'] === $array[0][0]['maKhoa']) {
                        echo $row['maKhoa'];
                        break;
                    }
                }
            ?>" >
        </div>
        <div class="form-group mt-2 mb-4">
            <label class="pb-2" for="maSV">Mã sinh viên</label>
            <input type="text" class="form-control" name="maSV" >
        </div>
        <button name="search_std" type="submit" class="btn btn-primary">Tìm kiếm</button>
    </form>

    <?php
    if(isset($_POST['search_std'])) {
        require_once('./Controllers/LecturerController.php');
        $controller = new LecturerController();
        $data = $controller->handleSearchStudent();

        if(isset($data)) {
            $index = 0;
            echo '<table class="table mt-4">';
            echo "<thead>
            <tr>
                <th>#</th>
                <th>Mã sinh viên</th>
                <th>Khóa</th>
                <th>Tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th></th>
            </tr>
            </thead>
            <tbody>";
            while($row = mysqli_fetch_assoc($data)) {
                echo '<tr>';
                echo"<td class='table-cell'>".$index."</td>";
                echo"<td class='table-cell'>".$row["maSinhVien"]."</td>";
                echo"<td class='table-cell'>".$row["khoa"]."</td>";
                echo"<td class='table-cell'>".$row["hoTen"]."</td>";
                echo"<td class='table-cell'>".$row["ngaySinh"]."</td>";
                echo"<td class='table-cell'>".$row["gioiTinh"]."</td>";
                echo '<td class="table-cell"> 
                    <button class="btn btn-light" type="button"><a href="?route=student_point&maSV='.$row['maSinhVien'].'&khoa='.$row['khoa'].'" class="nav-link">
                        Điểm
                    </a></button>
                    </td>';
                echo '</tr>';
                $index++;
            }
            echo "</tbody>";
            echo '</table>';
        }
    }
    ?>
</div>