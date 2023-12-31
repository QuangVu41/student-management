<?php
include 'connect.php';

// Kiểm tra xem sinh viên đã đăng nhập chưa
if (isset($_SESSION['student'])) {
    $student_id = $_SESSION['student']['student_id'];

    // Truy vấn CSDL để lấy danh sách môn học đã đăng ký của sinh viên
    $sql = "SELECT subject_id FROM registered_subject WHERE student_id = $student_id";

    $result = $conn->query($sql);

    // In ra danh sách môn học đã đăng ký
    while ($row = $result->fetch_assoc()) {
        $subject_id = $row["subject_id"];

        // Lấy thông tin môn học từ bảng subject
        $subject_info_sql = "SELECT subject_name, number_of_credits FROM subject WHERE subject_id = $subject_id";
        $subject_info_result = $conn->query($subject_info_sql);

        if ($subject_info_result->num_rows > 0) {
            $subject_info = $subject_info_result->fetch_assoc();
            echo "Mã môn học: " . $subject_id . "<br>";
            echo "Tên môn học: " . $subject_info["subject_name"] . "<br>";
            echo "Số tín chỉ: " . $subject_info["number_of_credits"] . "<br>";
            echo "<hr>";
        }
    }
} else {
    echo "Sinh viên chưa đăng nhập hoặc không phải sinh viên.";
}

$conn->close();
