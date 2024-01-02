<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/teacher.css">
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            document.querySelector('#submit').onclick = form;
        });
            function form(){
                const sinhVienCanTim = document.querySelector('#findStudent').value;
            if(!sinhVienCanTim){
                alert("Bạn chưa nhập mã sinh viên!");
            }
    }
    </script>
</head>
<body>
<?php
    require 'teacher-header.php';
    require '../model/function_teacher.php';
    if(isset($_SESSION['teacher_id'])){
        if(isset($_SESSION["controller"])){
?>
<div class="container" style="margin-bottom: 500px">
    <h1 style="text-align: center">Tìm kiếm sinh viên</h1>
    <form class="d-flex" role="search" method="post" action="">
        <input class="form-control me-2" type="search" placeholder="Mã sinh viên" aria-label="Search" name="studentID" id="findStudent">
        <button class="btn btn-outline-success" type="submit" id = "submit">Tìm kiếm</button>
    </form>
<?php
    if(isset($_POST["studentID"])){
        $studentID = $_POST["studentID"];
        if($studentID != null){
            $student = findStudent($studentID);
        }
        if(isset($student)){
        if($student != null){
            $_SESSION['studentToClass'] = $studentID;
?>
            <form method="post" action="teacher-add-student-to-class.php">
            <input type="hidden" value="<?= $controller?>" name="controller"/>
            <div class="row">
            <div class="col-sm-6">
                <div class="mb-3">
                    <label for="studentID" class="form-label">Mã sinh viên</label>
                    <input type="text" class="form-control" id="studentID" name="studentID" value="<?php echo $student["student_id"]; ?>" disabled readonly>
                </div>
                <br>
                <div class="mb-3">
                    <label for="studentName" class="form-label">Tên sinh viên</label>
                    <input type="text" class="form-control" id="studentName" name="studentName" value="<?php echo $student["student_name"]; ?>" disabled readonly>
                </div>
                <button class="btn btn-outline-success" type="submit">Thêm vào lớp</button>
            </div>
            </div>
            </form>
<?php
        }
        }
    }else{
        echo "<br> nhập mã sinh viên <br>";
    }
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