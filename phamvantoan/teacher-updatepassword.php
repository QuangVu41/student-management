<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
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
        });
            function form(){
                const matKhauCu = document.querySelector('#old-password').value;
                const matKhauMoi = document.querySelector('#new-password').value;
                const matKhauMoiNhapLai = document.querySelector('#new-password-again').value;
            if(!matKhauCu || !matKhauMoi || !matKhauMoiNhapLai){
                alert("Bạn chưa nhập đủ thông tin!");
            }
            if(matKhauMoi != matKhauMoiNhapLai){
                alert("Mật khẩu mới phải trùng với mật khẩu nhập lại!");
            } 
    }
    </script>
</head>
<body>
<?php
    require 'teacher-header.php';
    require '../model/function_teacher.php';
    if(isset($_SESSION['teacher_id'])){
?>
<div class="container">
    <h1 style="text-align: center">Đổi mật khẩu</h1>
    <form method="post" action="">
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label for="old-password" class="form-label">Mật khẩu cũ<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="old-password" name="old-password" placeholder="nhập mật khẩu cũ">
            </div>
            <br>
            <div class="mb-3">
                <label for="new-password" class="form-label">Mật khẩu mới<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="new-password" name="new-password" placeholder="nhập mật khẩu mới">
            </div>
            <br>
            <div class="mb-3">
                <label for="new-password-again" class="form-label">Nhập lại mật khẩu mới<span style="color: red">*</span></label>
                <input type="text" class="form-control" id="new-password-again" name="new-password-again"  placeholder="nhập lại mật khẩu mới">
            </div>
            <div>
                <input class="form-check-input" type="checkbox" value="" id="check">
                <label class="form-check-label" for="check">Xác nhận</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" id="submit" disabled>Lưu thay đổi</button>
        </div>
    </div>
    </form>
</div>
<?php
        if(isset($_POST["old-password"], $_POST["new-password"], $_POST["new-password-again"])){ //kiểm tra bằng js nhập toàn bộ các ô và mật khẩu mới trùng mật khẩu mới nhập lại
            $old_password = $_POST["old-password"];
            $new_password = $_POST["new-password"];
            $new_password_again = $_POST["new-password-again"];

            if($old_password == $_SESSION['teacher']['password'] && $new_password == $new_password_again){
                updatePassword($_SESSION['teacher_id'], $new_password);
            }else{
                echo "Nhập sai mật khẩu!";
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