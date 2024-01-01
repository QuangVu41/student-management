<?php
include 'connect.php'; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-9">
            <table>
                <thead>
                    <tr>
                        <td>STT</td>
                        <td>Mã môn học</td>
                        <td>Tên môn học</td>
                        <td>Số tín chỉ</td>
                    </tr>
                </thead>
                <tbody>
                    <?php // Kiểm tra xem sinh viên đã đăng nhập chưa
                    if (isset($_SESSION['student'])) {
                        $student_id = $_SESSION['student']['student_id'];
                        // Truy vấn CSDL để lấy danh sách môn học đã đăng ký của sinh viên
                        $sql = "SELECT subject_id FROM registered_subject WHERE student_id = $student_id";
                        $result = $conn->query($sql);
                        // In ra danh sách môn học đã đăng ký
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            $subject_id = $row["subject_id"];
                            // Lấy thông tin môn học từ bảng subject
                            $subject_info_sql = "SELECT subject_name, number_of_credits FROM subject WHERE subject_id = $subject_id";
                            $subject_info_result = $conn->query($subject_info_sql);
                            if ($subject_info_result->num_rows > 0) {
                                $subject_info = $subject_info_result->fetch_assoc();
                                echo "<td> $i </td>";
                                echo "<td> " . $subject_id . "</td>";
                                echo "<td> " . $subject_info["subject_name"] . "</td>";
                                echo "<td> " . $subject_info["number_of_credits"] . "</td>";
                            }
                            echo "</tr>";
                            $i++;
                        }
                    } else {
                        echo "Sinh viên chưa đăng nhập hoặc không phải sinh viên.";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <?php require_once './sidebar-user.php' ?>
    </div>
</div>