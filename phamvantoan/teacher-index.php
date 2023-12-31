<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/teacher.css">
</head>
<body>
<?php
    require 'teacher-header.php';
    require '../model/function_teacher.php';
    if(isset($_SESSION['teacher_id'])){
        $teacher = getTeacher($_SESSION['teacher_id']);
        $_SESSION['teacher'] = $teacher;
        $subject = getSubject($teacher["subject_id"]);
        $_SESSION['subject'] = $subject;
?>
        <div class="container box">
            <div class="card card-with-text">
                <img src="../assets/imgs/profile/cover.png" class="card-img-top" alt="..." style="height: 200px">
                <div class="card-body">
                    <h3 style="text-align: center;"><?php echo $teacher["teacher_name"]; ?></h3>
                    <p class="card-text">Mã giáo viên: <?php echo $teacher["teacher_id"]; ?></p>
                    <hr>
                    <p class="card-text">Ngày sinh: <?php echo $teacher["date_of_birth"]; ?></p>
                    <hr>
                    <p class="card-text">Số điện thoại: <?php echo $teacher["phonenumber"]; ?></p>
                    <hr>
                    <p class="card-text">Email: <?php echo $teacher["email"]; ?></p>
                    <hr>
                    <p class="card-text">Địa chỉ: <?php echo $teacher["address"]; ?></p>
                    <hr>
                    <p class="card-text">Chuyên môn: <?php echo $subject["subject_name"]; ?></p>
                </div>
            </div>
        </div>
<?php
    }else{
?>
        <p>Vui lòng đăng nhập trước!</p>
<?php
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>