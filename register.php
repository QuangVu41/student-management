<?php
include 'connect.php';
session_start();

// Lấy student từ session sinh viên đăng nhập
if ((isset($_SESSION['student'])) && isset($_GET['id'])) {
    $student_id = $_SESSION['student']['student_id'];
    $subject_id = $_GET['id'];

    // Tạo câu lệnh SQL để chèn dữ liệu vào bảng subject_registered
    $sql = "INSERT INTO registered_subject (subject_id, student_id, score) 
            VALUES ('$subject_id', '$student_id', 0)";

    // Thực hiện câu lệnh SQL
    if ($conn->query($sql) === TRUE) {
        header("location: ./index.php?page=list-registered");
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Không thể xác định môn học hoặc sinh viên đăng nhập.";
}

$conn->close();
