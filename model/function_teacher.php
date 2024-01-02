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
        
    }
}

function updatePassword($teacher_id, $new_password){
    $conn = connectdb();
    $sql = "UPDATE teacher SET `password` = '$new_password' WHERE teacher_id = $teacher_id";
    if($conn->query($sql) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        
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
        
    }

    $sql2 = "SELECT * FROM class WHERE class_id = $classID";
    $data = $conn->query($sql2);
    $result = $data->fetch_assoc();
    $numberStudent = $result["number_of_students"] + 1;

    $sql3 = "UPDATE class SET number_of_students = $numberStudent WHERE class_id = $classID";
    if($conn->query($sql3) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        
    }
}

function deleteStudent($studentID, $classID){
    $conn = connectdb();
    $sql = "UPDATE student SET class_id = NULL WHERE student_id = $studentID";
    if($conn->query($sql) === true){
        echo "<br> Xóa thành công <br>";
    }else{

    }

    $sql2 = "SELECT * FROM class WHERE class_id = $classID";
    $data = $conn->query($sql2);
    $result = $data->fetch_assoc();
    $numberStudent = $result["number_of_students"] - 1;

    $sql3 = "UPDATE class SET number_of_students = $numberStudent WHERE class_id = $classID";
    if($conn->query($sql3) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        
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
        
    }

    $sql2 = "SELECT * FROM class_by_subject WHERE class_id = $classID";
    $data = $conn->query($sql2);
    $result = $data->fetch_assoc();
    $numberStudent = $result["number_of_students"] - 1;

    $sql3 = "UPDATE class_by_subject SET number_of_students = $numberStudent WHERE class_id = $classID";
    if($conn->query($sql3) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        
    }
}

function addStudentToClassBySubject($studentID, $classID){
    $conn = connectdb();
    $sql1 = "INSERT INTO student_class_by_subject (student_id, class_id) VALUES ($studentID, $classID)";
    if($conn->query($sql1) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        
    }

    $sql2 = "SELECT * FROM class_by_subject WHERE class_id = $classID";
    $data = $conn->query($sql2);
    $result = $data->fetch_assoc();
    $numberStudent = $result["number_of_students"] + 1;

    $sql3 = "UPDATE class_by_subject SET number_of_students = $numberStudent WHERE class_id = $classID";
    if($conn->query($sql3) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        
    }
}

function getAllSubject(){
    $conn = connectdb();
    $sql = "SELECT * FROM `subject`";
    $data = $conn->query($sql);
    $conn->close();
    return $data;
}

function addTeacher($teacherName, $birthday, $phonenumber, $email, $address, $userName, $password, $subject){
    $conn = connectdb();
    $sql1 = "INSERT INTO teacher (teacher_name, date_of_birth, phonenumber, email, `address`, user_name, `password`, role_id, subject_id) VALUES ('$teacherName', $birthday, '$phonenumber', '$email', '$address', '$userName', '$password', 2, $subject)";
    if($conn->query($sql1) === true){
        echo "<br> Thêm thành công <br>";
    }else{
        
    }
}
function getAllTeacher(){
    $conn = connectdb();
    $sql = "SELECT * FROM teacher";
    $data = $conn->query($sql);
    $conn->close();    
    return $data;
}
function deleteTeacher($teacherID, $classID){
    $conn = connectdb();
    if($classID != null){
        $sql2 = "UPDATE class SET teacher_id = NULL WHERE class_id = $classID";
        if($conn->query($sql2) === true){
            echo "<br> Cập nhật thành công <br>";
        }
    }

    $sql1 = "DELETE FROM teacher WHERE teacher_id = $teacherID";
    if($conn->query($sql1) === true){
        echo "<br> Xóa thành công <br>";
    }else{
        
    }
}
function addClass($className, $grade, $academicYear, $teacherID){
    $conn = connectdb();
    $sql1 = "INSERT INTO class (class_name, grade, academic_year,number_of_students, teacher_id) VALUES ('$className','$grade', '$academicYear',0, $teacherID)";
    if($conn->query($sql1) === true){
        echo "<br> Thêm thành công <br>";
    }else{
        
    }
}
function getAllClass(){
    $conn = connectdb();
    $sql = "SELECT * FROM class";
    $data = $conn->query($sql);
    $conn->close();
    return $data;
}
function deleteClass($classID){
    $conn = connectdb();
    $sql2 = "UPDATE student SET class_id = NULL WHERE class_id = $classID";
    if($conn->query($sql2) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        
    }

    $sql1 = "DELETE FROM class WHERE class_id = $classID";
    if($conn->query($sql1) === true){
        echo "<br> Xóa thành công <br>";
    }else{
        
    }
}
function updateClass($classID,$className,$grade, $academicYear, $teacherID){
    $conn = connectdb();
    $sql = "UPDATE class SET class_name = '$className', grade = '$grade', academic_year = '$academicYear', teacher_id = $teacherID WHERE class_id = $classID";
    if($conn->query($sql) === true){
        echo "<br> Cập nhật thành công <br>";
    }else{
        
    }
}
?>