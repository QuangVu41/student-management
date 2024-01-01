<?php
// connect database
$serverName = "localhost";
$userName = "root";
$password = "";
$db = "student-management";
$conn = new mysqli($serverName, $userName, $password, $db);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed" . $conn->connect_error);
}
