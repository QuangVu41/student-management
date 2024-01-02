<?php
require 'teacher-header.php';
require '../model/function_teacher.php';
$type = $_POST["type"];
$reason = $_POST["reason"];
$student_id = $_POST["studentID"];
addEvaluation($type, $reason, $student_id);
header("Location: teacher-add-evaluation.php?student_id=$student_id");
exit();
?>