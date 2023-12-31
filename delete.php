<?php
require "connect.php";
?>
    <?php
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }
    ?>
    <?php
    $sql1 = "DELETE FROM subject WHERE subject_id = $id";
    if ($conn->query($sql1) === TRUE) {
        header("location: ./index.php?page=list-subject");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $sql2 = "DELETE FROM registered_subject WHERE subject_id = $id";
    if ($conn->query($sql2) === TRUE) {
        header("location: ./index.php?page=list-subject");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    ?>