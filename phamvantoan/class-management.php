<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý giáo viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/css/teacher.css">
    <!-- Font -->
    <link rel="stylesheet" href="../assets/fonts/stylesheet.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>
<body>
<?php
    require_once '../templates/header-admin.php'; 
?>
    <div class="container">
        <form class="d-flex" method="post" action="class-add.php" style="margin-top: 40px">
            <input class="btn btn-warning" type="submit" value="Tạo lớp" name="className" style="width: 500px"/>
        </form>
        <form class="d-flex" method="post" action="update-delete-class.php" style="margin-top: 40px">
            <input class="btn btn-warning" type="submit" value="Quản lý lớp học" name="className" style="width: 500px"/>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>