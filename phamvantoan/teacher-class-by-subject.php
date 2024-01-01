<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý lớp giảng dạy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/teacher.css">
</head>
<body>
<?php
    require 'teacher-header.php';
    require '../model/function_teacher.php';
    if(isset($_SESSION['teacher_id'])){
        $classBySubject = classBySubject($_SESSION['teacher_id']);
?>
        <div class="container" style="margin-bottom: 500px">
<?php   for($i = 0; $i < $classBySubject->num_rows; $i++){
            $row = $classBySubject->fetch_assoc();
            $className = $row["class_name"];
            $classID = $row["class_id"];
            $numberOfStudents = $row["number_of_students"]; 
            $subject = getSubject($row["subject_id"]);
?>
            <form class="d-flex" method="post" action="class-by-subject.php" style="margin-top: 40px">
                <input  type="hidden" value="<?= $classID?>" name="classID"/>
                <input  type="hidden" value="<?= $numberOfStudents?>" name="numberOfStudents"/>
                <input  type="hidden" value="<?= $subject["subject_name"]?>" name="subjectName"/>
                <input class="btn btn-warning" type="submit" value="<?= $className?>" name="className" style="width: 500px"/>
            </form>
<?php
        }
?>
        </div>
<?php
    }else{
?>
        <p>Vui lòng đăng nhập trước!</p>
<?php
    }
    require 'teacher-footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>