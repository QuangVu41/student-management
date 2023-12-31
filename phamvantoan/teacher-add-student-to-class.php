<?php
require 'teacher-header.php';
require '../model/function_teacher.php';
if(isset($_SESSION["controller"])){
    if($_SESSION["controller"] == "class"){
        addStudentToClass($_SESSION['studentToClass'], $_SESSION['class']['class_id']);   
    }else{
        addStudentToClassBySubject($_SESSION['studentToClass'], $_SESSION["class_by_subject_id"]);
    }
}
header("Location: teacher-find-student.php");
exit();
?>