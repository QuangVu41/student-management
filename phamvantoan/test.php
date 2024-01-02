<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/teacher.css">
    <style>
        .layout{
            display: grid;
        }
    </style>
</head>
<body>
<?php
$currentTime = time(); // Lấy thời gian hiện tại (timestamp)

// Định dạng thời gian theo "năm - tháng - ngày"
$formattedTime = date('Y-m-d', $currentTime);

echo "Thời gian hiện tại là: " . $formattedTime;
?>
</body>
</html>