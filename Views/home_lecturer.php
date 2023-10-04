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
<<<<<<< HEAD

=======
>>>>>>> 7d7b2240323f1260faaa1dca9b86c1434fbeb950
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Giảng viên</title>
</head>
<body>
    
</body>
</html>
=======
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
          <a href='.?route=profile_lecturer' class='nav-link active' aria-current='page'>
            Thông tin giảng viên
          </a>
        <li class='nav-item'>
          <a href='.?route=profile_student' class='nav-link active' aria-current='page'>
            Thông tin sinh viên
          </a>
        </li>
  </div>

  <div class="w-50 me-auto ms-auto">
    <?php
        switch ($route) {
          case 'home_lecturer':
            require_once('./Controllers/lecturerController.php');
            $controller = new lecturerController();
            $controller->showHomeLecturer();
            break;
        }
        switch ($route) {
          case 'profile_lecturer':
            require_once('./Controllers/lecturerController.php');
            $controller = new lecturerController();
            $controller->showProfileLecturer();
            break;
        }
      
    ?>
    
  </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
>>>>>>> 7d7b2240323f1260faaa1dca9b86c1434fbeb950
