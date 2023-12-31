<?php
require_once './model/connect.php';
$conn = connectdb();
session_start();
if ($_SESSION['admin'] && $_SESSION['admin']['role_id'] == 1) {
    if(isset($_POST["sign-up"])){
        $admin_name = $_POST['admin_name'];
        $date_of_birth = $_POST['date_of_birth'];
        $phonenumber = $_POST['phonenumber'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $role_id = $_POST['role_id'];
        $sql = "INSERT INTO `admin` (admin_name, date_of_birth, phonenumber,email,`address`, user_name,`password`, role_id) VALUES ('$admin_name', '$date_of_birth', $phonenumber, '$email', '$address', '$user_name','$password', '$role_id')";
        if (!$conn->query($sql) === TRUE){
        echo "Error: " .$sql . "<br>" . $conn->error;
        }
    }     
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
            alert("Chúc mừng bạn đã tạo tài khoản thành công!");
            };
});
    function checkPhoneNumber(phonenumber) {
            return /^\d{10}$/.test(phonenumber);
        }

        function checkEmail(email) {
            return /\S+@\S+\.\S+/.test(email);
        }
    function checkInfo() {
        let admin_name = document.querySelector('#admin_name').value;
        let date_of_birth = document.querySelector('#date_of_birth').value;
        let phonenumber = document.querySelector('#phonenumber').value;
        let email = document.querySelector('#email').value;
        let address = document.querySelector('#address').value;
        let user_name = document.querySelector('#user_name').value;
        let password = document.querySelector('#password').value;
        let role_id = document.querySelector ('#role_id').value;
       
        if (admin_name === "" || date_of_birth === "" || phonenumber === "" || email === "" || address === "" || user_name === "" || password === "" || role_id === "") {
            alert("Vui lòng điền đầy đủ thông tin và đồng ý lập tài khoản.");
            if (!checkEmail(email)) {
                    alert("Email không hợp lệ!");
            }
            if (!checkPhoneNumber(phonenumber)) {
                alert("Số điện thoại không hợp lệ. Vui lòng nhập đúng 10 chữ số.");
            }
        } else {
            alert("Dữ liệu hợp lệ. Tiến hành submit.");
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
    <div class="container-fluid">
    <div>
        <h2 class="cart-info__heading">Thêm tài khoản admin</h2>
    </div>
        <form method = "post" style = "width: 100%;" id = "form">
            <label style = "font-size: 17px;">Admin Name: </label><input type="text" name="admin_name" id = "admin_name" placeholder="Admin Name" style = "height: 35px;" class="form-control w-25"><br/>
            <label style = "font-size: 17px;">Date Of Birth: </label><input type="date" name="date_of_birth" id="date_of_birth" placeholder="Date of birth" style = "height: 35px;" class="form-control w-25"><br/>
            <label style = "font-size: 17px;">Phone Number: </label><input type="number" name="phonenumber" id="phonenumber" placeholder="Admin Name" style = "height: 35px;" class="form-control w-25"><br/>
            <label style = "font-size: 17px;">Email: </label><input type="email" name="email" id="email" placeholder="Email" style = "height: 35px;" class="form-control w-25"><br/>
            <label style = "font-size: 17px;">Address: </label><input type="text" name="address" id="address" placeholder="Address" style = "height: 35px;" class="form-control w-25"><br/>
            <label style = "font-size: 17px;">User Name: </label><input type="text" name="user_name" id="user_name" placeholder="User Name" style = "height: 35px;" class="form-control w-25"><br/>
            <label style = "font-size: 17px;">Password: </label><input type="password" name="password" id="password" placeholder="Password" style = "height: 35px;" class="form-control w-25"><br/>
            <label style = "font-size: 17px;">Role Id: </label><select name="role_id" id="role_id" class="form-control w-25" style = "height: 35px;">
                <?php
                    $sql = "SELECT * FROM `role`";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        $role_id = $row['role_id']; 
                        $role_name = $row["role_name"];
                        echo "<option value='$role_id'>" . $role_id . ": " . $role_name . "</option>";
                    }
                ?>
            </select><br/>
            <input type="checkbox" id = "check"> Bạn đồng ý lập tài khoản?<br/>
		    <button type="button" id="check-info" style = "height: 35px;">Check</button>
            <input type="submit" id = "submit" class = "btn btn-susscess" name = "sign-up" value="sign-up"/>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- Footer -->
    <?php require_once './templates/footer.php' ?>
</body>
</html>
<?php } else {
    // header('location: ./index.php');
    echo "Bạn không có quyền truy cập trang web này!";
} ?>         
