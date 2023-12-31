<?php
require 'teacher-header.php';
require '../model/function_teacher.php';
$studentID = $_POST["studentID"];
deleteStudentClassBySubject($studentID, $_SESSION["class_by_subject_id"]);
header("Location: class-by-subject.php");
exit();
?>