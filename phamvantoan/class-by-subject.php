<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý lớp chủ nhiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .layout{
            display: grid;
            grid-column-gap: 10px;
            grid-template-columns: 70% auto;
            margin-top: 30px;
        }
        .card-with-text{
            width: 30rem;
            height: 45rem;
        }
    </style>
</head>
<body>
<?php
    require 'teacher-header.php';
    require '../model/function_teacher.php';
    if(isset($_SESSION['teacher_id'])){
        if(isset($_POST["classID"],$_POST["className"],$_POST["numberOfStudents"],$_POST["subjectName"])){
            $classID = $_POST["classID"];
            $className = $_POST["className"];
            $numberOfStudents = $_POST["numberOfStudents"];
            $subjectName = $_POST["subjectName"];
            $students = findStudentClassBySubject($classID);
            $_SESSION["class_by_subject_id"] = $classID;
            $_SESSION["controller"] = "class_by_subject";
?>
<div class="container">
    <div class="layout">
        <div>
            <h3 style="text-align: center;">Sinh viên</h3>
            <form method="post" action="teacher-delete-student-from-class-by-subject.php">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Mã sinh viên</th>
                        <th scope="col">Tên sinh viên</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Email</th>
                    </tr>
                </thead>
                <tbody>
<?php
            for($i = 0; $i < $students->num_rows; $i++){
                $row = $students->fetch_assoc();
                $student = findStudent($row["student_id"]);
                $studentID = $student['student_id'];
                $studentName = $student['student_name'];
                $studentBirthday = $student['date_of_birth'];
                $phonenumber = $student['phonenumber'];
                $email = $student['email'];
                echo "<tr>
                        <td>" . $studentID . "</td>
                        <td>" . $studentName . "</td>
                        <td>" . $studentBirthday . "</td>
                        <td>" . $phonenumber . "</td>
                        <td>" . $email ."</td>";
?>
                        <td><button class="btn btn-warning" type="submit" name="delete">xóa</button></td>
                        <input type="hidden" value="<?= $studentID ?>" name="studentID"/>
                        <td><a class="btn btn-primary" href="teacher-add-evaluation.php?student_id=<?=$studentID?>">Xem đánh giá</a></td>
                    </tr>
<?php               
            }
?>
                </tbody>
            </table>
            </form>
            <br>  
            <form class="d-flex" role="search" method="post" action="teacher-find-student.php">
                <button class="btn btn-outline-success" type="submit">Tìm kiếm sinh viên</button>
            </form>
            
        </div>
        <div>
        <div class="container box">
            <div class="card card-with-text">
                <img src="../assets/imgs/profile/cover.png" class="card-img-top" alt="..." style="height: 200px">
                <div class="card-body">
                    <h3 style="text-align: center;"><?php echo $className; ?></h3>
                    <p class="card-text">Số lượng sinh viên: <?php echo $numberOfStudents; ?></p>
                    <hr>
                    <p class="card-text">Số lượng sinh viên tối đa: 60</p>
                    <hr>
                    <p class="card-text">Tên môn học: <?php echo $subjectName; ?></p>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php
    }
    }else{
?>
        <p>Vui lòng đăng nhập trước</p>
<?php
    }
    require 'teacher-footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>