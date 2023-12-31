<?php
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm giáo viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/teacher.css">
    <!-- Font -->
    <link rel="stylesheet" href="../assets/fonts/stylesheet.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            document.querySelector('#check').onchange = function(){
                if (this.checked) {
                    document.querySelector('#submit').disabled = false;
                } else {
                    document.querySelector('#submit').disabled = true;
                }
            };
            document.querySelector('#submit').onclick = form;
        });
            function form(){
                const hoTen = document.querySelector('#teacherName').value;
                const tenDangNhap = document.querySelector('#userName').value;
                const password = document.querySelector('#password').value;
                const ngaysinh = document.querySelector('#birthday').value;
                const email = document.querySelector('#email').value;
                const sdt = document.querySelector('#phonenumber').value;
                const diachi = document.querySelector('#address').value;
                const monhoc = document.querySelector('#teacherSubject').value;
            if(!hoTen || !tenDangNhap || !password || !ngaysinh || !diachi || !email || !sdt ||!monhoc){
                alert("Bạn chưa nhập đủ thông tin!");
            }
            if(password.length >=6 && tenDangNhap.length >= 6){
                alert("Thêm thành công thành công!");
            }else{
                alert("Mật khẩu và tên đăng nhập cần ít nhất 6 ký tự!");
            }   
    }
    </script>
</head>
<body>
<?php
require_once '../templates/header-admin.php'; 
require '../model/function_teacher.php';
$subjects = getAllSubject();
?>
<div class="container">
    <h1 style="text-align: center">Thêm giáo viên</h1>
    <form method="post" action="" id="form">
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="teacherName" class="form-label">Tên giáo viên<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="teacherName" name="teacherName">
            </div>
            <br>
            <div class="mb-3">
                <label for="birthday" class="form-label">Ngày sinh<span style="color: red">*</span></label>
                <input type="date" class="form-control" id="birthday" name="birthday" >
            </div>
            <br>
            <div class="mb-3">
                <label for="phonenumber" class="form-label">Số điện thoại<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="0123456789">
            </div>
            <br>
            <div class="mb-3">
                <label for="email" class="form-label">Email<span style="color: red">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@gmail.com">
            </div>
            <br>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ<span style="color: red">*</span></label>
                <input type="address" class="form-control" id="address" name="address" placeholder="Hà Nội">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="userName" class="form-label">Tên đăng nhập<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="userName" name="userName">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="teacherSubject" class="form-label">Môn học giảng dạy chính<span style="color: red">*</span></label>
                <select name="teacherSubject" id="teacherSubject" class="form-control">
        <?php
                for($i = 0; $i < $subjects->num_rows; $i++){ 
                    $row = $subjects->fetch_assoc(); //doc du lieu tung dong
                    $subjectID = $row['subject_id'];
                    $subjectName = $row['subject_name'];
                    echo "<option value='$subjectID'>" . $subjectName ."</option>";
                }  
            echo"</select>";
   ?>
            </div>
            <div>
                <input class="form-check-input" type="checkbox" value="" id="check">
                <label class="form-check-label" for="check">Xác nhận</label>
            </div>
            <br>
            <button type="submit" id="submit" class="btn btn-primary" disabled>Thêm giáo viên</button>
        </div>
    </div>
    </form>
</div>

<?php
if(isset($_POST["teacherName"], $_POST["birthday"], $_POST["email"], $_POST["address"], $_POST["userName"], $_POST["password"], $_POST["teacherSubject"], $_POST["phonenumber"])){
    $teacherName = $_POST["teacherName"];
    $birthday = $_POST["birthday"];
    $phonenumber = $_POST["phonenumber"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $userName = $_POST["userName"];
    $password = $_POST["password"];
    $teacherSubject = $_POST["teacherSubject"];
    if($teacherName != null && $birthday != null && $phonenumber != null && $email != null && $address != null && $userName != null && $password != null && $teacherSubject != null){
        addTeacher($teacherName, $birthday, $phonenumber, $email, $address, $userName, $password, $teacherSubject);
    }
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>