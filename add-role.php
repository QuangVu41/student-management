<?php
session_start();
require_once './model/connect.php';
$conn = connectdb();
// if($_SESSION['role'] == 'admin'){
        if(isset($_POST["sign-up"])){
        $role_name = $_POST["role_name"];
        $sql = "INSERT INTO `role`(role_name) VALUES ('$role_name')";
        // $result = $conn->query($sql);
        if (!$conn->query($sql) === TRUE){
            echo "Error: " .$sql . "<br>" . $conn->error;
            }
        }
//}else{
  //  echo'Bạn không có quyền truy cập trang web này';
//}        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script>
        document.addEventListener('DOMContentLoaded',function(){
        document.querySelector('#submit').disabled = true;
        document.querySelector('#check').onchange = function(){
            if (this.checked) {
            document.querySelector('#submit').disabled = false;
        } else {
            document.querySelector('#submit').disabled = true;
        }
        };

        document.querySelector('#check-info').onclick = checkInfo;

       document.querySelector('#form').onsubmit = function(){
            alert("Chúc mừng bạn đã thêm role thành công!");
            };
});

function checkInfo() {
        let role_name = document.querySelector('#role_name').value;
       
        if (role_name === "") {
            alert("Vui lòng điền đầy đủ thông tin!");
        } else {
            alert("Dữ liệu hợp lệ. Tiến hành submit!");
        }
    }
    </script>
    <!-- Font -->
    <link rel="stylesheet" href="./assets/fonts/stylesheet.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>
<body>
    <!-- Header -->
    <?php require_once './templates/header-admin.php' ?>
    <div class="container-fluid" style = "height: 350px;">
        <form method = "post" id = "form">
            <label style = "font-size: 17px;">Role Name: </label><input type="text" name="role_name" id = "role_name" placeholder="Role Name" class="form-control w-25" style = "height: 35px;"><br/>
            <input type="checkbox" id = "check"> Bạn đồng ý thêm role?<br/>
            <button type="button" id="check-info" style = "height: 35px;">Check</button>
            <input type="submit" id = "submit" class = "btn btn-success" name = "sign-up" value="sign-up"/>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- Footer -->
    <?php require_once './templates/footer.php' ?>
</body>
</html>