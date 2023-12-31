<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find flight</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            position: relative;
            /* Cho phép sử dụng 'position: absolute' cho .error-message */
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
            position: absolute;
            top: 0;
            right: 0;
            transform: translateY(-100%);
            /* Đẩy lên trên đỉnh form */
        }
    </style>
</head>

<body>
    <header>Sửa mới môn học</header>
    <?php
    require "connect.php";
    ?>
    <?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }
    ?>
    <?php
    $sql = "SELECT * FROM subject WHERE subject_id = $id";
    $result = $conn->query($sql); // Thực hiện truy vấn

    if ($result === FALSE) {
        die("Lỗi truy vấn: " . $conn->error); // Xử lý lỗi nếu có
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Lấy dòng dữ liệu từ kết quả truy vấn
        // Bây giờ bạn có thể sử dụng $row để lấy dữ liệu cần thiết
    } else {
        echo "Không có dữ liệu phù hợp.";
    }

    // Đóng kết nối sau khi sử dụng

    ?>
    <?php
    if (isset($_POST["update"])) {

        $subjectName = $_POST["subjectName"];
        $numberOfCredits = $_POST["numberOfCredits"];
        if ($subjectName == "") {
            echo "Chưa nhập tên môn học!<br>";
        } elseif ($numberOfCredits <= 0) {
            echo "Số tín chỉ không hợp lệ!<br>";
        } elseif (($subjectName != "") && ($numberOfCredits >= "")) {
            $sql1 = "UPDATE subject SET subject_name = '$subjectName', number_of_credits = '$numberOfCredits' WHERE subject_id = $id";
            if ($conn->query($sql1) === TRUE) {
                header("location: ./index.php?page=list-subject");
            } else {
                echo "Error: " . $sql1 . "<br>" . $conn->error;
            }
            $sql2 = "UPDATE register_subject SET subject_name = '$subjectName' WHERE subject_id = $id";
            if ($conn->query($sql2) === TRUE) {
                header("location: ./index.php?page=list-subject");
            } else {
                echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
        }
    }
    ?>
    <form action="" method="POST">
        <lable>Tên môn học<lable><input type="text" name="subjectName" value="<?php echo $row['subject_name']; ?>"><br>
                <lable>Số tín chỉ<lable><input type="number" name="numberOfCredits" value="<?php echo $row['number_of_credits']; ?>"><br>
                        <input type="submit" name="update" value="CẬP NHẬT">
    </form>
</body>