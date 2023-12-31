<?php
        session_start();
        if(isset($_SESSION['teacher_id'])){
            unset($_SESSION['teacher_id']);
        }
        header("Location: teacher-index.php");
        exit();
?>