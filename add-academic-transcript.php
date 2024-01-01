<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font -->
    <link rel="stylesheet" href="./assets/fonts/stylesheet.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
    <!-- Header -->
    <?php require_once './templates/header.php' ?>
    <?php
    require_once './model/connect.php';
    $conn = connectdb();
    if ($_SESSION['admin'] && $_SESSION['admin']['role_id'] == 1 || ($_SESSION['teacher'] && $_SESSION['teacher']['role_id'] == 2) || ($_SESSION['student'] && $_SESSION['student']['role_id'] == 3)) {
        if (isset($_POST["add"])) {
            $student_id = $_POST["student_id"];
            $get_scores_query = "SELECT AVG(score) AS avg_score FROM registered_subject WHERE student_id = $student_id";
            $result = $conn->query($get_scores_query);
            $row = $result->fetch_assoc();
            $gpa = $row['avg_score'];
            $insert_gpa_query = "INSERT INTO `academic_transcript`(gpa, student_id) VALUES ($gpa, $student_id)";
            $conn->query($insert_gpa_query);
            $sql = "SELECT * FROM `academic_transcript` WHERE student_id = '$student_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
    ?>
                <table>
                    <caption> Bảng điểm của học sinh </caption>
                    <tr>
                        <th>transcrip_id</th>
                        <th>gpa</th>
                        <th>student_id</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $row["transcript_id"] ?></td>
                            <td><?= $row["gpa"] ?></td>
                            <td><?= $row["student_id"] ?></td>
                        </tr>
            <?php
                    }
                }
            }
            ?>
                </table>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-9">
                            <form method="post">
                                <label style="font-size: 17px;">Student: </label><select name="student_id" style="height: 35px;">
                                    <?php
                                    $sql = "SELECT student_id, student_name FROM `student`";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        $student_id = $row['student_id'];
                                        $student_name = $row["student_name"];
                                        echo "<option value='$student_id'>" . $student_id . ": " . $student_name . "</option>";
                                    }
                                    ?>
                                </select>
                                <input type="submit" class="btn btn-success" name="add" value="Add" />
                            </form>
                        </div>
                        <?php require_once './sidebar-admin-2.php' ?>
                    </div>
                </div>
                <!-- Footer -->
                <?php require_once './templates/footer.php' ?>
</body>

</html>
<?php } else {
        // header('location: ./index.php');
        echo "Bạn không có quyền truy cập trang web này!";
        $conn->close();
    } ?>