<?php
include "connect.php";
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quản lý sinh viên</title>
    <style>
        form {
            max-width: 300px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            background-color: #f4f4f4;
            /* Màu nền của form */
            padding: 20px;
            /* Đệm cho form */
            border-radius: 8px;
            /* Bo tròn góc của form */
        }

        h2 {
            text-align: center;
        }

        label {
            margin-bottom: 4px;
        }

        .search-input {
            flex: 1;
            background: #fff;
            padding: 8px;
            margin-bottom: 12px;
        }

        .buttons {
            display: flex;
        }

        button {
            flex: 1;
            padding: 10px;
            /* Kích thước của nút */
            cursor: pointer;
            margin-right: 4px;
            background-color: #4CAF50;
            /* Màu nền của nút */
            color: white;
            /* Màu chữ của nút */
            border: none;
            border-radius: 4px;
            /* Bo tròn góc của nút */
        }

        button:last-child {
            margin-right: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #content {
            max-width: 800px;
            margin: 20px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        .buttons a {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
        }

        .buttons a:hover {
            background-color: #45a049;
        }

        .buttons a:not(:last-child) {
            margin-right: 8px;
        }

        nav a.white,
        table tbody tr:first-child a.white {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <div id="search">
            <form action="" method="POST">
                <input class="search-input" type="text" name="txtsearch">
                <input class="search-input" type="submit" name="search" value="search">
            </form>
        </div>

        <?php
        if (isset($_POST["search"])) {
            $s = $_POST["txtsearch"];
            if ($s == "") {
                echo "Vui lòng nhập vào thanh tìm kiếm!";
            } else {
                $sql = "SELECT * FROM subject WHERE subject_name LIKE '%$s%'";
                $result = $conn->query($sql);

                if ($result === false) {
                    echo "Lỗi truy vấn: " . $conn->error;
                } else {
                    $count = $result->num_rows;
                    if ($count <= 0) {
                        echo "Không có kết quả với từ khóa " . $s . "</b>";
                    } else {
                        echo "Tìm thấy " . $count . " kết quả với từ khóa <b>" . $s . "</b>";

                        echo "<table border='1'>";
                        echo "<thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Môn học</th>
                                <th>Số tín chỉ</th> ";
                        if (!empty($_SESSION['admin']) && $_SESSION['admin']['role_id'] == 1) {
                            echo "<th><a href='add.php'>Thêm</a></th>";
                        } else {
                            echo "<th>Không có quyền</th>";
                        }
                        "</tr>
                        </thead>";

                        echo "<tbody>";
                        $stt = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["subject_id"] . "</td>";
                            echo "<td>" . $row["subject_name"] . "</td>";
                            echo "<td>" . $row["number_of_credits"] . "</td>";
                            if (!empty($_SESSION['admin']) && $_SESSION['admin']['role_id'] == 1) {
                                echo "<td>";
                                echo "<a href='edit.php?id=" . $row["subject_id"] . "'>Sửa</a> | ";
                                echo "<a href='delete.php?id=" . $row["subject_id"] . "'>Xóa</a>";
                                echo "</td>";
                            } elseif (!empty($_SESSION['student'])) {
                                echo "<td>";
                                echo "<a href='register.php?id=" . $row["subject_id"] . "'>Đăng kí</a>";
                                echo "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    }
                }
            }
        }
        ?>
    </div>
    <div id="content">
        <h2>Danh sách môn học</h2>
        <?php
        include 'connect.php';
        // Truy vấn cơ sở dữ liệu
        $sql = "SELECT * FROM subject";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Hiển thị dữ liệu từ CSDL trong bảng
            echo "<table border='1'>";
            echo "<thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Môn học</th>
                    <th>Số tín chỉ</th>";

            // Kiểm tra vai trò của người dùng (admin)
            if (!empty($_SESSION['admin']) && $_SESSION['admin']['role_id'] == 1) {
                echo "<th><a href='add.php'>Thêm</a></th>";
            } else {
                echo "<th>Không có quyền</th>";
            }

            echo "</tr>
            </thead>";

            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["subject_id"] . "</td>";
                echo "<td>" . $row["subject_name"] . "</td>";
                echo "<td>" . $row["number_of_credits"] . "</td>";
                if (!empty($_SESSION['admin']) && $_SESSION['admin']['role_id'] == 1) {
                    echo "<td>";
                    echo "<a href='edit.php?id=" . $row["subject_id"] . "'>Sửa</a> | ";
                    echo "<a href='delete.php?id=" . $row["subject_id"] . "'>Xóa</a>";
                    echo "</td>";
                } else if (!empty($_SESSION['student'])) {
                    echo "<td>";
                    echo "<a href='register.php?id=" . $row["subject_id"] . "'>Đăng kí</a>";
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "Không có môn học nào.<br>";
            if (!empty($_SESSION['admin']) && $_SESSION['admin']['role_id'] == 1) {
                echo "Thêm mới <a href = add.php> tại đây </a>";
            }
        }
        $conn->close();
        ?>
    </div>
    </div>
</body>

</html>