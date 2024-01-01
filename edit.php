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
<div class="container-fluid">
    <div class="row">
        <div class="col-9">
            <h1 class="cart-info__heading">Sửa mới môn học</h1>
            <form action="" method="POST" class="form">
                <div class="form__row">
                    <div class="form__group">
                        <lable class="form__label">Tên môn học<lable>
                                <div class="form__text-input">
                                    <input type="text" name="subjectName" value="<?php echo $row['subject_name']; ?>">
                                </div>
                    </div>
                    <div class="form__group">
                        <lable class="form__label">Số tín chỉ<lable>
                                <div class="form__text-input"><input type="number" name="numberOfCredits" value="<?php echo $row['number_of_credits']; ?>"></div>
                    </div>
                </div>
                <div class="form__group">
                    <input class="btn btn--primary" type="submit" name="update" value="CẬP NHẬT">
                </div>
            </form>
        </div>
        <?php require_once './sidebar-admin-2.php' ?>
    </div>
</div>