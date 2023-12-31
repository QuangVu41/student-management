<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật lớp</title>
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
if(isset($_POST["classID"])){
    $classID = $_POST["classID"];
}
?>
<div class="container">
    <h1 style="text-align: center">Cập nhật lớp</h1>
    <form method="post" action="">
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <input  type="hidden" value="<?= $classID?>" id="class_ID" name="class_ID" readonly/>
            </div>
            <br>
            <div class="mb-3">
                <label for="className" class="form-label">Tên lớp<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="className" name="className">
            </div>
            <br>
            <div class="mb-3">
                <label for="grade" class="form-label">Khối<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="grade" name="grade" >
            </div>
            <br>
            <div class="mb-3">
                <label for="academicYear" class="form-label">Niên khóa<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="academicYear" name="academicYear" placeholder="2021-2025">
            </div>
            <div class="mb-3">
                <label for="teacherID" class="form-label">Giáo viên chủ nhiệm<span style="color: red">*</span></label>
                <select name="teacherID" id="teacherID" class="form-control">
        <?php
                for($i = 0; $i < $teachers->num_rows; $i++){ 
                    $row = $teachers->fetch_assoc(); //doc du lieu tung dong
                    $teacher_id = $row['teacher_id'];
                    $teacherName = $row['teacher_name'];
                    echo "<option value='$teacher_id'>" . $teacherName ."</option>";
                }  
            echo"</select>";
   ?>
            </div>
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </div>
    </form>
</div>

<?php
if(isset($_POST["className"], $_POST["grade"], $_POST["academicYear"], $_POST["teacherID"], $_POST["class_ID"])){
    $className = $_POST["className"];
    $grade = $_POST["grade"];
    $academicYear = $_POST["academicYear"];
    $teacherID = $_POST["teacherID"];
    $class_id = $_POST["class_ID"];
    updateClass($class_id, $className, $grade, $academicYear, $teacherID);
    $classID = $class_id;
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>