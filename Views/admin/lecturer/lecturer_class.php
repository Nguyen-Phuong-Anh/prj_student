<style>
    .insideBody {
        height: 100%;
        width: 80%;
        padding-right: 20px;
    }
</style>

<div class="insideBody mt-3">
    <h2>Phân công giảng dạy</h2>
    <form class="mt-4" action="" method="post">
        <label class="pb-2" for="subject_selector">Học phần</label>
        <select name="subject_selector" class="form-select" aria-label="Subject select">
            <?php
                require_once('./Controllers/AdminController.php');
                $controller = new AdminController();
                $data = $controller->handleSearchSubject_Class();
                if(isset($data)) {
                    while($row = mysqli_fetch_assoc($data)) {
                        echo '<option value="'.$row['maHocPhan'].'">'.$row['tenMonHoc'].'</option>';
                    }
                }
            ?>
        </select>
        <div class="form-group mt-3 mb-4">
            <button name="search_class" type="submit" class="btn btn-primary">Tìm kiếm lớp</button>
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
                        <th>Thời gian</th> 
                        <th>Địa điểm</th> 
                        <th></th> 
                    </tr>
                    </thead>
                    <tbody>";
                    while($row = mysqli_fetch_assoc($data)) {
                        echo '<tr>';
                        echo"<td class='table-cell'>".$index."</td>";
                        echo"<td class='table-cell'>".$row["maLop"]."</td>";
                        echo"<td class='table-cell'>".$row["siSo"]."</td>";
                        echo"<td class='table-cell'>".$row["siSoToiDa"]."</td>";
                        echo"<td class='table-cell'>".$row["thoiGian"]."</td>";
                        echo"<td class='table-cell'>".$row["diaDiem"]."</td>";
                        echo '<td class="table-cell"> 
                            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal'.$row['maLop'].'">Phân công</button>
                            </td>';
                        echo '</tr>';
                        echo '
                        <div class="modal fade" id="confirmModal'.$row['maLop'].'" tabindex="-1" aria-labelledby="confirmModal'.$row['maLop'].'" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="confirmModal'.$row['maLop'].'">Assign Confirm</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                                <form action="" method="post">
                                    <div class="modal-body">
                                        Do you want to assign this class for this teacher?
                                        <input type="hidden" value="'.$row["maLop"].'" name="maLop_add" >
                                        <input type="hidden" value="'.$row["maHocPhan"].'" name="maHocPhan_add" >
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" type="submit" name="addLecturer_class" >Assign</button>
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
    if(isset($_POST['addLecturer_class'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleAddLecturerClass();
    }
?>