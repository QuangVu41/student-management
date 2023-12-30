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
        $class = teacherClass($_SESSION['teacher_id']);
        $_SESSION['class'] = $class;
        $students = classStudent($class["class_id"]);
        $_SESSION["controller"] = "class";
?>
<div class="container">
    <div class="layout">
        <div>
            <h3 style="text-align: center;">Sinh viên</h3>
            <form method="post" action="">
            <table class="table">
                <thead>
                    <tr>
                        <th>Select</th>
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
                $studentID = $row['student_id'];
                $studentName = $row['student_name'];
                $studentBirthday = $row['date_of_birth'];
                $phonenumber = $row['phonenumber'];
                $email = $row['email'];
                echo "<tr>";
                ?>
                        <td><input type="checkbox" name="checkbox[]" value = "<?= $studentID ?>" ></td>
                <?php
                echo   "<td>" . $studentID . "</td>
                        <td>" . $studentName . "</td>
                        <td>" . $studentBirthday . "</td>
                        <td>" . $phonenumber . "</td>
                        <td>" . $email ."</td>
                    </tr>";
            }
?>
                </tbody>
            </table>
            <td><button class="btn btn-warning" type="submit" name="delete">xóa</button></td>
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
                    <h3 style="text-align: center;"><?php echo $class["class_name"]; ?></h3>
                    <p class="card-text">Khóa:  <?php echo $class["grade"]; ?></p>
                    <hr>
                    <p class="card-text">Niên khóa: <?php echo $class["academic_year"]; ?></p>
                    <hr>
                    <p class="card-text">Số lượng sinh viên: <?php echo $class["number_of_students"]; ?></p>
                    <hr>
                    <p class="card-text">Số lượng sinh viên tối đa: 60</p>
                    <hr>
                    <p class="card-text">Giáo viên chủ nhiệm: <?php echo $_SESSION['teacher']['teacher_name']; ?></p>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<?php
        if(isset($_POST["delete"], $_POST["checkbox"])){
            $check = $_POST["checkbox"];
            foreach($check as $studentID){
                deleteStudent($studentID, $class["class_id"]);
            }
            header("Location: teacher-find-student.php");
            exit();
        }
    }else{
?>
        <p>Vui lòng đăng nhập trước</p>
<?php
    }
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>