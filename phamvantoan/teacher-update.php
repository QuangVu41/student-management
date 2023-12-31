<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi thông tin giáo viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
            function form(){
                const soDienThoai = document.querySelector('#phonenumber').value;
                const email = document.querySelector('#email').value;
                const address = document.querySelector('#address').value;
            if(!soDienThoai || !email || !address){
                alert("Bạn chưa nhập đủ thông tin!");
            }
    }
        });
    </script>
</head>
<body>
<?php
    require 'teacher-header.php';
    require '../model/function_teacher.php';
    if(isset($_SESSION['teacher_id'])){
?>
<div class="container">
    <h1 style="text-align: center">Sửa thông tin tài khoản</h1>
    <form method="post" action="">
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="teacherID" class="form-label">Mã giáo viên</label>
                <input type="text" class="form-control" id="teacherID" name="teacherID" value="<?php echo $_SESSION['teacher']['teacher_id']; ?>" disabled readonly>
            </div>
            <br>
            <div class="mb-3">
                <label for="teacherName" class="form-label">Tên giáo viên</label>
                <input type="text" class="form-control" id="teacherName" name="teacherName" value="<?php echo $_SESSION['teacher']['teacher_name']; ?>" disabled readonly>
            </div>
            <br>
            <div class="mb-3">
                <label for="birthday" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $_SESSION['teacher']['date_of_birth']; ?>" disabled readonly>
            </div>
            <br>
            <div class="mb-3">
                <label for="teacherSubject" class="form-label">Môn học giảng dạy chính</label>
                <input type="text" class="form-control" id="teacherSubject" name="teacherSubject" value="<?php echo $_SESSION['subject']['subject_name']; ?>" disabled readonly>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="phonenumber" class="form-label">Số điện thoại<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="<?php echo $_SESSION['teacher']['phonenumber']; ?>" placeholder="0123456789">
            </div>
            <br>
            <div class="mb-3">
                <label for="email" class="form-label">Email<span style="color: red">*</span></label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['teacher']['email']; ?>" placeholder="name@gmail.com">
            </div>
            <br>
            <div class="mb-3">
                <label for="address" class="form-label">Địa chỉ<span style="color: red">*</span></label>
                <input type="address" class="form-control" id="address" name="address" value="<?php echo $_SESSION['teacher']['address']; ?>" placeholder="Hà Nội">
            </div>
            <div>
                <input class="form-check-input" type="checkbox" value="" id="check">
                <label class="form-check-label" for="check">Xác nhận</label>
            </div>
            <br>
            <button type="submit" id = submit class="btn btn-primary" disabled>Lưu thay đổi</button>
        </div>
    </div>
    </form>
</div>
<?php
        if(isset($_POST["phonenumber"], $_POST["email"], $_POST["address"])){
            $phone_number = $_POST["phonenumber"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            if($phone_number != null && $email != null && $address != null){
                updateTeacher($_SESSION['teacher_id'], $phone_number, $email, $address);
            }
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