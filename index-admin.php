<?php
session_start();
ob_start();
require_once './model/connect.php';
require_once './model/function.php';
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Management</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="./assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="./assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="./assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- Font -->
    <link rel="stylesheet" href="./assets/fonts/stylesheet.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="./assets/css/main.css" />

    <script src="./assets/js/main.js"></script>
</head>

<body>
    <!-- Header -->
    <?php require_once './templates/header-admin.php' ?>

    <!-- Main -->
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'profile':
                if ($_SESSION['student']['major_id']) {
                    $major_id = $_SESSION['student']['major_id'];
                    $status_id = $_SESSION['student']['status_id'];
                    $major = getStudentMajor($major_id);
                    $status = getStudentStatus($status_id);
                    if (is_array($major)) {
                        $depart_id = $major['department_id'];
                        $department = getStudentDepartment($depart_id);
                    }
                }
                require_once './profile.php';
                break;
            case 'profile-admin':
                require_once './profile-admin.php';
                break;
            case 'edit-student':
                if (isset($_GET['id'])) {
                    $student_id = $_GET['id'];
                    $student = getStudentInfo($student_id);
                    $major = getStudentMajor($student['major_id']);
                    $status = getStudentStatus($student['status_id']);
                    require_once './edit-student.php';
                } else {
                    echo 'Không tìm thấy thông tin sinh viên!';
                }
                break;
            case 'add-student':
                $allStatus = getAllStatus();
                $allDepartment = getAllDepartment();
                include_once './add-student.php';
                break;
            case 'update-student-major':
                if (!empty($_GET['id']) && !empty($_GET['department_id'])) {
                    $student_id = $_GET['id'];
                    $department_id = $_GET['department_id'];
                    $majors = getAllMajor($department_id);
                    include_once './update-student-major.php';
                } else {
                    echo "Lỗi! Không thể chọn chuyên ngành!";
                }
                break;
            case 'delete-student':
                if (!empty($_GET['id'])) {
                    $student_id = $_GET['id'];
                    $result = deleteStudent($student_id);
                    if ($result) {
                        header('location: ./index.php?page=student-manage');
                    } else {
                        echo "Cannot delete student!";
                    }
                }
                break;
            case 'department-manage':
                $departments = getAllDepartment();
                require_once './department-management.php';
                break;
            case 'add-department':
                require_once './add-department.php';
                break;
            case 'delete-department':
                if (!empty($_GET['depart_id'])) {
                    $depart_id = $_GET['depart_id'];
                    $result = deleteDepartment($depart_id);
                    if ($result) {
                        header('location: ./index.php?page=department-manage');
                    } else {
                        echo 'Cannot delete department!';
                        die();
                    }
                }
                break;
            case 'majors-manage':
                if (!empty($_GET['depart_id'])) {
                    $depart_id = $_GET['depart_id'];
                    $majors = getAllMajor($depart_id);
                    $department = getDepartment($depart_id);
                    require_once 'majors-management.php';
                }
                break;
            case 'del-major':
                if (!empty($_GET['depart_id']) && !empty($_GET['major_id'])) {
                    $depart_id = $_GET['depart_id'];
                    $major_id = $_GET['major_id'];
                    $result = deleteMajor($major_id);
                    if ($result) {
                        header('location: ./index.php?page=majors-manage&depart_id=' . $depart_id);
                    } else {
                        echo 'Cannot delete major!';
                        die();
                    }
                }
                break;
            case 'signout':
                session_destroy();
                header('location: ./sign-in.php');
            default:
                require_once './home.php';
                break;
        }
    }
    ?>

    <!-- Footer -->
    <?php require_once './templates/footer.php' ?>
</body>