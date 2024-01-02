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
    <script src="./assets/js/validator.js"></script>
</head>

<body>
    <!-- Header -->
    <?php require_once './templates/header.php' ?>

    <!-- Main -->
    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'profile':
                if (!empty($_SESSION['student'])) {
                    if (!empty($_SESSION['student'])) {
                        $major_id = $_SESSION['student']['major_id'];
                        $status_id = $_SESSION['student']['status_id'];
                        $depart_id = $_SESSION['student']['department_id'];
                        $class_id = $_SESSION['student']['class_id'];
                        $class = !empty($class_id) ? getStudentClass($class_id) : false;
                        $major = !empty($major_id) ? getStudentMajor($major_id) : false;
                        $status = !empty($status_id) ? getStudentStatus($status_id) : false;
                        $department = !empty($depart_id) ? getStudentDepartment($depart_id) : false;
                        require_once './profile.php';
                    }
                } else {
                    header('location: ./sign-in.php');
                }
                break;
            case 'profile-admin':
                require_once './profile-admin.php';
                break;
            case 'student-manage':
                $student_per_page = 5;
                $current_page = !empty($_GET['page_num']) ? $_GET['page_num'] : 1;
                $offset = ($current_page - 1) * $student_per_page;
                $totalRecords = getNumRow("SELECT student_id FROM student");
                $totalPages = ceil($totalRecords / $student_per_page);
                $query = "SELECT * FROM student LIMIT $student_per_page OFFSET $offset";
                $students = getAllStudent($query);
                require_once './student-management.php';
                break;
            case 'edit-student':
                if (isset($_GET['id'])) {
                    $student_id = $_GET['id'];
                    $student = getStudentInfo($student_id);
                    $depart_id = $student['department_id'];
                    $major_id = $student['major_id'];
                    $status_id = $student['status_id'];
                    $class_id = $student['class_id'];
                    $studentClass = !empty($class_id) ? getStudentClass($class_id) : false;
                    $major = !empty($major_id) ? getStudentMajor($major_id) : false;
                    $status = !empty($status_id) ? getStudentStatus($status_id) : false;
                    require_once './edit-student.php';
                } else {
                    echo 'Cannot find student!';
                    die();
                }
                break;
            case 'add-student':
                $allStatus = getAllStatus();
                $allDepartment = getAllDepartment();
                $allClass = getAllClass();
                include_once './add-student.php';
                break;
            case 'update-student-major':
                if (!empty($_GET['id'])) {
                    $student_id = $_GET['id'];
                    $student = getStudentInfo($student_id);
                    if ($student) {
                        extract($student);
                        $majors = getAllMajor($department_id);
                        include_once './update-student-major.php';
                    } else {
                        echo "Cannot find major!";
                        die();
                    }
                } else {
                    echo "Cannot find major!";
                    die();
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
                $query = "SELECT * FROM departments";
                $departments = getDepartmentsByParam($query);
                require_once './department-management.php';
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
                    $query = "SELECT * FROM majors WHERE department_id = $depart_id";
                    $majors = getMajorsByParam($query);
                    $department = getDepartment($depart_id);
                    require_once 'majors-management.php';
                } else {
                    header('location: ./index.php');
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
            case 'status-manage':
                $query = "SELECT * FROM student_status";
                $allStatus = getStatusByParam($query);
                require_once './status-manage.php';
                break;
            case 'delete-status':
                if (!empty($_GET['status_id'])) {
                    $status_id = $_GET['status_id'];
                    $result = deleteStatus($status_id);
                    if ($result) {
                        header('location: ./index.php?page=status-manage');
                    } else {
                        echo 'Cannot delete status!';
                        die();
                    }
                }
                break;
            case 'change-password':
                require_once './change-password.php';
                break;
            case 'list-subject':
                if (!empty($_SESSION['student']) || !empty($_SESSION['admin'])) {
                    require_once './list_subject.php';
                } else {
                    header('location: sign-in.php');
                }
                break;
            case 'edit-subject':
                require_once './edit.php';
                break;
            case 'list-registered':
                if (!empty($_SESSION['student'])) {
                    require_once './list_registered_subject.php';
                } else {
                    header('location: sign-in.php');
                }
                break;
            case 'signout':
                session_destroy();
                header('location: ./sign-in.php');
            default:
                require_once './home.php';
                break;
        }
    } else {
        require_once './home.php';
    }
    ?>

    <!-- Footer -->
    <?php require_once './templates/footer.php' ?>
</body>