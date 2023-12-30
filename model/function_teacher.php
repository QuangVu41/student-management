<?php
require 'connect.php';

function getTeacher($teacher_id){
    $conn = connectdb();
    $sql = "SELECT * FROM teacher WHERE teacher_id = $teacher_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();    
    return $result;
}

function getSubject($subject_id){
    $conn = connectdb();
    $sql = "SELECT * FROM `subject` WHERE subject_id = $subject_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    return $result;
}

function updateTeacher($teacher_id,$phone_number, $email, $address){
    $conn = connectdb();
    $sql = "UPDATE teacher SET phonenumber = '$phone_number', email = '$email', `address` = '$address' WHERE teacher_id = $teacher_id";
    if($conn->query($sql) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function updatePassword($teacher_id, $new_password){
    $conn = connectdb();
    $sql = "UPDATE teacher SET `password` = '$new_password' WHERE teacher_id = $teacher_id";
    if($conn->query($sql) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function teacherClass($teacher_id){
    $conn = connectdb();
    $sql = "SELECT * FROM class WHERE teacher_id = $teacher_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    return $result;
}

function classStudent($class_id){
    $conn = connectdb();
    $sql = "SELECT * FROM student WHERE class_id = $class_id";
    $data = $conn->query($sql);
    $conn->close();
    return $data;
}

function findStudent($studentID){
    $conn = connectdb();
    $sql = "SELECT * FROM student WHERE student_id = $studentID";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    return $result;
}

function addStudentToClass($studentID, $classID){
    $conn = connectdb();
    $sql1 = "UPDATE student SET class_id = $classID WHERE student_id = $studentID";
    if($conn->query($sql1) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }

    $sql2 = "SELECT * FROM class WHERE class_id = $classID";
    $data = $conn->query($sql2);
    $result = $data->fetch_assoc();
    $numberStudent = $result["number_of_students"] + 1;

    $sql3 = "UPDATE class SET number_of_students = $numberStudent WHERE class_id = $classID";
    if($conn->query($sql3) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        echo "Error: " . $sql3 . "<br>" . $conn->error;
    }
}

function deleteStudent($studentID, $classID){
    $conn = connectdb();
    $sql = "UPDATE student SET class_id = NULL WHERE student_id = $studentID";
    if($conn->query($sql) === true){
        echo "<br> Xóa thành công <br>";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql2 = "SELECT * FROM class WHERE class_id = $classID";
    $data = $conn->query($sql2);
    $result = $data->fetch_assoc();
    $numberStudent = $result["number_of_students"] - 1;

    $sql3 = "UPDATE class SET number_of_students = $numberStudent WHERE class_id = $classID";
    if($conn->query($sql3) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        echo "Error: " . $sql3 . "<br>" . $conn->error;
    }
}

function classBySubject($teacherID){
    $conn = connectdb();
    $sql = "SELECT * FROM class_by_subject WHERE teacher_id = $teacherID";
    $data = $conn->query($sql);
    $conn->close();
    return $data;
}

function findStudentClassBySubject($classID){
    $conn = connectdb();
    $sql = "SELECT * FROM student_class_by_subject WHERE class_id = $classID";
    $data = $conn->query($sql);
    $conn->close();
    return $data;
}

function deleteStudentClassBySubject($studentID, $classID){
    $conn = connectdb();
    $sql = "DELETE FROM student_class_by_subject WHERE student_id = $studentID AND class_id = $classID ";
    if($conn->query($sql) === true){
        echo "<br> Xóa thành công <br>";
    }else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql2 = "SELECT * FROM class_by_subject WHERE class_id = $classID";
    $data = $conn->query($sql2);
    $result = $data->fetch_assoc();
    $numberStudent = $result["number_of_students"] - 1;

    $sql3 = "UPDATE class_by_subject SET number_of_students = $numberStudent WHERE class_id = $classID";
    if($conn->query($sql3) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        echo "Error: " . $sql3 . "<br>" . $conn->error;
    }
}

function addStudentToClassBySubject($studentID, $classID){
    $conn = connectdb();
    $sql1 = "INSERT INTO student_class_by_subject (student_id, class_id) VALUES ($studentID, $classID)";
    if($conn->query($sql1) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }

    $sql2 = "SELECT * FROM class_by_subject WHERE class_id = $classID";
    $data = $conn->query($sql2);
    $result = $data->fetch_assoc();
    $numberStudent = $result["number_of_students"] + 1;

    $sql3 = "UPDATE class_by_subject SET number_of_students = $numberStudent WHERE class_id = $classID";
    if($conn->query($sql3) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        echo "Error: " . $sql3 . "<br>" . $conn->error;
    }
}
?>