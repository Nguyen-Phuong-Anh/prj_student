<style>
    .insideBody {
        height: 100%;
        width: 80%;
        padding-right: 20px;
    }
</style>

<div class="insideBody mt-4">
    <div>
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
            <button type="submit" name="search_point" class="btn btn-primary mt-4">Tìm kiếm</button>
        </form>
    </div>
    
    <div class="mt-4">
        <table class="table mt-4">
            <?php
                if(isset($_POST['search_point'])) {
                    require_once('./Controllers/LecturerController.php');
                    $controller = new LecturerController();
                    $data = $controller->handleGetPoint();
                    if(isset($data[0])) $maBD = $data[0];
                    if(isset($data)) {
                        $index = 0;
                        echo '<h3>Bảng điểm</h3>';
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
                            <th colspan='2'></th>
                        </tr>
                        </thead>
                        <tbody>";
                        while($row = mysqli_fetch_assoc($data[1])) {
                            echo '<tr>';
                            echo"<td class='table-cell'>".$index."</td>";
                            echo"<td class='table-cell'>".$row["maHocPhan"]."</td>";
                            echo"<td class='table-cell'>".$row["diemCC"]."</td>";
                            echo"<td class='table-cell'>".$row["diemTH"]."</td>";
                            echo"<td class='table-cell'>".$row["diemTL"]."</td>";
                            echo"<td class='table-cell'>".$row["diemKetThuc"]."</td>";
                            echo"<td class='table-cell'>".$row["diemTongKet"]."</td>";
                            echo"<td class='table-cell'>".$row["diemChu"]."</td>";
                            if($row["diemTongKet"] === 0 || !$row["diemChu"]) {
                                echo '<td class="table-cell">
                                    <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#pointModal'.$row['maHocPhan'].'">Chi tiết</button>
                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deletePointModal'.$row['maHocPhan'].'">Xóa</button>
                                    </td>'
                                    ;
                            }
                            echo '</tr>';
                            $index++;
                            if($row["diemTongKet"] === 0 || !$row["diemChu"]) {
                                echo
                                '<div class="modal fade" id="pointModal'.$row['maHocPhan'].'" tabindex="-1" aria-labelledby="userModal'.$row['maHocPhan'].'" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Chỉnh sửa điểm</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" value="'.$maBD.'" name="maBD" >
                                                    <label class="pb-2" for="maHocPhan">Mã học phần</label>
                                                    <input type="text" class="form-control w-50" name="maHocPhan" readonly value="'.$row["maHocPhan"].'">
                                                    <label class="pb-2" for="diemCC">Điểm chuyên cần</label>
                                                    <input type="number" class="form-control w-50" name="diemCC" value="'.$row["diemCC"].'">
                                                    <label class="pb-2" for="diemTH">Điểm thực hành</label>
                                                    <input type="number" class="form-control w-50" name="diemTH" value="'.$row["diemTH"].'">
                                                    <label class="pb-2" for="diemTL">Điểm thảo luận</label>
                                                    <input type="number" class="form-control w-50" name="diemTL" value="'.$row["diemTL"].'">
                                                    <label class="pb-2" for="diemKetThuc">Điểm kết thúc</label>
                                                    <input type="number" class="form-control w-50" name="diemKetThuc" value="'.$row["diemKetThuc"].'">
                                                    <label class="pb-2" for="diemTongKet">Điểm tổng kết</label>
                                                    <input type="number" class="form-control w-50" name="diemTongKet" readonly value="'.$row["diemTongKet"].'">
                                                    <label class="pb-2" for="diemChu">Điểm chữ</label>
                                                    <input type="text" class="form-control w-50" name="diemChu" readonly value="'.$row["diemChu"].'">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="save_change" class="btn btn-primary">Lưu</button>
                                                    <button type="submit" name="calculate_point" class="btn btn-primary">Tính điểm TK</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>';
                                echo '
                                <div class="modal fade" id="deletePointModal'.$row['maHocPhan'].'" tabindex="-1" aria-labelledby="deletePointModal'.$row['maHocPhan'].'" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deletePointModal'.$row['maHocPhan'].'">Delete Confirm</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                Do you want to delete this student point?
                                                <input type="hidden" value="'.$row["maBangDiem"].'" name="maBD_delete" >
                                                <input type="hidden" value="'.$row["maHocPhan"].'" name="maHP_delete" >
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                <button class="btn btn-danger" type="submit" name="delete_point" >Xóa</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                                ';
                            }
                        }
                        echo "</tbody>";
                    }
                }
            ?>
        </table>
    </div>
</div>

<?php
    if(isset($_POST['save_change'])) {
        require_once('./Controllers/LecturerController.php');
        $controller = new LecturerController();
        $controller->handleChangePoint();
    } else if(isset($_POST['calculate_point'])) {
        require_once('./Controllers/LecturerController.php');
        $controller = new LecturerController();
        $controller->handleUpdatePoint();
    } else if(isset($_POST['delete_point'])) {
        require_once('./Controllers/LecturerController.php');
        $controller = new LecturerController();
        $controller->handleDeletePoint();
    }
?>