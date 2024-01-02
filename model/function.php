<?php
require_once './model/connect.php';
// ---------- Function upload ----------
function uploadFiles($uploadFiles)
{
    $files = [];
    $errors = [];
    $returnFiles = [];

    foreach ($uploadFiles as $key => $values) {
        if (is_array($values)) {
            foreach ($values as $index => $value) {
                $files[$index][$key] = $value;
            }
        } else {
            $files[$key] = $values;
        }
    }
    $targetDir = "./uploads/" . date('d-m-Y', time());
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    // Upload multiple files
    if (is_array(reset($files))) {
        foreach ($files as $file) {
            $result = processUploadFile($file, $targetDir);
            if ($result['error']) {
                $errors[] = $result['message'];
            } else {
                $returnFiles[] = $result['path'];
            }
        }
    } else { // Upload one file
        $result = processUploadFile($files, $targetDir);
        if ($result['error']) {
            return array(
                'errors' => $result['message']
            );
        } else {
            return array(
                'path' => $result['path']
            );
        }
    }

    return array(
        'errors' => $errors,
        'uploaded_files' => $returnFiles
    );
}

function processUploadFile($files, $targetDir)
{
    $is_upload = move_uploaded_file($files['tmp_name'], $targetDir . '/' . $files['name']);
    if ($is_upload) {
        return array(
            'error' => false,
            'path' => $targetDir . '/'  . $files['name']
        );
    } else {
        return array(
            'error' => true,
            'message' => "File upload " . $files['name'] . "is not valid!"
        );
    }
}

// ---------- Function check ----------
function checkStudentInfo($student_code, $password)
{
    $conn = connectdb();
    $sql = "SELECT * FROM student WHERE student_id = '$student_code' AND password = '$password'";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    if (!empty($result)) {
        return $result;
    } else {
        return false;
    }
}

function checkTeacherInfo($user_code, $password)
{
    $conn = connectdb();
    $sql = "SELECT * FROM teacher WHERE user_name = '$user_code' AND password = '$password'";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    if (!empty($result)) {
        return $result;
    } else {
        return false;
    }
}

function checkAdminInfo($user_code, $password)
{
    $conn = connectdb();
    $sql = "SELECT * FROM admin WHERE user_name = '$user_code' AND password = '$password'";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    if (!empty($result)) {
        return $result;
    } else {
        return false;
    }
}

// ---------- Function add ----------
function insertStudent($image, $name, $email, $phone, $date_of_birth, $address, $class_id, $gender, $status_id, $department)
{
    $conn = connectdb();
    $sql = "INSERT INTO student(student_name, date_of_birth, phonenumber, email, address, class_id, image, gender, status_id, department_id)
        VALUES('$name', '$date_of_birth', '$phone', '$email', '$address', $class_id, '$image', '$gender', $status_id, $department)";
    $data = $conn->query($sql);
    $inserted_id = $conn->insert_id;
    $conn->close();
    if (!empty($inserted_id)) {
        return $inserted_id;
    } else {
        return false;
    }
}

function addDepartment($department_name, $desc, $depart_code)
{
    $conn = connectdb();
    $sql = "INSERT INTO departments(department_name, description, department_code) VALUES ('$department_name', '$desc', '$depart_code')";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function addStatus($status_name, $desc)
{
    $conn = connectdb();
    $sql = "INSERT INTO student_status(status_name, description) VALUES ('$status_name', '$desc')";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function addMajor($major_name, $major_code, $depart_id)
{
    $conn = connectdb();
    $sql = "INSERT INTO majors(major_name, department_id, major_code) VALUES ('$major_name', '$depart_id', '$major_code')";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

// ---------- Function get ----------
function getStudentInfo($student_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM student WHERE student_id = $student_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    if (!empty($result)) {
        return $result;
    } else {
        return false;
    }
}

function getStudentDepartment($department_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM departments WHERE id = $department_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function getDepartment($department_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM departments WHERE id = $department_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function getAllDepartment()
{
    $conn = connectdb();
    $sql = "SELECT * FROM departments";
    $data = $conn->query($sql);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function getDepartmentsByParam($query)
{
    $conn = connectdb();
    $data = $conn->query($query);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    if (!empty($result)) {
        return $result;
    } else {
        return false;
    }
}

function getStudentMajor($major_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM majors WHERE id = $major_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function getAllMajor($department_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM majors WHERE department_id = $department_id";
    $data = $conn->query($sql);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function getMajorsByParam($query)
{
    $conn = connectdb();
    $data = $conn->query($query);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function getMajors()
{
    $conn = connectdb();
    $sql = "SELECT * FROM majors";
    $data = $conn->query($sql);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function getAllStudent($query)
{
    $conn = connectdb();
    $data = $conn->query($query);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    if (!empty($result)) {
        return $result;
    } else {
        return false;
    }
}

function getStudentStatus($status_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM student_status WHERE status_id = $status_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function getAllStatus()
{
    $conn = connectdb();
    $sql = "SELECT * FROM student_status";
    $data = $conn->query($sql);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function getStatusByParam($query)
{
    $conn = connectdb();
    $data = $conn->query($query);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return false;
    }
}

function getNumRow($sql)
{
    $conn = connectdb();
    $data = $conn->query($sql);
    if (!empty($data)) {
        $num_row = $data->num_rows;
        return $num_row;
    }
    return false;
}

function getAllClass()
{
    $conn = connectdb();
    $sql = "SELECT * FROM class";
    $data = $conn->query($sql);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    if (!empty($result)) {
        return $result;
    }
    return false;
}

function getStudentClass($class_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM class WHERE class_id = $class_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    if (!empty($result)) {
        return $result;
    } else {
        return false;
    }
}

// ---------- Function update ---------- 
function updateStudentInfo($image, $name, $email, $phone, $date_of_birth, $address, $class_id, $gender, $major, $id, $status_id)
{
    $conn = connectdb();
    if (!empty($image)) {
        $sql = "UPDATE student SET student_name = '$name', date_of_birth = '$date_of_birth', phonenumber = '$phone',
            email = '$email', address = '$address', class_id = $class_id, gender = '$gender', major_id = $major, image = '$image', status_id = $status_id WHERE student_id = $id";
    } else {
        $sql = "UPDATE student SET student_name = '$name', date_of_birth = '$date_of_birth', phonenumber = '$phone',
         email = '$email', address = '$address', class_id = $class_id, gender = '$gender', major_id = $major, status_id = $status_id WHERE student_id = $id";
    }

    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function updateStudentMajor($student_id, $major_id)
{
    $conn = connectdb();
    $sql = "UPDATE student SET major_id = $major_id WHERE student_id = $student_id";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function changeStudentPassword($student_id, $new_pw)
{
    $conn = connectdb();
    $sql = "UPDATE student SET password = $new_pw WHERE student_id = $student_id";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function updateDepartment($department_name, $desc, $depart_code, $depart_id)
{
    $conn = connectdb();
    $sql = "UPDATE departments SET department_name = '$department_name', description = '$desc', department_code = '$depart_code' WHERE id = $depart_id";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function updateMajor($major_name, $major_code, $major_id)
{
    $conn = connectdb();
    $sql = "UPDATE majors SET major_name = '$major_name', major_code = '$major_code'  WHERE id = $major_id";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function updateStatus($status_name, $desc, $status_id)
{
    $conn = connectdb();
    $sql = "UPDATE student_status SET status_name = '$status_name', description = '$desc' WHERE status_id = $status_id";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function updateStudentDepart($depart_id, $student_id)
{
    $conn = connectdb();
    $sql = "UPDATE student SET department_id = $depart_id WHERE student_id = $student_id";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

// ---------- Function delete ----------
function deleteStudent($student_id)
{
    $conn = connectdb();
    $sql = "DELETE FROM student WHERE student_id = $student_id";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function deleteDepartment($department_id)
{
    $conn = connectdb();
    $sql = "DELETE FROM departments WHERE id = $department_id";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function deleteMajor($major_id)
{
    $conn = connectdb();
    $sql = "DELETE FROM majors WHERE id = $major_id";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function deleteStatus($status_id)
{
    $conn = connectdb();
    $sql = "DELETE FROM student_status WHERE status_id = $status_id";
    $data = $conn->query($sql);
    $conn->close();
    if ($data) {
        return $data;
    } else {
        return false;
    }
}
