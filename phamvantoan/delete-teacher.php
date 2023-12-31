<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý giáo viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/teacher.css">
    <!-- Font -->
    <link rel="stylesheet" href="../assets/fonts/stylesheet.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>
<body>
<?php
    require_once '../templates/header-admin.php'; 
    require '../model/function_teacher.php';
    $teachers = getAllTeacher();
?>
    <div class="container">
<?php 
    for($i = 0; $i < $teachers->num_rows; $i++){
        $row = $teachers->fetch_assoc();
        $teacherName = $row["teacher_name"];
        $teacherID = $row["teacher_id"];
?>
        <form class="d-flex" method="post" action="" style="margin-top: 40px">
            <input  type="text" value="<?= $teacherID?>" name="teacherID" readonly/>
            <input  type="text" value="<?= $teacherName?>" name="teacherName" readonly/>
            <button class="btn btn-warning" type="submit" style="width: 200px">Xóa</button>
        </form>
<?php
    }
    if(isset($_POST["teacherID"])){
        $teacherID = $_POST["teacherID"];
        $class = teacherClass($teacherID);
        deleteTeacher($teacherID, $class["class_id"]);
    }
?>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>