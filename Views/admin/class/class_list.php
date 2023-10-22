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
    <h2 class="mt-4">Danh sách lớp</h2> 
    <div>
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
    </div>

    <form class="mt-4" action="" method="post">
        <label class="pb-2" for="subject_selector">Danh sách học phần</label>
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
        <div class="form-group mt-3 mb-4">
            <button name="search_class" type="submit" class="btn btn-primary">Tìm kiếm lớp học phần</button>
        </div>
    </form>

    <table class="table mt-4">
        <?php
            if(isset($_POST['search_class'])) {
                require_once('./Controllers/AdminController.php');
                $controller = new AdminController();
                $data = $controller->handleSearchClass();
                if(isset($data)) {
                    $index = 0;
                    echo "<h1>Lớp học</h1>";
                    echo "<thead>
                    <tr>
                        <th>#</th>
                        <th>Tên lớp</th>
                        <th>Sĩ số</th>
                        <th>Sĩ số tối đa</th> 
                        <th colspan='2'></th>
                    </tr>
                    </thead>
                    <tbody>";
                    while($row = mysqli_fetch_assoc($data)) {
                        echo '<tr>';
                        echo"<td class='table-cell'>".$index."</td>";
                        echo"<td class='table-cell'>".$row["tenLop"]."</td>";
                        echo"<td class='table-cell'>".$row["siSo"]."</td>";
                        echo"<td class='table-cell'>".$row["siSoToiDa"]."</td>";
                        echo '<td class="table-cell"> 
                            <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#classModal'.$row['maLop'].'">Chi tiết</button>
                            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteClassModal'.$row['maLop'].'">Xóa</button>
                            </td>';
                        echo '</tr>';
                        echo 
                        '<div class="modal fade" id="classModal'.$row['maLop'].'" tabindex="-1" aria-labelledby="classModal'.$row['maLop'].'" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="classModal'.$row['maLop'].'">Thông tin lớp học</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <label class="pb-2" for="maLop">Mã lớp</label>
                                            <input type="text" class="form-control w-50" name="maLop" readonly value="'.$row["maLop"].'">
                                            <label class="pb-2" for="tenLop">Tên lớp</label>
                                            <input type="text" class="form-control w-50" name="tenLop" value="'.$row["tenLop"].'">
                                            <label class="pb-2" for="siSo">Sĩ số</label>
                                            <input type="text" readonly class="form-control w-50" name="siSo" value="'.$row["siSo"].'">
                                            <label class="pb-2" for="siSoToiDa">Sĩ số tối đa</label>
                                            <input type="number" class="form-control w-50" name="siSoToiDa" value="'.$row["siSoToiDa"].'">
                                            <label class="pb-2" for="maGV">Mã giảng viên</label>
                                            <input type="text" class="form-control w-50" name="maGV" value="'.$row["maGV"].'">
                                            <label class="pb-2" for="thoiGian" placeholder="VD: Sáng: 6h-11h">Thời gian</label>
                                            <input type="text" class="form-control w-50" name="thoiGian" value="'.$row["thoiGian"].'">
                                            <label class="pb-2" for="diaDiem">Địa điểm</label>
                                            <input type="text" class="form-control w-50" name="diaDiem" value="'.$row["diaDiem"].'" placeholder="Tòa nhà C2">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                            <button type="submit" name="save_class" class="btn btn-primary">Lưu thay đổi</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>';
                        echo '
                        <div class="modal fade" id="deleteClassModal'.$row['maLop'].'" tabindex="-1" aria-labelledby="deleteClassModal'.$row['maLop'].'" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteClassModal'.$row['maLop'].'">Delete Confirm</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        Do you want to delete this class?
                                        <input type="hidden" value="'.$row["maLop"].'" name="maLop_delete" >
                                        <input type="hidden" value="'.$row["maHocPhan"].'" name="maHocPhan_delete" >
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-danger" type="submit" name="delete_class" >Xóa</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                        ';
                        $index++;
                    }
                    echo "</tbody>";
                }
            }
        ?>
    </table>
</div>

<?php
    if(isset($_POST['save_class'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleUpdateClass();
    } else if(isset($_POST['delete_class'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleDeleteClass();
    }
?>