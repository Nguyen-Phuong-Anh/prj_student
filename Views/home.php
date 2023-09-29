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
      <li>
        <a href='.?route=home' class='nav-link text-white active'>
          <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 20 20">
            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
          </svg>
          Quản lý tài khoản
        </a>
      </li>
      <li>
        <li class='mb-1'>
            <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#student-collapse' aria-expanded='false'>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-backpack" viewBox="0 0 20 20">
              <path d="M4.04 7.43a4 4 0 0 1 7.92 0 .5.5 0 1 1-.99.14 3 3 0 0 0-5.94 0 .5.5 0 1 1-.99-.14ZM4 9.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-7a.5.5 0 0 1-.5-.5v-4Zm1 .5v3h6v-3h-1v.5a.5.5 0 0 1-1 0V10H5Z"/>
              <path d="M6 2.341V2a2 2 0 1 1 4 0v.341c2.33.824 4 3.047 4 5.659v5.5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5V8a6.002 6.002 0 0 1 4-5.659ZM7 2v.083a6.04 6.04 0 0 1 2 0V2a1 1 0 0 0-2 0Zm1 1a5 5 0 0 0-5 5v5.5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5V8a5 5 0 0 0-5-5Z"/>
            </svg>
              Quản lý sinh viên
            </button>
            <div class='collapse text-white' id='student-collapse'>
            <form method='post' class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='.?route=student_list' class='nav-link text-white rounded'>Danh sách sinh viên</a></li>
                <li><a href='.?route=add_student' class='nav-link text-white rounded'>Thêm sinh viên</a></li>
            </form>
            </div>
        </li>
      </li>
      <li>
        <li class='mb-1'>
            <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#lecturer-collapse' aria-expanded='false'>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 20 20">
              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z"/>
            </svg>
              Quản lý giảng viên
            </button>
            <div class='collapse text-white' id='lecturer-collapse'>
            <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='.?route=lecturer_list' class='nav-link text-white rounded'>Danh sách giảng viên</a></li>
                <li><a href='.?route=add_lecturer' class='nav-link text-white rounded'>Thêm giảng viên</a></li>
            </ul>
            </div>
        </li>
      </li>
      <li>
        <li class='mb-1'>
            <a href='.?route=tuition'>
              <button class='btn btn-toggle text-white align-items-center rounded'>
              <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 20 20">
                <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
              </svg>
                Quản lý học phí
              </button>
            </a>
        </li>
      </li>
      <li>
        <li class='mb-1'>
            <button class='btn btn-toggle text-white align-items-center rounded collapsed' data-bs-toggle='collapse' data-bs-target='#subject-collapse' aria-expanded='false'>
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 20 20">
              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
              Quản lý học phần
            </button>
            <div class='collapse text-white' id='subject-collapse'>
            <ul class='btn-toggle-nav list-unstyled fw-normal pb-1 small'>
                <li><a href='.?route=subject_list' class='nav-link text-white rounded'>Danh sách học phần</a></li>
                <li><a href='.?route=add_subject' class='nav-link text-white rounded'>Thêm học phần</a></li>
            </ul>
            </div>
        </li>
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
        case 'home':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showManageAccount();
          break;
        case 'add_student':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showAddStudent();
          break;
        case 'student_list':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showStudentList();
          break;

        case 'student_info':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showStudentInfo();
          break;
        case 'add_lecturer':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showAddLecturer();
          break;
        case 'lecturer_list':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showLecturerList();
          break;

        case 'lecturer_info':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showLecturerInfo();
          break;

        case 'tuition':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showTuitionList();
          break;
        case 'tuition_info':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showTuitionInfo();
          break;
        case 'subject_list':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showSubjectList();
          break;
        case 'subject_info':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showSubjectInfo();
          break;
        case 'add_subject':
          require_once('./Controllers/AdminController.php');
          $controller = new AdminController();
          $controller->showAddSubject();
          break;
        default:
          
          break;
      }
      ?>
  </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>