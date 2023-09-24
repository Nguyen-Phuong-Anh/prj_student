

<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">MENU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown" data-bs-target>
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="user.php">Home</a>
                </li>
                <?php 
                    if($_SESSION['role'] == 102 || $_SESSION['role'] == 103) {
                        echo `<li class="nav-item">
                        <a href="create.php" class="nav-link">Thông tin cá nhân</a>
                        </li>`;
                    }
                ?>
                <li class="nav-item">
                    <a href="create.php" class="nav-link">
                    <?php 
                        if($_SESSION['role'] == 102 || $_SESSION['role'] == 103) {
                            echo `Thông tin cá nhân`;
                        } else {
                            echo `Quản lý tài khoản`;
                        }
                    ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Quản lý điểm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Quản lý học phí</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">Quản lý học phần</a>
                </li>
                </ul>
            </div>
        </nav>
</header>