<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh giá sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/teacher.css">
</head>
<body>
<?php
    require 'teacher-header.php';
    require '../model/function_teacher.php';
    if(isset($_SESSION['teacher_id'])){
        if(isset($_GET["student_id"])){
            $student_id = $_GET["student_id"];
            $evaluations = getEvaluation($student_id);
?>
        <div class="container" style="margin-bottom: 200px">
            <form method="post" action="delete-evaluation.php">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Loại đánh giá</th>
                        <th scope="col">Lý do</th>
                    </tr>
                </thead>
                <tbody>
<?php
            for($i = 0; $i < $evaluations->num_rows; $i++){
                $row = $evaluations->fetch_assoc();
                $id = $row['evaluation_id'];
                if($row['type_evaluation'] == 1){
                    $type = "tốt";
                }else{
                    $type = "xấu";
                }
                $reason = $row['reason'];
                $date = $row['date'];
                echo "<tr>
                        <td>" . $type . "</td>
                        <td>" . $reason . "</td>";
?>
                        <td><button class="btn btn-warning" type="submit" name="delete">xóa</button></td>
                        <input type="hidden" value="<?= $id ?>" name="evaluationID"/>
                        <input type="hidden" value="<?= $student_id ?>" name="student_id"/>
                    </tr>
<?php               
            }
?>
                </tbody>
            </table>
            </form>
            <br>  
            <h1 style="text-align: center">Thêm đánh giá</h1>
            <form class="d-flex" role="search" method="post" action="add-evaluation.php">
                <div class="col-sm-6">
                    <div class="mb-3">
                        <label for="type" class="form-label">Loại đánh giá<span style="color: red">*</span></label>
                        <select name="type" id="type" class="form-control">
                            <option value=1>Tốt</option>
                            <option value=0>Xấu</option>
                        </select>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label for="reason" class="form-label">Lý do<span style="color: red">*</span></label>
                        <input type="text" class="form-control" id="reason" name="reason">
                    </div>
                    <br>
                    <div class="mb-3">
                    <button class="btn btn-outline-success" type="submit">Đánh giá sinh viên</button>
                    <input type="hidden" class="form-control" id="studentID" name="studentID" value = <?php echo $student_id;?>>
                    </div>
                </div>
            </form>
        </div>
<?php
        }
    }else{
?>
        <p>Vui lòng đăng nhập trước!</p>
<?php
    }
    require 'teacher-footer.php';
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>