<?php
    session_start();
    if(!$_SESSION['username']) {
        header('Location: ./');
    }
    $requestUri = $_SERVER['REQUEST_URI'];
    $questionMarkPosition = strpos($requestUri, '=');

    if ($questionMarkPosition !== false) {
      if (strpos($requestUri, '&') !== false) {
        $parts = explode('&', $requestUri);
        $route = substr($parts[0], strpos($parts[0], '=') + 1);
      } else {
        $route = substr($requestUri, $questionMarkPosition + 1);
      }
    } else {
      $route = $requestUri;
    }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .homeBody {
            display: flex;
            height: 100vh;
        }

        .nav_btn {
          outline: none;
          border: none;
          background-color: white;
        }

        img {
          width: 150px;
          height: 150px;
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
        <li class='nav-item'>
          <a href='.?route=profile_student' class='nav-link active' aria-current='page'>
            Thông tin sinh viên
          </a>
        <li class='nav-item'>
          <a href='.?route=subject_student' class='nav-link active' aria-current='page'>
            Đăng kí học phần
          </a>
        </li>
        <li class='nav-item'>
          <a href='.?route=point_student' class='nav-link active' aria-current='page'>
            Điểm
          </a>
        </li>
        <li class='nav-item'>
          <a href='.?route=tuition_student' class='nav-link active' aria-current='page'>
            học phí
          </a>
        </li>   
    </ul>
    <hr>
    <div>
        <a href='.?route=logout' class='nav-link text-white'>
          <svg class='bi me-2' width='16' height='16'><use xlink:href='#people-circle'></use></svg>
          Đăng xuất
        </a>
      </div>
  </div>

  <div class="w-50 me-auto ms-auto">
    <?php
        switch ($route) {
          case 'profile_student':
            require_once('./Controllers/StudentContriller.php');
            $controller = new studentController();
            $controller->showProfile_student();
            break;
        }
        switch ($route) {
          case 'point_student':
            require_once('./Controllers/StudentContriller.php');
            $controller = new studentController();
            $controller->showPoint_student();
            break;
        }
        switch ($route) {
          case 'tuition_student':
            require_once('./Controllers/StudentContriller.php');
            $controller = new studentController();
            $controller->showTuition_student();
            break;
        }
        switch ($route) {
          case 'subject_student':
            require_once('./Controllers/StudentContriller.php');
            $controller = new studentController();
            $controller->showsubject_student();
            break;
        }
    ?>
    
  </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>