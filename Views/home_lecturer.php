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
    <title>Giảng viên</title>
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
    <a href='.?route=home_lecturer' class='d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none'>
      <span class='fs-4'>UTT</span>
    </a>
    <hr>
    <ul class='nav nav-pills flex-column mb-auto'>
        <li class='nav-item'>
          <a href='.?route=home_lecturer' class='nav-link active' aria-current='page'>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 20 20">
              <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
            </svg>
            Trang chủ
          </a>
        </li>
        <li class='mb-1'>
          <a href='.?route=getStudent_info' class='nav-link text-white round' aria-current='page'>
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 20 20">
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
              </svg>
              Sinh viên
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
          case 'home_lecturer':
            require_once('./Controllers/LecturerController.php');
            $controller = new LecturerController();
            $controller->showLecturerProfile();
            break;
          
          case 'getStudent_info':
            require_once('./Controllers/LecturerController.php');
            $controller = new LecturerController();
            $controller->showStudentSearch();
            break;
            
          case 'student_point':
            require_once('./Controllers/LecturerController.php');
            $controller = new LecturerController();
            $controller->showStudentPoint();
            break;
        }
    ?>
    
  </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
