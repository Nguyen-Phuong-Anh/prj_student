<?php
    session_start();
    if(!$_SESSION['username']) {
        header('Location: ./');
    }

    $requestUri = $_SERVER['REQUEST_URI'];
    $questionMarkPosition = strpos($requestUri, '=');

    if ($questionMarkPosition !== false) {
        $route = substr($requestUri, $questionMarkPosition + 1);
    } else {
        $route = $requestUri;
    }
    // echo $questionMarkPosition;
    // cmt 
    // lfakjsdf
;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .homeBody {
            display: flex;
            height: 100vh;
        }
    </style>
</head>
<body class="homeBody">
  <div class='d-flex flex-column flex-shrink-0 p-3 text-white bg-dark' style='width: 280px;'>
    <a href='.?route=home' class='d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none'>
      <span class='fs-4'>UTT</span>
    </a>
    <hr>
    <ul class='nav nav-pills flex-column mb-auto'>
    <?php 
      if($_SESSION['role'] == 102) {
        echo "
        <li class='nav-item'>
          <a href='#' class='nav-link active' aria-current='page'>
            Trang chủ
          </a>
        </li>";
        echo "<li>
        <li class='mb-1'>
            <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#student-collapse' aria-expanded='false'>
            Quản lý sinh viên
            </button>
            <div class='collapse text-white' id='student-collapse'>
            <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='#' class='nav-link text-white rounded'>Thông tin SV</a></li>
                <li><a href='#' class='nav-link text-white rounded'>Điểm</a></li>
            </ul>
            </div>
        </li>
        </li>";
      } else if ($_SESSION['role'] == 103) {
        echo "<ul class='nav nav-pills flex-column mb-auto'>
        <li class='nav-item'>
          <a href='#' class='nav-link active' aria-current='page'>
            Trang chủ
          </a>
        </li>";
        echo "<li>
        <a href='#' class='nav-link text-white'>
          <svg class='bi me-2' width='16' height='16'><use xlink:href='#people-circle'></use></svg>
          Quản lý điểm
        </a>
        </li>";
        echo "<li>
        <a href='#' class='nav-link text-white'>
          <svg class='bi me-2' width='16' height='16'><use xlink:href='#people-circle'></use></svg>
          Quản lý học phí
        </a>
        </li>";
        echo "<li>
        <li class='mb-1'>
            <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#subject-collapse' aria-expanded='false'>
            Quản lý học phần
            </button>
            <div class='collapse text-white' id='subject-collapse'>
            <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='#' class='nav-link text-white rounded'>Danh sách học phần</a></li>
                <li><a href='#' class='nav-link text-white rounded'>Đăng ký học phần</a></li>
            </ul>
            </div>
        </li>
        </li>";
      } else if($_SESSION['role'] == 101) {
        echo "<li>
        <a href='.?route=home' class='nav-link text-white active'>
          Quản lý tài khoản
        </a>
        </li>";
        echo "<li>
        <li class='mb-1'>
            <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#student-collapse' aria-expanded='false'>
            Quản lý sinh viên
            </button>
            <div class='collapse text-white' id='student-collapse'>
            <form method='post' class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='#' class='nav-link text-white rounded'>Danh sách sinh viên</a></li>
                <li><a href='.?route=add_student' class='nav-link text-white rounded'>Thêm sinh viên</a></li>
            </form>
            </div>
        </li>
        </li>";
        echo "<li>
        <li class='mb-1'>
            <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#lecturer-collapse' aria-expanded='false'>
            Quản lý giảng viên
            </button>
            <div class='collapse text-white' id='lecturer-collapse'>
            <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='#' class='nav-link text-white rounded'>Danh sách giảng viên</a></li>
                <li><a href='#' class='nav-link text-white rounded'>Thêm giảng viên</a></li>
            </ul>
            </div>
        </li>
        </li>";
        echo "<li>
        <li class='mb-1'>
            <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#tuition-collapse' aria-expanded='false'>
            Quản lý học phí
            </button>
            <div class='collapse text-white' id='tuition-collapse'>
            <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='#' class='nav-link text-white rounded'>Danh sách học phí</a></li>
                <li><a href='#' class='nav-link text-white rounded'>Thêm học phí</a></li>
            </ul>
            </div>
        </li>
        </li>";
        echo "<li>
        <li class='mb-1'>
            <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#subject-collapse' aria-expanded='false'>
            Quản lý học phần
            </button>
            <div class='collapse text-white' id='subject-collapse'>
            <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='#' class='nav-link text-white rounded'>Danh sách học phần</a></li>
                <li><a href='#' class='nav-link text-white rounded'>Thêm học phần</a></li>
            </ul>
            </div>
        </li>
        </li>";
      }
    ?>
    </ul>
    <hr>
    <div>
        <a href='.?route=logout' class='nav-link text-white'>
          <svg class='bi me-2' width='16' height='16'><use xlink:href='#people-circle'></use></svg>
          Đăng xuất
        </a>
      </div>
  </div>

  <div>
      <?php
        if($route == 'home') {
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showManageStudent();
        }
      ?>
  </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>