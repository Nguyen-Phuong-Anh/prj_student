<div class="mt-4">
    <h1>Chi tiết học phí</h1>
    <table class="table mt-4">
        <?php
            require_once('./Controllers/AdminController.php');
            $controller = new AdminController();
            $data = $controller->handleGetTuition();
            if(isset($data)) {
                $index = 0;
                echo "<thead>
                <tr>
                    <th>#</th>
                    <th>Mã học phần</th>
                    <th>Học phí một tín</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>";
                while($row = mysqli_fetch_assoc($data)) {
                    echo '<tr>';
                    echo"<td class='table-cell'>".$index."</td>";
                    echo"<td class='table-cell'>".$row["maHocPhan"]."</td>";
                    echo"<td class='table-cell'>".$row["hocPhiMotTin"]."</td>";
                    echo"<td class='table-cell'>".$row["thanhTien"]."</td>";
                    echo '</tr>';
                    $index++;
                }
                echo "</tbody>";
            }
        ?>
    </table>
</div>