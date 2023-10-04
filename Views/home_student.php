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
        <li class='nav-item'>
          <a href='.?route=home_student' class='nav-link active' aria-current='page'>
            Trang chủ
          </a>
        <li class='mb-1'>
          <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#lecturer-collapse' aria-expanded='false'>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 20 20">
              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z"/>
            </svg>
            Đăng kí học phần
          </button>
          <div class='collapse text-white' id='lecturer-collapse'>
            <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='.?route=registed_sbj' class='nav-link text-white rounded'>Học phần đã đăng ký</a></li>
                <li><a href='.?route=regist_subject' class='nav-link text-white rounded'>Đăng ký</a></li>
            </ul>
          </div>
        </li>
        <li class='nav-item'>
          <a href='.?route=point_student' class='nav-link text-white rounded' aria-current='page'>
            Điểm
          </a>
        </li>
        <li class='nav-item'>
          <a href='.?route=tuition_student' class='nav-link text-white rounded' aria-current='page'>
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

  <div class="w-50 me-auto ms-auto">
    <?php
        switch ($route) {
          case 'home_student':
            require_once('./Controllers/StudentController.php');
            $controller = new StudentController();
            $controller->showProfileStudent();
            break;
          case 'point_student':
            require_once('./Controllers/StudentController.php');
            $controller = new StudentController();
            $controller->showPointStudent();
            break;
        }
    ?>
    
  </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>