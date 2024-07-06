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
    <title>Sinh viên</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        .homeBody {
            display: flex;
            height: 100vh;
        }

        .body2 {
          margin-left: 100px;
          width: 100%;
          padding: 0 30px;
          overflow-y: auto;
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
    <a href='.?route=home_student' class='d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none'>
      <span class='fs-4'>UTT</span>
    </a>
    <hr>
    <ul class='nav nav-pills flex-column mb-auto'>
        <li class='mb-1'>
          <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#student-collapse' aria-expanded='false'>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 20 20">
              <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
            </svg>
            Trang chủ
          </button>
          <div class='collapse text-white' id='student-collapse'>
            <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='.?route=home_student' class='nav-link text-white rounded'>Thông tin SV</a></li>
                <li><a href='.?route=pwd_student' class='nav-link text-white rounded'>Đổi mật khẩu</a></li>
            </ul>
          </div>
        </li>
        <li class='mb-1'>
          <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#sbj-collapse' aria-expanded='false'>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-vector-pen" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10.646.646a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1 0 .708l-1.902 1.902-.829 3.313a1.5 1.5 0 0 1-1.024 1.073L1.254 14.746 4.358 4.4A1.5 1.5 0 0 1 5.43 3.377l3.313-.828L10.646.646zm-1.8 2.908-3.173.793a.5.5 0 0 0-.358.342l-2.57 8.565 8.567-2.57a.5.5 0 0 0 .34-.357l.794-3.174-3.6-3.6z"/>
              <path fill-rule="evenodd" d="M2.832 13.228 8 9a1 1 0 1 0-1-1l-4.228 5.168-.026.086.086-.026z"/>
            </svg>
            Đăng kí học phần
          </button>
          <div class='collapse text-white' id='sbj-collapse'>
            <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='.?route=getStudent_sbj' class='nav-link text-white rounded'>Học phần đã đăng ký</a></li>
                <li><a href='.?route=regist_subject' class='nav-link text-white rounded'>Đăng ký</a></li>
            </ul>
          </div>
        </li>
        <li class='nav-item'>
          <a href='.?route=point_student' class='nav-link text-white rounded' aria-current='page'>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-backpack4" viewBox="0 0 20 20">
              <path d="M4 9.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-4Zm1 .5v3h6v-3h-1v.5a.5.5 0 0 1-1 0V10H5Z"/>
              <path d="M8 0a2 2 0 0 0-2 2H3.5a2 2 0 0 0-2 2v1c0 .52.198.993.523 1.349A.5.5 0 0 0 2 6.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6.5a.5.5 0 0 0-.023-.151c.325-.356.523-.83.523-1.349V4a2 2 0 0 0-2-2H10a2 2 0 0 0-2-2Zm0 1a1 1 0 0 0-1 1h2a1 1 0 0 0-1-1ZM3 14V6.937c.16.041.327.063.5.063h4v.5a.5.5 0 0 0 1 0V7h4c.173 0 .34-.022.5-.063V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm9.5-11a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1h-9a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h9Z"/>
            </svg>  
          Điểm
          </a>
        </li>
        <li class='nav-item'>
          <a href='.?route=tuition_student' class='nav-link text-white rounded' aria-current='page'>
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-wallet-fill" viewBox="0 0 20 20">
            <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v2h6a.5.5 0 0 1 .5.5c0 .253.08.644.306.958.207.288.557.542 1.194.542.637 0 .987-.254 1.194-.542.226-.314.306-.705.306-.958a.5.5 0 0 1 .5-.5h6v-2A1.5 1.5 0 0 0 14.5 2h-13z"/>
            <path d="M16 6.5h-5.551a2.678 2.678 0 0 1-.443 1.042C9.613 8.088 8.963 8.5 8 8.5c-.963 0-1.613-.412-2.006-.958A2.679 2.679 0 0 1 5.551 6.5H0v6A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-6z"/>
          </svg>  
            Học phí
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

  <div class="body2">
    <?php
        switch ($route) {
          case 'home_student':
            require_once('./Controllers/StudentController.php');
            $controller = new StudentController();
            $controller->showProfileStudent();
            break;
          
          case 'pwd_student':
          require_once('./Controllers/StudentController.php');
          $controller = new StudentController();
          $controller->showChangePwdStudent();
          break;

          case 'point_student':
            require_once('./Controllers/StudentController.php');
            $controller = new StudentController();
            $controller->showPointStudent();
            break;
        
          case 'tuition_student':
            require_once('./Controllers/StudentController.php');
            $controller = new StudentController();
            $controller->showTuitionStudent();
            break;

          case 'regist_subject':
            require_once('./Controllers/StudentController.php');
            $controller = new StudentController();
            $controller->showRegisterSubject();
            break;

          case 'getStudent_sbj':
            require_once('./Controllers/StudentController.php');
            $controller = new StudentController();
            $controller->showStudentSubject();
            break;
        }
    ?>
    
  </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>