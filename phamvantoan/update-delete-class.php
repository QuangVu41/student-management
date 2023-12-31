<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý lớp học</title>
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
    $class = getAllClass();
?>
    <div class="container">
<?php 
    for($i = 0; $i < $class->num_rows; $i++){
        $row = $class->fetch_assoc();
        $className = $row["class_name"];
        $classID = $row["class_id"];
?>
        <form class="d-flex" method="post" action="" style="margin-top: 40px">
            <input  type="text" value="<?= $classID?>" name="classID" readonly/>
            <input  type="text" value="<?= $className?>" name="className" readonly/>
            <button class="btn btn-warning" type="submit" style="width: 200px">Xóa</button>
        </form>
        <form class="d-flex" method="post" action="class-update.php" style="margin-top: 40px">
            <input  type="text" readonly/>
            <input  type="text" readonly/>
            <button class="btn btn-warning" type="submit" style="width: 200px">Cập nhật</button>
            <input  type="hidden" value="<?= $classID?>" name="classID" readonly/>
        </form>
<?php
    }
    if(isset($_POST["classID"])){
        $classID = $_POST["classID"];
        deleteClass($classID);
    }
?>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>