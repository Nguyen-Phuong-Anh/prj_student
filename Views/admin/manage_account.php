<div class="ms-5 mt-5 me-5">
    <div class='mb-1'>
        <button class='nav_btn btn-toggle text-black align-items-center collapsed' data-bs-toggle='collapse' data-bs-target='#search_account-collapse' aria-expanded='true'> <i class="bi bi-caret-down-fill"></i>
        Tìm kiếm tài khoản
        </button>
        <div class='collapse show text-black mt-3 ms-3' id='search_account-collapse'>
            <form class="input-group mb-3" action="" method="post">
                <div class="me-3"><input name="search" type="text" class="form-control" placeholder="Search..."></div>
                <div class="input-group-append">
                    <button name="submit_search" class="btn btn-primary" type="submit">Search</button> //tim kiem tai khoan
                </div>
            </form>
            <table class="table mt-4">
                <?php
                    if(isset($_POST['submit_search'])) { //tim kiem tai khoan
                        if(!empty($_POST['search'])) {
                            require_once('./Controllers/AdminController.php'); //mvc -> controller (logic) -> model (tuogn tac db)
                            $controller = new AdminController(); //tao doi tuong controller
                            $data = $controller->handleSearchAccount(); //goi den phuong thuc 
                            if(isset($data)) {
                                $index = 0;
                                echo "<thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên tài khoản</th>
                                    <th>Mã vai trò</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>";
                                while($row = mysqli_fetch_assoc($data)) { 
                                    echo '<tr>';
                                    echo"<td class='ta  ble-cell'>".$index."</td>";
                                    echo"<td class='table-cell'>".$row["tenTaiKhoan"]."</td>";
                                    echo"<td class='table-cell'>".$row["maVaiTro"]."</td>";
                                    echo '<td class="table-cell"> 
                                    <button class="btn btn-light" type="button" data-bs-toggle="modal" data-bs-target="#userModal'.$row['tenTaiKhoan'].'">Sửa</button>
                                    <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#deleteUserModal'.$row['tenTaiKhoan'].'">Xóa</button>
                                    </td>';
                                    echo '</tr>';
                                    echo 
                                    '<div class="modal fade" id="userModal'.$row['tenTaiKhoan'].'" tabindex="-1" aria-labelledby="userModal'.$row['tenTaiKhoan'].'" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="" method="post">
                                                    <div class="modal-body">
                                                        <label class="pb-2" for="username">Tên tài khoản</label>
                                                        <input type="text" class="form-control w-50" name="username" readonly value="'.$row["tenTaiKhoan"].'">
                                                        <label class="pb-2" for="password">Mật khẩu</label>
                                                        <input type="password" class="form-control w-50" name="password" value="'.$row["tenTaiKhoan"].'">
                                                        <label class="pb-2" for="role">Mã vai trò</label>
                                                        <input type="text" class="form-control w-50" name="role" value="'.$row["maVaiTro"].'">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" name="save_change" class="btn btn-primary">Lưu thay đổi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>';
                                    echo '
                                    <div class="modal fade" id="deleteUserModal'.$row['tenTaiKhoan'].'" tabindex="-1" aria-labelledby="deleteUserModal'.$row['tenTaiKhoan'].'" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteUserModal'.$row['tenTaiKhoan'].'">Delete Confirm</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    Do you want to delete this account?
                                                    <input type="hidden" value="'.$row["tenTaiKhoan"].'" name="tenTK" >
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button class="btn btn-danger" type="submit" name="delete_account" >Xóa</button>
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
                    }
                ?>
            </table>
        </div>
    </div>

    <div class='mb-1'>
        <button class='nav_btn btn-toggle text-black align-items-center collapsed' data-bs-toggle='collapse' data-bs-target='#add_account-collapse' aria-expanded='true'> <i class="bi bi-caret-down-fill"></i>
        Thêm tài khoản
        </button>
        <div class='collapse text-black mt-3 ms-3' id='add_account-collapse'>
            <form action="" method="post">
                <div class="form-group ">
                    <label class="pb-2" for="username">Tên tài khoản</label>
                    <input type="text" class="form-control w-50" name="username" placeholder="Tên tài khoản">
                </div>
                <div class="form-group mt-4">
                    <label class="pb-2" for="password">Mật khẩu</label>
                    <input type="password" class="form-control w-50" name="password" placeholder="Mật khẩu">
                </div>
                <div class="form-group ">
                    <label class="pb-2" for="role">Mã vai trò</label>
                    <input type="text" class="form-control w-50" name="role" placeholder="Mã vai trò">
                </div>
                <div class="form-group mt-4">
                    <button name="submit_add" type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['submit_add'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleAddAccount();
    } else if(isset($_POST['save_change'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleChangeAccount();
    } else if(isset($_POST['delete_account'])) {
        require_once('./Controllers/AdminController.php');
        $controller = new AdminController();
        $controller->handleDeleteAccount();
    }
?>  