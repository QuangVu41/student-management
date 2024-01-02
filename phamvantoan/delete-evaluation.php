<?php
require 'teacher-header.php';
require '../model/function_teacher.php';
$evaluationID = $_POST["evaluationID"];
$student_id = $_POST["student_id"];
deleteEvaluation($evaluationID);
header("Location: teacher-add-evaluation.php?student_id=$student_id");
exit();
?>