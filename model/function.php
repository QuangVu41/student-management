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
    try {
        $sql = "SELECT * FROM student WHERE student_id = '$student_code' AND password = '$password'";
        $data = $conn->query($sql);
        $result = $data->fetch_assoc();
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return 'Username or password incorrect!';
    }
}

// ---------- Function add ----------
function insertStudent($image, $name, $email, $phone, $date_of_birth, $address, $gender, $status_id)
{
    $conn = connectdb();
    try {
        $sql = "INSERT INTO student(student_name, date_of_birth, phonenumber, email, address, image, gender, status_id)
        VALUES('$name', '$date_of_birth', '$phone', '$email', '$address', '$image', '$gender', $status_id)";
        $data = $conn->query($sql);
        $inserted_id = $conn->insert_id;
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if (!empty($inserted_id)) {
        return $inserted_id;
    } else {
        return false;
    }
}

function addDepartment($department_name, $desc)
{
    $conn = connectdb();
    try {
        $sql = "INSERT INTO departments(department_name, description) VALUES ('$department_name', '$desc')";
        $data = $conn->query($sql);
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function addMajor($major_name, $depart_id)
{
    $conn = connectdb();
    try {
        $sql = "INSERT INTO majors(major_name, department_id) VALUES ('$major_name', '$depart_id')";
        $data = $conn->query($sql);
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
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
    return $result;
}

function getStudentDepartment($department_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM departments WHERE id = $department_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    return $result;
}

function getDepartment($department_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM departments WHERE id = $department_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    return $result;
}

function getAllDepartment()
{
    $conn = connectdb();
    $sql = "SELECT * FROM departments";
    $data = $conn->query($sql);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result;
}

function getStudentMajor($major_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM majors WHERE id = $major_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    return $result;
}

function getAllMajor($department_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM majors WHERE department_id = $department_id";
    $data = $conn->query($sql);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    return $result;
}

function getAllStudent()
{
    $conn = connectdb();
    $sql = "SELECT * FROM student";
    $data = $conn->query($sql);
    try {
        $sql = "SELECT * FROM student";
        $data = $conn->query($sql);
        $result = $data->fetch_all(MYSQLI_ASSOC);
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if ($data->num_rows > 0) {
        return $result;
    } else {
        return 'Have no students in the database';
    }
}

function getStudentStatus($status_id)
{
    $conn = connectdb();
    $sql = "SELECT * FROM student_status WHERE status_id = $status_id";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    $conn->close();
    return $result;
}

function getAllStatus()
{
    $conn = connectdb();
    $sql = "SELECT * FROM student_status";
    $data = $conn->query($sql);
    $result = $data->fetch_all(MYSQLI_ASSOC);
    $conn->close();
    return $result;
}

// ---------- Function update ---------- 
function updateStudentInfo($image, $name, $email, $phone, $date_of_birth, $address, $gender, $major, $id, $status_id)
{
    $conn = connectdb();
    try {
        if (!empty($image)) {
            $sql = "UPDATE student SET student_name = '$name', date_of_birth = '$date_of_birth', phonenumber = '$phone',
            email = '$email', address = '$address', gender = '$gender', major_id = $major, image = '$image', status_id = $status_id WHERE student_id = $id";
        } else {
            $sql = "UPDATE student SET student_name = '$name', date_of_birth = '$date_of_birth', phonenumber = '$phone',
         email = '$email', address = '$address', gender = '$gender', major_id = $major, status_id = $status_id WHERE student_id = $id";
        }

        $data = $conn->query($sql);
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return $data;
}

function updateStudentMajor($student_id, $major_id)
{
    $conn = connectdb();
    try {
        $sql = "UPDATE student SET major_id = $major_id WHERE student_id = $student_id";
        $data = $conn->query($sql);
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function updateDepartment($department_name, $desc, $depart_id)
{
    $conn = connectdb();
    try {
        $sql = "UPDATE departments SET department_name = '$department_name', description = '$desc' WHERE id = $depart_id";
        $data = $conn->query($sql);
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function updateMajor($major_name, $major_id)
{
    $conn = connectdb();
    try {
        $sql = "UPDATE majors SET major_name = '$major_name' WHERE id = $major_id";
        $data = $conn->query($sql);
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
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
    try {
        $sql = "DELETE FROM student WHERE student_id = $student_id";
        $data = $conn->query($sql);
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function deleteDepartment($department_id)
{
    $conn = connectdb();
    try {
        $sql = "DELETE FROM departments WHERE id = $department_id";
        $data = $conn->query($sql);
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if ($data) {
        return $data;
    } else {
        return false;
    }
}

function deleteMajor($major_id)
{
    $conn = connectdb();
    try {
        $sql = "DELETE FROM majors WHERE id = $major_id";
        $data = $conn->query($sql);
        $conn->close();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    if ($data) {
        return $data;
    } else {
        return false;
    }
}
