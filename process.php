<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra xem action là thêm, sửa hay xóa
    if (isset($_POST["add"])) {
        // Thêm môn học
        $subjectName = $_POST["subject_name"];
        $numberOfCredits = $_POST["number_of_credits"];

        $sql = "INSERT INTO subject (subject_name, number_of_credits) VALUES ('$subjectName', '$numberOfCredits')";
        if ($conn->query($sql) === TRUE) {
            echo "Thêm môn học thành công.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST["subject_id"]) && isset($_POST["edit"])) {
        // Sửa môn học
        $subjectId = $_POST["subject_id"];
        $subjectName = $_POST["subject_name"];
        $numberOfCredits = $_POST["number_of_credits"];

        $sql = "UPDATE subject SET subject_name='$subjectName', number_of_credits='$numberOfCredits' WHERE subject_id='$subjectId'";
        if ($conn->query($sql) === TRUE) {
            echo "Sửa môn học thành công.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } elseif (isset($_POST["delete"])) {
        // Xóa môn học
        $subjectName = $_POST["subject_name"];

        $sql = "DELETE FROM subject WHERE subject_name='$subjectName'";
        if ($conn->query($sql) === TRUE) {
            echo "Xóa môn học thành công.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>